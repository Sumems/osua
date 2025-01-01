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
                'name' => 'Gunung Semeru',
                'latitude' => -8.1077,
                'longitude' => 112.922,
            ],
            [
                'name' => 'Gunung Gede',
                'latitude' => -6.7900,
                'longitude' => 106.9800,
            ],
            [
                'name' => 'Gunung Manglayang',
                'latitude' => -6.8778940,
                'longitude' =>	107.7439500,
            ],
            // Add other hikingTrails as needed
        ];

        foreach ($hikingTrails as $mountain) {
            HikingTrail::create($mountain);
        }
    }
}
