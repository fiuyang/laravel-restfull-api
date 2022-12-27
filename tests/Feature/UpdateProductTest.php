<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProductTest extends TestCase
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
        $response = $this->putJson('/api/products/1000', $task);
        $response->assertStatus(401)->assertJsonStructure([
            
        ]);
    }

    public function test_product_do_not_exist()
    {
        $user = $this->createUser();

        $task = [
            'name' => $this->faker->name(),
            'qty' => $this->faker->unique()->randomDigit,
            'price' => $this->faker->numberBetween($min = 15000, $max = 60000)
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->putJson('/api/products/1000', $task);

        $response->assertStatus(404)->assertJsonStructure(['meta']);
    }

    public function test_unauthorized_edit_products()
    {
        $user = $this->createUser();

        $task = [
            'name' => $this->faker->name(),
            'qty' => $this->faker->unique()->randomDigit,
            'price' => $this->faker->numberBetween($min = 15000, $max = 60000)
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->putJson('/api/products/1000', $task);

        $response->assertStatus(404)->assertJsonStructure(['meta']);
    }

    public function test_invalid_input()
    {
        $user = $this->createUser();

        $task = [
            'name' => "",
            'qty' => "string",
            'price' => "string"
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->putJson('/api/products/20', $task);

        $response->assertStatus(422)->assertJsonStructure([]);
    }

    public function test_edit_products_with_success()
    {
        $user = $this->createUser();

        $task = [
            'name' => $this->faker->name(),
            'qty' => $this->faker->unique()->randomDigit,
            'price' => $this->faker->numberBetween($min = 15000, $max = 60000)
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $user['token'])
            ->putJson('/api/products/21', $task);

        $response->assertStatus(200)->assertJsonStructure([
            'message',
        ]);
    }
}
