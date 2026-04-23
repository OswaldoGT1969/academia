<?php

namespace App\Observers;

use App\Models\Order;
use App\Mail\OrderCompletedStudentNotification;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Si el estado cambió a 'completed' y antes no lo estaba
        if ($order->isDirty('status') && $order->status === 'completed') {
            Mail::to($order->user->email)->send(new OrderCompletedStudentNotification($order));
        }
    }

    /**
     * Handle the Order "created" event.
     * También lo enviamos al crear si ya nace como 'completed' (ej. pagos automáticos con Stripe)
     */
    public function created(Order $order): void
    {
        if ($order->status === 'completed') {
            Mail::to($order->user->email)->send(new OrderCompletedStudentNotification($order));
        }
    }
}
