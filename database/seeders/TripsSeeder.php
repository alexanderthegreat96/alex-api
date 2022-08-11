<?php

namespace Database\Seeders;

use App\Models\Trips;
use Illuminate\Database\Seeder;
use Illuminate\View\View;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trips::factory(100)->create();
    }
}
