<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'qty' => $this->faker->unique()->randomDigit,
            'price' => $this->faker->numberBetween($min = 15000, $max = 60000)
        ];
    }
}
