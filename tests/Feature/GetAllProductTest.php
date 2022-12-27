<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAllProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_token()
    {
        $response = $this->getJson('/api/products');
        $response->assertStatus(401)->assertJsonStructure(['status', 'message']);
    }

    public function test_get_all_products()
    {
        $user = $this->createUser();

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->getJson('/api/products');

        $response->assertStatus(404)
            ->assertJsonStructure([
                'data'
            ]);
    }
}
