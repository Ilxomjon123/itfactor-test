<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'sex' => $this->faker->randomElement(['man', 'woman']),
            'birthdate' => $this->faker->date('Y-m-d'),
        ];
    }
}
