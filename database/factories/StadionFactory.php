<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StadionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName(),
            'capacity' => random_int(10000, 100000)
        ];
    }
}
