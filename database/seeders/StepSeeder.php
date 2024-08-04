<?php

namespace Database\Seeders;

use App\Models\Step;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            [
                'city' => 'Shizuoka',
                'date' => '2024-08-12',
                'time_start' => '16:00:00',
                'time_finish' => '16:00:00',
                'location' => 'Shizuoka'
            ],
            [
                'city' => 'Odawara',
                'date' => '2024-08-13',
                'time_start' => '16:00:00',
                'time_finish' => '16:00:00',
                'location' => 'Odawara'
            ],
            [
                'city' => 'Yokohama',
                'date' => '2024-08-14',
                'time_start' => '16:00:00',
                'time_finish' => '16:00:00',
                'location' => 'Yokohama'
            ],
            [
                'city' => 'Tokyo',
                'date' => '2024-08-15',
                'time_start' => '16:00:00',
                'time_finish' => '16:00:00',
                'location' => 'Tokyo'
            ],
            [
                'city' => 'Utsunomiya',
                'date' => '2024-08-16',
                'time_start' => '16:00:00',
                'time_finish' => '16:00:00',
                'location' => 'Utsunomiya'
            ],
            [
                'city' => 'Iwaki',
                'date' => '2024-08-17',
                'time_start' => '16:00:00',
                'time_finish' => '16:00:00',
                'location' => 'Iwaki'
            ],
            [
                'city' => 'Koriyama',
                'date' => '2024-08-18',
                'time_start' => '16:00:00',
                'time_finish' => '16:00:00',
                'location' => 'Koriyama'
            ],
        ];



        foreach ($steps as $step) {
            $newStep = new Step();
            $newStep->travel_id = 1;
            $newStep->name = 'Visitare ' . $step['city'];
            $newStep->slug = Str::slug($step['city'], '-');
            $newStep->date = $step['date'];
            $newStep->time_start = $step['time_start'];
            $newStep->time_arrived = $step['time_finish'];
            $newStep->location = $step['location'];
            $newStep->save();
        }
    }
}
