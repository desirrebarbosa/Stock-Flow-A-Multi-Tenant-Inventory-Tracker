<?php

namespace Tests\Feature;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
   use RefreshDatabase;

   public function test_a_user_can_login_with_correct_credentials(){
        $user = \App\Models\User::factory()->create();
        $response = $this->postJson(
            '/api/login',
            [
                'email' => $user->email,
                'password'=>'password',
            ]
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token','user',
        ]);
   }

   public function test_a_user_cant_login_with_wrong_credential(){
        $user = \App\Models\User::factory()->create();
        $response = $this->postJson(
            '/api/login',
            [
                'email' => $user->email,
                'password'=>'wrongpassword',
            ]
        );
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message'
        ]);
   }

   public function test_a_user_can_log_out(){
        $user = \App\Models\User::factory()->create();
        $token = $user->createToken('test_token')->plainTextToken;
        $response = $this->withToken($token)->postJson('/api/logout');
        $response->assertStatus(200);
        $this->assertDatabaseCount('personal_access_tokens', 0);
   }
}
