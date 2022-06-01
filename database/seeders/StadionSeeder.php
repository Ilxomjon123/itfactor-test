<?php

namespace Database\Seeders;

use App\Models\Stadion;
use Illuminate\Database\Seeder;

class StadionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stadion::truncate();
        Stadion::factory()->count(5)->create();
    }
}
