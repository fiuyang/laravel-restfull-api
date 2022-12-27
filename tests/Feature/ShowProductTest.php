<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_token()
    {
        $response = $this->getJson('/api/products/1');
        $response->assertStatus(401)->assertJsonStructure(['status', 'message']);
    }

    public function test_product_do_not_exist()
    {
        $user = $this->createUser();

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->getJson('/api/products/1000');

        $response->assertStatus(404)->assertJsonStructure(['meta']);
    }


    public function test_get_product_with_success()
    {
        $user = $this->createUser();


        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->getJson('/api/products/21');

        $response->assertStatus(200)->assertJsonStructure([
            'data',
        ]);
    }
}
