<?php

namespace Database\Seeders;

use App\Models\HikingTrail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HikingTrailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $hikingTrails = [
            [
                'name' => 'Gunung_Manglayang',
                'latitude' => -6.8778940,
                'longitude' =>	107.7439500,
            ],
            [
                'name' => 'Gunung_Cikuray',
                'latitude' => -7.322513,
                'longitude' =>	107.859865,
            ],
            [
                'name' => 'Gunung_Tangkuban_Perahu',
                'latitude' => -6.7534090,
                'longitude' =>	107.6082640,
            ],
            [
                'name' => 'Gunung_Semeru',
                'latitude' => -8.1077,
                'longitude' => 112.922,
            ],
            [
                'name' => 'Gunung_Gede',
                'latitude' => -6.7900,
                'longitude' => 106.9800,
            ],
            // Add other hikingTrails as needed
        ];

        foreach ($hikingTrails as $mountain) {
            HikingTrail::create($mountain);
        }
    }
}
