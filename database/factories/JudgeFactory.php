<?php

namespace Database\Factories;

use App\Models\PersonalInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class JudgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $info = PersonalInfo::factory()->create();
        return [
            'personal_info_id' => $info->id
        ];
    }
}
