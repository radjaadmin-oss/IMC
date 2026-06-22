<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'event_id', 'ticket_category_id', 'order_code', 'quantity',
        'total_price', 'status', 'attendee_name',
        'attendee_email', 'attendee_phone',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public static function generateOrderCode(): string
    {
        do {
            $code = 'RDJ-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(100, 999);
        } while (self::where('order_code', $code)->exists());

        return $code;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketCategory(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'confirmed' => 'text-green-400 bg-green-400/10 border-green-400/30',
            'cancelled' => 'text-red-400 bg-red-400/10 border-red-400/30',
            default     => 'text-yellow-400 bg-yellow-400/10 border-yellow-400/30',
        };
    }

    public function getBuyerNameAttribute(): string
    {
        return $this->attendee_name ?? $this->user?->name ?? 'Guest';
    }

    public function getBuyerEmailAttribute(): string
    {
        return $this->attendee_email ?? $this->user?->email ?? '-';
    }

    public function getBuyerPhoneAttribute(): string
    {
        return $this->attendee_phone ?? '-';
    }
}
