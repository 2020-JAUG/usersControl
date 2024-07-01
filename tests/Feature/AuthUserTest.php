<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_register(): void
    {
        $userData = [
            'name' => 'Test User',
            'last_name' => 'User Last Name',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->post('/register', $userData);

        $this->assertDatabaseHas('users', [
            'email' => $userData['email']
        ]);

        $this->assertGuest();

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success', 'User registered successfully! Please verify your email to login.');
    }



    public function test_unverified_users_cannot_login(): void
    {
        $user = User::create([
            'email' => 'new@cv.es',
            'name' => 'Test User',
            'last_name' => 'User Last Name',
            'password' => 'password123'
        ]);

        $userData = [
            'email' => $user->email,
            'password' => 'password123',
        ];

        $response = $this->post('/login', $userData);

        $this->assertGuest();

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors(['verify_email_err' => 'Please verify your email to login.']);
    }


    public function test_verified_users_can_login(): void
    {
        $user = User::factory()->create([
            'password' => 'passsword'
        ]);

        $userData = [
            'email' => $user->email,
            'password' => 'passsword',
        ];

        $response = $this->post('/login', $userData);

        $this->assertAuthenticated();

        $response->assertRedirect(route('profile'));
        $response->assertSessionHas('success', 'Logged in successfully!');
    }

    public function test_dashboard_loads_for_authenticated_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    public function test_user_can_update_profile()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user);

        $updateData = [
            'name' => 'name updated',
            'last_name' => 'last name updated'
        ];

        $response = $this->post('/profile', $updateData);

        $this->assertDatabaseHas('users', [
            'name' => $updateData['name'],
            'last_name' => $updateData['last_name']
        ]);

        $response->assertRedirect(route('profile'));
        $response->assertSessionHas('success', 'Profile updated successfully!');
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user);

        $response = $this->get('logout');

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success', 'Logged out successfully!');
    }
}
