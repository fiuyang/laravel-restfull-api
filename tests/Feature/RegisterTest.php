<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_empty_input()
    {
        $response = $this->postJson('/api/register');
        // dd($response);
        $response->assertStatus(422)->assertJsonStructure(['meta']);
    }

    public function test_invalid_input()
    {
        $data = [
            'email' => $this->faker->name,
            'password' => $this->faker->password,
        ];

        $response = $this->postJson('/api/register', $data);
        $response->assertStatus(422)->assertJsonStructure(['meta']);
    }

    public function test_register_with_success()
    {
        $password = $this->faker->password(8);

        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];

        $formData = [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $password,
        ];


        $response = $this->postJson('/api/register', $formData);
        // dd($response);

        $this->assertDatabaseHas('users', $userData);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }


    public function test_already_registered()
    {

        $formData = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password(8),
        ];

        $this->postJson('/api/register', $formData);

        $response = $this->postJson('/api/register', $formData);

        $response->assertStatus(422)
            ->assertJsonStructure(['meta']);
    }
}
