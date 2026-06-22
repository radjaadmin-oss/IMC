<?php

namespace Database\Seeders;

use App\Models\HomeBanner;
use App\Models\Event;
use Illuminate\Database\Seeder;

class HomeBannerSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::limit(3)->get();

        if ($events->isEmpty()) {
            $this->command->warn('⚠️  Tidak ada event. Jalankan EventSeeder terlebih dahulu.');
            return;
        }

        $banners = [
            [
                'title' => 'Radja Live In Concert',
                'desktop_image' => 'banners/banner-1-desktop.jpg',
                'mobile_image' => 'banners/banner-1-mobile.jpg',
                'event_id' => $events[0]->id ?? null,
                'sort_order' => 1,
                'is_active' => true,
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
            ],
            [
                'title' => 'Festival Musik Senja',
                'desktop_image' => 'banners/banner-2-desktop.jpg',
                'mobile_image' => 'banners/banner-2-mobile.jpg',
                'event_id' => $events[1]->id ?? null,
                'sort_order' => 2,
                'is_active' => true,
                'start_date' => now(),
                'end_date' => now()->addMonth(),
            ],
            [
                'title' => 'Workshop Digital Marketing',
                'desktop_image' => 'banners/banner-3-desktop.jpg',
                'mobile_image' => 'banners/banner-3-mobile.jpg',
                'event_id' => $events[2]->id ?? null,
                'sort_order' => 3,
                'is_active' => true,
                'start_date' => now(),
                'end_date' => now()->addWeeks(3),
            ],
        ];

        foreach ($banners as $banner) {
            HomeBanner::create($banner);
        }

        $this->command->info('✓ Banner berhasil dibuat (gambar perlu diupload manual)');
    }
}
