<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'site_name',
        'site_tagline',
        'hero_title',
        'hero_subtitle',
        'show_features',
        'feature_1_title',
        'feature_1_subtitle',
        'feature_2_title',
        'feature_2_subtitle',
        'feature_3_title',
        'feature_3_subtitle',
        'feature_4_title',
        'feature_4_subtitle',
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
    ];

    protected $casts = [
        'show_features' => 'boolean',
        'show_recommended_events' => 'boolean',
        'show_nearest_events' => 'boolean',
        'show_upcoming_events' => 'boolean',
        'show_popular_events' => 'boolean',
        'show_categories' => 'boolean',
        'show_regions' => 'boolean',
    ];

    /**
     * Get the singleton instance (always return first row)
     */
    public static function getSettings()
    {
        return self::firstOrCreate([]);
    }
}
