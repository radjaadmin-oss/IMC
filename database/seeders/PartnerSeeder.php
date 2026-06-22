<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'BCA',
                'logo' => 'partners/bca.png',
                'type' => 'sponsor',
                'website' => 'https://bca.co.id',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Bank Mandiri',
                'logo' => 'partners/mandiri.png',
                'type' => 'sponsor',
                'website' => 'https://bankmandiri.co.id',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'GoPay',
                'logo' => 'partners/gopay.png',
                'type' => 'sponsor',
                'website' => 'https://gopay.co.id',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'OVO',
                'logo' => 'partners/ovo.png',
                'type' => 'sponsor',
                'website' => 'https://ovo.id',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Kompas',
                'logo' => 'partners/kompas.png',
                'type' => 'media',
                'website' => 'https://kompas.com',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Detik',
                'logo' => 'partners/detik.png',
                'type' => 'media',
                'website' => 'https://detik.com',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'KASKUS',
                'logo' => 'partners/kaskus.png',
                'type' => 'community',
                'website' => 'https://kaskus.co.id',
                'is_active' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }

        $this->command->info('✓ Partners berhasil dibuat (logo perlu diupload manual)');
    }
}
