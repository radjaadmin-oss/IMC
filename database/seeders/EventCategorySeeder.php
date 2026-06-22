<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Musik & Konser', 'slug' => 'musik-konser', 'icon' => '🎵', 'color' => '#D4AF37'],
            ['name' => 'Festival', 'slug' => 'festival', 'icon' => '🎉', 'color' => '#F59E0B'],
            ['name' => 'Seminar & Workshop', 'slug' => 'seminar-workshop', 'icon' => '▪', 'color' => '#3B82F6'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'icon' => '⚽', 'color' => '#10B981'],
            ['name' => 'Pameran', 'slug' => 'pameran', 'icon' => '🎨', 'color' => '#8B5CF6'],
            ['name' => 'Stand Up Comedy', 'slug' => 'stand-up-comedy', 'icon' => '🎤', 'color' => '#EC4899'],
            ['name' => 'Teater & Drama', 'slug' => 'teater-drama', 'icon' => '🎭', 'color' => '#EF4444'],
            ['name' => 'Komunitas', 'slug' => 'komunitas', 'icon' => '👥', 'color' => '#06B6D4'],
        ];

        foreach ($categories as $category) {
            EventCategory::create($category);
        }
    }
}
