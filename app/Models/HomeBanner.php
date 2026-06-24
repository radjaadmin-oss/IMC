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
        'is_active',
        'sort_order',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
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
        return $query->where('is_active', true);
    }

    /**
     * Accessor: Backward compatibility for 'status' attribute
     * Maps is_active (boolean) to status (string)
     */
    public function getStatusAttribute(): string
    {
        return $this->is_active ? 'active' : 'inactive';
    }

    /**
     * Check if banner is currently active and within date range
     */
    public function isCurrentlyActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();

        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        return true;
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
