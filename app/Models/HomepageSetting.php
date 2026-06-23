<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        // Logo & Branding
        'logo',
        'site_name',
        'site_tagline',

        // Hero Banner
        'hero_title',
        'hero_subtitle',

        // Features Section
        'show_features',
        'feature_1_title',
        'feature_1_subtitle',
        'feature_2_title',
        'feature_2_subtitle',
        'feature_3_title',
        'feature_3_subtitle',
        'feature_4_title',
        'feature_4_subtitle',

        // Event Sections
        'show_recommended_events',
        'recommended_events_title',
        'recommended_events_subtitle',
        'show_nearest_events',
        'nearest_events_title',
        'nearest_events_subtitle',
        'show_upcoming_events',
        'upcoming_events_title',
        'upcoming_events_subtitle',
        'show_popular_events',
        'popular_events_title',
        'popular_events_subtitle',
        'show_categories',
        'categories_title',
        'categories_subtitle',
        'show_regions',
        'regions_title',
        'regions_subtitle',

        // · NEW: Footer Settings
        'footer_tagline',
        'social_instagram',
        'social_tiktok',
        'social_youtube',
        'social_facebook',
        'social_twitter',
        'social_whatsapp',
        'footer_copyright',
        'footer_menu_about',
        'footer_menu_info',
        'footer_menu_categories',
    ];

    protected $casts = [
        'show_features' => 'boolean',
        'show_recommended_events' => 'boolean',
        'show_nearest_events' => 'boolean',
        'show_upcoming_events' => 'boolean',
        'show_popular_events' => 'boolean',
        'show_categories' => 'boolean',
        'show_regions' => 'boolean',
        'footer_menu_about' => 'array',
        'footer_menu_info' => 'array',
        'footer_menu_categories' => 'array',
    ];

    /**
     * Get the singleton instance (always return first row)
     */
    public static function getSettings()
    {
        return self::firstOrCreate(['id' => 1], [
            // Default values
            'site_name' => 'RADJATIKET',
            'hero_title' => 'Festival Musik Senja',
            'show_features' => true,
            'feature_1_title' => '100% Aman',
            'feature_1_subtitle' => 'Transaksi Terpercaya',
            'feature_2_title' => 'Mudah & Cepat',
            'feature_2_subtitle' => 'Proses Instan',
            'feature_3_title' => 'E-Ticket Instan',
            'feature_3_subtitle' => 'Langsung ke Email',
            'feature_4_title' => '24/7 Support',
            'feature_4_subtitle' => 'Siap Membantu',
            'show_recommended_events' => true,
            'recommended_events_title' => 'Rekomendasi Event',
            'show_nearest_events' => true,
            'nearest_events_title' => 'Event Terdekat',
            'show_upcoming_events' => true,
            'upcoming_events_title' => 'Upcoming Event',
            'show_popular_events' => true,
            'popular_events_title' => 'Popular Event',
            'show_categories' => true,
            'categories_title' => 'Kategori Event',
            'show_regions' => true,
            'regions_title' => 'Temukan Event Menarik di Kotamu',
            
            // Footer defaults
            'footer_tagline' => 'Your Professional Ticketing Partner',
            'footer_copyright' => '© 2026 RADJATIKET, Hak Cipta Dilindungi.',
            'footer_menu_about' => [
                ['label' => 'Tentang RADJATIKET', 'url' => '/about'],
                ['label' => 'Kebijakan Privasi', 'url' => '/privacy'],
                ['label' => 'Syarat & Ketentuan', 'url' => '/terms'],
                ['label' => 'Hubungi Kami', 'url' => '/contact'],
            ],
            'footer_menu_info' => [
                ['label' => 'Cara Membeli Tiket', 'url' => '/how-to-buy'],
                ['label' => 'Cara Menjual Tiket', 'url' => '/how-to-sell'],
                ['label' => 'Panduan Event Organizer', 'url' => '/eo-guide'],
                ['label' => 'FAQ', 'url' => '/faq'],
            ],
            'footer_menu_categories' => [
                ['label' => 'Musik', 'url' => '/events?category=musik'],
                ['label' => 'Festival', 'url' => '/events?category=festival'],
                ['label' => 'Seminar', 'url' => '/events?category=seminar'],
                ['label' => 'Pameran', 'url' => '/events?category=pameran'],
                ['label' => 'Olahraga', 'url' => '/events?category=olahraga'],
                ['label' => 'Workshop', 'url' => '/events?category=workshop'],
            ],
        ]);
    }
}
