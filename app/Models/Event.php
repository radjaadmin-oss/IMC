<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'organizer_id', 'title', 'description', 'location',
        'date', 'early_bird_end', 'time', 'price', 'quota', 
        'sold_count', 'views', 'is_featured', 'is_free', 'image',
        'status', // pending, approved, rejected
        'has_ticket_categories',
        // Section Placement
        'show_in_recommended',
        'show_in_nearest',
        'show_in_upcoming',
        'show_in_popular',
    ];

    protected $casts = [
        'date' => 'date',
        'early_bird_end' => 'datetime',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_free' => 'boolean',
        'has_ticket_categories' => 'boolean',
        // Section Placement
        'show_in_recommended' => 'boolean',
        'show_in_nearest' => 'boolean',
        'show_in_upcoming' => 'boolean',
        'show_in_popular' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function ticketCategories(): HasMany
    {
        return $this->hasMany(TicketCategory::class);
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now())->orderBy('date');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('sold_count', 'desc');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    // NEW: Section Scopes untuk Homepage
    public function scopeRecommended($query)
    {
        return $query->where('show_in_recommended', true);
    }

    public function scopeNearest($query)
    {
        return $query->where('show_in_nearest', true)->orderBy('date');
    }

    public function scopeShowUpcoming($query)
    {
        return $query->where('show_in_upcoming', true)->where('date', '>=', now());
    }

    public function scopeShowPopular($query)
    {
        return $query->where('show_in_popular', true)->orderBy('views', 'desc');
    }

    // Accessors
    public function getRemainingQuotaAttribute(): int
    {
        $sold = $this->orders()
            ->where('status', '!=', 'cancelled')
            ->sum('quantity');

        return max(0, $this->quota - $sold);
    }

    public function getIsSoldOutAttribute(): bool
    {
        return $this->remaining_quota <= 0;
    }

    public function getIsEarlyBirdAttribute(): bool
    {
        return $this->early_bird_end && now()->lt($this->early_bird_end);
    }

    public function getLowestPriceAttribute()
    {
        if ($this->ticketCategories->count() > 0) {
            return $this->ticketCategories->min('price');
        }
        return $this->price;
    }
}
