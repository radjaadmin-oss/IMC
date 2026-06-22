<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desktop_image',
        'mobile_image',
        'event_id',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'string',
        'sort_order' => 'integer',
    ];

    /**
     * Get the event associated with this banner
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Scope: Only active banners
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get desktop image URL
     */
    public function getDesktopImageUrlAttribute(): string
    {
        return $this->desktop_image 
            ? asset('storage/' . $this->desktop_image)
            : asset('images/placeholder-banner.jpg');
    }

    /**
     * Get mobile image URL
     */
    public function getMobileImageUrlAttribute(): string
    {
        return $this->mobile_image 
            ? asset('storage/' . $this->mobile_image)
            : $this->desktop_image_url;
    }
}
