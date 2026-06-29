<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_login_page()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function test_user_can_view_register_page()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post(route('login.authenticate'), [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_user_can_register()
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'nik' => '1234567890123456',
            'email' => 'test@example.com',
            'no_hp' => '081234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('warga', [
            'email' => 'test@example.com',
            'nik' => '1234567890123456',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
    }
}
