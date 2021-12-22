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
            'category_id' => mt_rand(1, 3),
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100000, 5000000),
            'quantity' => mt_rand(5, 20),
            'weight' => mt_rand(1, 10),
            'description' => $this->faker->paragraph(),
        ];
    }
}
