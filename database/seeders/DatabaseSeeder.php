<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'), // Use bcrypt to hash the password
            'role' => 'Admin',
        ]);

        // Create regular User
        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@gamil.com',
            'password' => bcrypt('user1234'), // Use bcrypt to hash the password
            'role' => 'User',
        ]);

        $this->call([
            HikingTrailsSeeder::class
        ]);
    }
}
