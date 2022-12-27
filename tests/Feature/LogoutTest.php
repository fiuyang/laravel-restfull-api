<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_token_not_found()
    {
        $response = $this->postJson('/api/logout');
  
        $response->assertStatus(401)->assertJsonStructure(['status', 'message']);
    }

    public function test_logout_with_success()
    {
        $user = $this->createUser();

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->postJson('/api/logout');

        $response->assertStatus(200)->assertJsonStructure(['data']);
    }
}
