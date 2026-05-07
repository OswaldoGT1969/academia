<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index'])->name('home');
Route::get('/nosotros', function () {
    return view('nosotros');
})->name('about');
Route::get('/curso/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/aula/{course_slug}/{lesson_id?}', [CourseController::class, 'lesson'])->name('lessons.show');

Route::middleware('guest')->group(function () {
    Route::get('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

    Route::get('register-notice', [App\Http\Controllers\Auth\RegisteredUserController::class, 'notice'])
        ->name('register.notice');

    Route::get('verify-registration/{token}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'confirm'])
        ->name('register.verify');

    Route::get('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', App\Http\Controllers\Auth\EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', App\Http\Controllers\Auth\VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/courses/{course}/enroll', [App\Http\Controllers\DashboardController::class, 'enroll'])->name('courses.enroll');

    // Checkout Routes
    Route::get('/checkout/{course}', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/checkout/{course}/deposit', [App\Http\Controllers\CheckoutController::class, 'deposit'])->name('checkout.deposit');
    Route::post('/checkout/{course}/deposit', [App\Http\Controllers\CheckoutController::class, 'processDeposit'])->name('checkout.deposit.post');
    Route::post('/checkout/{course}/stripe', [App\Http\Controllers\CheckoutController::class, 'processStripe'])->name('checkout.stripe');
    Route::get('/checkout/{course}/success', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

    // Quiz
    Route::get('/curso/{course:slug}/quiz', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/curso/{course:slug}/quiz', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/curso/{course:slug}/certificado', [QuizController::class, 'certificate'])->name('quizzes.certificate');

    // Lesson Completion
    Route::post('/lesson/{lesson}/toggle-complete', [CourseController::class, 'toggleComplete'])->name('lessons.toggle-complete');
});

// Stripe Webhook (Public)
Route::post('/stripe/webhook', [App\Http\Controllers\CheckoutController::class, 'webhook'])->name('checkout.webhook');
