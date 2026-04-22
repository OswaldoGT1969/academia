<?php

namespace Tests\Feature;

use App\Models\PendingRegistration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_creates_pending_record_but_not_user()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('register.notice'));
        $this->assertDatabaseHas('pending_registrations', [
            'email' => 'john@example.com',
        ]);
        $this->assertDatabaseMissing('users', [
            'email' => 'john@example.com',
        ]);
        $this->assertGuest();
    }

    public function test_confirmation_creates_user_and_deletes_pending_record()
    {
        $pending = PendingRegistration::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'hashed_password',
            'token' => 'test-token',
        ]);

        $response = $this->get(route('register.verify', ['token' => 'test-token']));

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
        $this->assertDatabaseMissing('pending_registrations', [
            'email' => 'john@example.com',
        ]);
        $this->assertAuthenticated();
    }

    public function test_invalid_token_does_not_create_user()
    {
        $response = $this->get(route('register.verify', ['token' => 'invalid-token']));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseCount('users', 0);
        $this->assertGuest();
    }
}
