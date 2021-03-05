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
        $response = $this->post('api/v1/user/register', $this->data());
        $response->assertOk();
        $response->assertStatus(200);
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

    public function data()
    {
        return [
           "first_name" => "Schneider", 
           "middle_name" => "Busayo", 
           "last_name" => "Komolafe", 
           "email" => rand(1000, 9000)."info@l2w.com", 
           "password" => "password",
           "role" => "Student",
        ];
    }
}
