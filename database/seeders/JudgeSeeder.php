<?php

namespace Database\Seeders;

use App\Models\Judge;
use Illuminate\Database\Seeder;

class JudgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Judge::truncate();
        Judge::factory()->count(3)->create();
    }
}
