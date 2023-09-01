<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\apiAuth::create([
            'appName'=>'Schedule',
            'apiKey'=>'ijhihrtyk054ooyl6484787jy',
        ]);
        \App\Models\User::factory()->create([
            'lastName' => 'Test User',
            'user_group_id'=>1,
            'email' => 'test@example.com',

        ]);
    }
}
