<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\PersonalInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $info = PersonalInfo::factory()->create();
        $club = Club::inRandomOrder()->first();
        return [
            'personal_info_id' => $info->id,
            'club_id' => $club->id
        ];
    }
}
