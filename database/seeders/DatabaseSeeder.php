<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User (pastikan email unik agar tidak error)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. Panggil Seeders
        $this->call([
            AdminUserSeeder::class,           // ✓ Tambahkan admin user
            EventCategorySeeder::class,
            UpdateEventSeeder::class,
            EventSeeder::class,
            HomeBannerSeeder::class,
            BlogPostSeeder::class,
            PartnerSeeder::class,
        ]);
    }
}