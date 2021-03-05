<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Register a new user.
     *
     * @return void
     */
    public function test_a_new_user_can_be_added()
    {
        $this->withOutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('api/v1/user/register', [
           "first_name" => $user->first_name, 
           "username" => 'shades'.rand(1000, 900000), 
           "last_name" => $user->last_name, 
           "email" => rand(1000, 900000)."info@l2w.com", 
           "password" => "password",
        ]);
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
    }

    public function test_a_login_authenticate()
    {
        $user = User::factory()->create();

        $response = $this->post('api/v1/user/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
    }
}
