<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'quota',
        'sold',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quota' => 'integer',
        'sold' => 'integer',
        'sort_order' => 'integer',
    ];

    // Relasi ke Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Tiket tersisa
    public function getRemainingQuotaAttribute()
    {
        return $this->quota - $this->sold;
    }

    // Apakah sold out
    public function getIsSoldOutAttribute()
    {
        return $this->remaining_quota <= 0;
    }
}
