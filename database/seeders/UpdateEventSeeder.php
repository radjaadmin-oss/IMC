<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class UpdateEventSeeder extends Seeder
{
    public function run(): void
    {
        $musikCategory = EventCategory::where('slug', 'musik-konser')->first();
        $festivalCategory = EventCategory::where('slug', 'festival')->first();

        $events = Event::all();

        if ($events->isEmpty()) {
            $this->command->warn('⚠️  Tidak ada event di database.');
            return;
        }

        // Update event pertama
        if (isset($events[0])) {
            $events[0]->update([
                'category_id' => $musikCategory?->id,
                'sold_count' => rand(50, 80),
                'views' => rand(500, 1000),
                'is_featured' => true,
                'is_free' => false,
                'early_bird_end' => now()->addDays(7),
            ]);
        }

        // Update event kedua
        if (isset($events[1])) {
            $events[1]->update([
                'category_id' => $festivalCategory?->id,
                'sold_count' => rand(30, 60),
                'views' => rand(300, 700),
                'is_featured' => true,
                'is_free' => false,
                'early_bird_end' => now()->addDays(5),
            ]);
        }

        $this->command->info('✓ Event berhasil diupdate dengan kategori dan data homepage');
    }
}
