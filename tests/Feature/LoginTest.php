<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_empty_input()
    {
        $response = $this->postJson('/api/login');
        $response->assertStatus(422)->assertJsonStructure(['data']);
    }

    public function test_invalid_input()
    {
        $data = [
            'email' => 'failed@gmail.com',
            'password' => 'failed',
        ];
        
        $response = $this->postJson('/api/login', $data);
        $response->assertStatus(401)->assertJsonStructure(['data']);
    }

    public function test_invalid_credentials()
    {
        $data = [
            'email' => 'uchita@example.com',
            'password' => 'failed',
        ];

        $response = $this->postJson('/api/login/', $data);
    
        $response->assertStatus(401)
        ->assertJsonStructure(['data']);
    }

    public function test_login_with_success()
    {
        $response = $this->postJson('/api/login/', [
            'email' => 'halim33@example.com',
            'password' => 'password',
        ]);

        // dd($response);
        $response->assertStatus(201)
            ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }
}
