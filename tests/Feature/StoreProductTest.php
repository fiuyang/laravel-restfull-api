<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_token()
    {
        $task = [
            'name' => $this->faker->name(),
            'qty' => $this->faker->unique()->randomDigit,
            'price' => $this->faker->numberBetween($min = 15000, $max = 60000)
        ];
        $response = $this->postJson('/api/products', $task);
        $response->assertStatus(401)->assertJsonStructure([
            "status",
            "message"
        ]);
    }

    public function test_empty_input()
    {
        $user = $this->createUser();

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->postJson('/api/products');
        $response->assertStatus(422)->assertJsonStructure(['message', 'errors']);
    }

    public function test_invalid_input()
    {
        $user = $this->createUser();

        $task = [
            'name' => "",
            'qty' => "testing",
            'price' => "failed"
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->postJson('/api/products');

        $response->assertStatus(422)->assertJsonStructure(['message', 'errors']);
    }

    public function test_create_product()
    {
        $user = $this->createUser();

        $task = [
            'name' => $this->faker->name(),
            'qty' => $this->faker->unique()->randomDigit,
            'price' => $this->faker->numberBetween($min = 15000, $max = 60000)
        ];
        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->postJson('/api/products', $task);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);
    }
}
