<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Travel;
use Illuminate\Support\Str;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newTravel = new Travel();
        $newTravel->name = "Road of Japan";
        $newTravel->slug = Str::slug($newTravel->name, '-');
        $newTravel->date_start = "2025-04-20";
        $newTravel->date_finish = "2025-04-27";
        $newTravel->save();
    }
}
