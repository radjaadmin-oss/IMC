<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'event_id', 
        'ticket_category_id', 
        'order_code', 
        'quantity',
        'total_price', 
        'status', 
        'payment_status',
        'payment_expired_at',
        'paid_at',
        'payment_method',
        'payment_proof',
        'attendee_name',
        'attendee_email', 
        'attendee_phone',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'payment_expired_at' => 'datetime',
        'paid_at' => 'datetime',
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

    // Status Badge Color
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'confirmed' => 'text-green-400 bg-green-400/10 border-green-400/30',
            'cancelled' => 'text-red-400 bg-red-400/10 border-red-400/30',
            default     => 'text-yellow-400 bg-yellow-400/10 border-yellow-400/30',
        };
    }

    // Payment Status Badge Color
    public function getPaymentStatusColorAttribute(): string
    {
        return match ($this->payment_status) {
            'paid'    => 'bg-[#22C55E]/10 text-[#22C55E]',
            'expired' => 'bg-[#EF4444]/10 text-[#EF4444]',
            default   => 'bg-[#F59E0B]/10 text-[#F59E0B]', // pending
        };
    }

    // Payment Status Label
    public function getPaymentStatusLabelAttribute(): string
    {
        return match ($this->payment_status) {
            'paid'    => 'Paid',
            'expired' => 'Expired',
            default   => 'Pending', // pending
        };
    }

    // Check if payment is expired
    public function isPaymentExpired(): bool
    {
        if ($this->payment_status === 'paid') {
            return false;
        }

        if ($this->payment_expired_at) {
            return Carbon::now()->isAfter($this->payment_expired_at);
        }

        return false;
    }

    // Buyer Info
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

    // Scopes
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeExpired($query)
    {
        return $query->where('payment_status', 'expired');
    }
}
