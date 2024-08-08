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

        // E un viaggio di una settimana che parte da Shizuoka e arriva Koriyama, esploreremo la Giappone tradizionale e quello moderno si pensava di mangiare a pranzo nelle bancarelle per gustarci i cibi delle rosticcerie giapponesi mentre alla sera ci fermavamo nei ristoranti tradizionali per assaggiare nel viaggio diverse prelibatezze che distingue citta e citta, naturalmente non mancherà le gite nei castelli che sono resistiti dal periodo dello shonugato poi si poteva scegliere al pomeriggio di fare un uscita libera per girare nelle citta.
        $newTravel = new Travel();
        $newTravel->user_id = 1;
        $newTravel->name = "Road of Japan";
        $newTravel->slug = Str::slug($newTravel->name, '-');
        $newTravel->date_start = "2024-08-12";
        $newTravel->date_finish = "2024-08-18";
        $newTravel->save();
    }
}
