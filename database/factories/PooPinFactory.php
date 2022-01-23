<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PooPinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'latitude' => $this->faker->randomFloat(7, -180, 180),
            'longitude' => $this->faker->randomFloat(7, -180, 180)
        ];
    }
}
