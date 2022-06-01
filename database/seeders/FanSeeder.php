<?php

namespace Database\Seeders;

use App\Models\Fan;
use Illuminate\Database\Seeder;

class FanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fan::truncate();
        Fan::factory()->count(100)->create();
    }
}
