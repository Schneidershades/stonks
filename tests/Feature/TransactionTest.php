<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Wallet;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_user_can_make_a_deposit()
    {
        $this->withOutExceptionHandling();
        $user = $this->actingAs(User::factory()->create());

        $response = $this->post('api/v1/transaction/deposit', [
            'amount' => 10,
            'description' => 'Please save this for me',
        ]);

        $response->assertOk();
        $response->assertStatus(200);
    }

    public function test_if_user_can_make_a_withdrawal()
    {
        $this->withOutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $wallet = Wallet::where('user_id', $user->id)->first();
        $wallet->balance = 1000;
        $wallet->save();
        $response = $this->post('api/v1/transaction/withdrawal', [
            'amount' => 1.87,
            'description' => 'i need this withdrawal urgently',
        ]);
        $response->assertOk();
        $response->assertStatus(200);
    }

    public function test_if_user_can_make_a_transfer()
    {
        $this->withOutExceptionHandling();
        $user = $this->actingAs(User::factory()->create());
        $receiver = User::factory()->create();
        $response = $this->post('api/v1/transaction/transfer', [
            'receiver_email' => $receiver->email,
            'amount' => 1,
            'description' => 'i need this withdrawal urgently',
        ]);
        $response->assertOk();
        $response->assertStatus(200);
    }
}
