<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Musik & Konser', 'slug' => 'musik-konser', 'icon' => '🎵', 'color' => '#D4AF37', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Festival', 'slug' => 'festival', 'icon' => '🎉', 'color' => '#F59E0B', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Seminar & Workshop', 'slug' => 'seminar-workshop', 'icon' => '▪', 'color' => '#3B82F6', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'icon' => '⚽', 'color' => '#10B981', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'Pameran', 'slug' => 'pameran', 'icon' => '🎨', 'color' => '#8B5CF6', 'is_active' => true, 'sort_order' => 5],
            ['name' => 'Stand Up Comedy', 'slug' => 'stand-up-comedy', 'icon' => '🎤', 'color' => '#EC4899', 'is_active' => true, 'sort_order' => 6],
            ['name' => 'Teater & Drama', 'slug' => 'teater-drama', 'icon' => '🎭', 'color' => '#EF4444', 'is_active' => true, 'sort_order' => 7],
            ['name' => 'Komunitas', 'slug' => 'komunitas', 'icon' => '👥', 'color' => '#06B6D4', 'is_active' => true, 'sort_order' => 8],
        ];

        foreach ($categories as $category) {
            EventCategory::updateOrCreate(
                ['slug' => $category['slug']], // Check by slug
                $category // Update or create with these values
            );
        }
    }
}
