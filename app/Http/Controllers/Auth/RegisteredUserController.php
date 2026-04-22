<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationConfirmation;
use App\Models\PendingRegistration;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class, 'unique:pending_registrations'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pending = PendingRegistration::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => Str::random(64),
        ]);

        Mail::to($pending->email)->send(new RegistrationConfirmation($pending));

        return redirect()->route('register.notice')->with('email', $pending->email);
    }

    /**
     * Display the registration notice.
     */
    public function notice(): View
    {
        if (!session('email')) {
            return redirect()->route('register');
        }

        return view('auth.register-notice');
    }

    /**
     * Confirm the registration.
     */
    public function confirm($token): RedirectResponse
    {
        $pending = PendingRegistration::where('token', $token)->first();

        if (!$pending) {
            return redirect()->route('login')->with('error', 'El enlace de confirmación no es válido o ya ha expirado.');
        }

        $user = User::create([
            'name' => $pending->name,
            'email' => $pending->email,
            'password' => $pending->password,
            'email_verified_at' => now(), // Auto verify on confirmation
        ]);

        $pending->delete();

        Auth::login($user);

        return redirect()->route('home')->with('success', '¡Cuenta confirmada con éxito! Bienvenido a ' . config('app.name'));
    }
}
