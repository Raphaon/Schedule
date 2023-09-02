<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class apiAuth extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\apiAuth::factory()->create([
            'appName'=>'Schedule',
            'apiKey'=>'ijhihrtyk054ooyl6484787jy',
        ]);
    }
}
