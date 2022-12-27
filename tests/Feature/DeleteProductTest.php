<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_token()
    {
        $response = $this->deleteJson('/api/products/21');
        $response->assertStatus(401)->assertJsonStructure(['status']);
    }

    public function test_products_do_not_exist()
    {
        $user = $this->createUser();


        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->deleteJson('/api/products/1');
            // dd($response);

        $response->assertStatus(404)->assertJsonStructure(['meta']);
    }

    public function test_delete_products_with_success()
    {
        $user = $this->createUser();

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->deleteJson('/api/products/28');

        $response->assertStatus(404)->assertJsonStructure([
            "meta"
        ]);
    }
}
