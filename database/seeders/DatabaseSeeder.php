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

 $this->call([
        EventCategorySeeder::class,
        // UserSeeder::class, // jika ada
        // EventSeeder::class, // jika ada
        UpdateEventSeeder::class,
        HomeBannerSeeder::class,
        BlogPostSeeder::class,
        PartnerSeeder::class,
    ]);
}

        // 1. Buat User (pastikan email unik agar tidak error)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. Panggil EventSeeder agar event kamu masuk ke database
        $this->call([
            EventSeeder::class,
        ]);
    }
}