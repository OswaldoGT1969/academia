<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Mail\OrderPendingAdminNotification;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class CheckoutController extends Controller
{
    public function show(Course $course)
    {
        // Check if already owned (completed order)
        if (Auth::user()->courses()->where('courses.id', $course->id)->where('orders.status', 'completed')->exists()) {
            return redirect()->route('dashboard')->with('error', 'Ya tienes este curso.');
        }

        return view('checkout.index', compact('course'));
    }

    public function deposit(Course $course)
    {
        return view('checkout.deposit', compact('course'));
    }

    public function processDeposit(Request $request, Course $course)
    {
        $request->validate([
            'proof' => 'required|image|max:5120', // Max 5MB
        ]);

        $path = $request->file('proof')->store('proofs', 'public');

        $order = Order::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'payment_method' => 'bank_transfer',
            'status' => 'pending',
            'amount' => $course->price,
            'proof_of_payment_path' => $path,
        ]);

        // Notificar al administrador (Email)
        $emails = array_filter([
            config('app.admin_email'),
            config('app.notifications_email')
        ]);
        
        foreach ($emails as $email) {
            Mail::to($email)->send(new OrderPendingAdminNotification($order));
        }

        // Notificar al administrador (Campanita en el Panel)
        $admins = User::whereIn('email', $emails)->get();
        foreach ($admins as $admin) {
            Notification::make()
                ->title('Nuevo Pedido con Depósito')
                ->icon('heroicon-o-shopping-bag')
                ->body("El alumno **{$order->user->name}** ha solicitado el curso: **{$order->course->title}** por un monto de \${$order->amount}")
                ->warning()
                ->sendToDatabase($admin);
        }

        return redirect()->route('dashboard')->with('success', 'Tu comprobante ha sido enviado. Validaremos tu pago en breve.');
    }

    public function processStripe(Course $course)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mxn',
                    'product_data' => [
                        'name' => 'Acceso al curso: ' . $course->title,
                        'description' => 'Pago único por acceso de por vida.',
                    ],
                    'unit_amount' => $course->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success', $course->id) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.show', $course->id),
            'customer_email' => Auth::user()->email,
            'metadata' => [
                'course_id' => $course->id,
                'user_id' => Auth::id(),
            ],
        ]);

        // Create a pending order for tracking
        Order::updateOrCreate(
            ['user_id' => Auth::id(), 'course_id' => $course->id, 'status' => 'pending'],
            [
                'payment_method' => 'stripe',
                'amount' => $course->price,
                'stripe_session_id' => $session->id,
            ]
        );

        return redirect($session->url);
    }

    public function success(Request $request, Course $course)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('checkout.show', $course)->with('error', 'Sesión de pago no encontrada.');
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = StripeSession::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $this->completeOrder($session);
                return redirect()->route('dashboard')->with('success', '¡Gracias por tu compra! Ya puedes acceder al curso.');
            }
        } catch (\Exception $e) {
            return redirect()->route('checkout.show', $course)->with('error', 'Error al verificar el pago: ' . $e->getMessage());
        }

        return redirect()->route('checkout.show', $course)->with('error', 'El pago no ha sido completado.');
    }

    public function webhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $this->completeOrder($session);
        }

        return response()->json(['status' => 'success']);
    }

    private function completeOrder($session)
    {
        $courseId = $session->metadata->course_id;
        $userId = $session->metadata->user_id;

        Order::updateOrCreate(
            ['stripe_session_id' => $session->id],
            [
                'user_id' => $userId,
                'course_id' => $courseId,
                'payment_method' => 'stripe',
                'status' => 'completed',
                'amount' => $session->amount_total / 100,
            ]
        );
    }
}
