<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'Radja Live In Concert',
                'location' => 'Jakarta, Indonesia',
                'date' => '2026-07-27',
                'price' => 500000,
                'description' => 'Konser eksklusif band Radja dengan hits terbaik mereka.',
                'created_at' => now(),
            ],
            [
                'title' => 'Festival Musik Senja',
                'location' => 'Bandung, Indonesia',
                'date' => '2026-08-15',
                'price' => 250000,
                'description' => 'Menikmati musik di suasana sore hari yang syahdu.',
                'created_at' => now(),
            ]
        ]);
    }
}