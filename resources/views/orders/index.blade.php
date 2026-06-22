@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-white mb-2">🎫 Tiket Saya</h1>
        <p class="text-gray-400">Semua tiket event yang kamu miliki</p>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="bg-[#0B1220] rounded-2xl border border-white/10 overflow-hidden hover:border-[#D4AF37]/50 transition-colors">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs text-gray-500 font-mono">{{ $order->order_code }}</span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium border {{ $order->status_color }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-1">{{ $order->event->title }}</h3>
                            <div class="flex items-center gap-4 text-sm text-gray-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $order->event->date->format('d M Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    </svg>
                                    {{ $order->quantity }} tiket
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-[#D4AF37]">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                            @if($order->ticketCategory)
                            <div class="text-xs text-gray-500 mt-1">{{ $order->ticketCategory->name }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-white/10">
                        <a href="{{ route('orders.show', $order) }}" 
                           class="flex-1 py-2 rounded-lg bg-[#D4AF37]/10 text-[#D4AF37] text-sm font-semibold text-center hover:bg-[#D4AF37]/20 transition-colors">
                            Lihat Detail
                        </a>
                        @if($order->status == 'pending')
                        <form action="{{ route('orders.cancel', $order) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin membatalkan order ini?')"
                                    class="w-full py-2 rounded-lg bg-red-500/20 text-red-400 text-sm font-semibold hover:bg-red-500/30 transition-colors">
                                Batalkan
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="inline-flex w-20 h-20 rounded-full bg-white/5 items-center justify-center mb-4">
                <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Belum Ada Tiket</h3>
            <p class="text-gray-400 mb-6">Kamu belum pernah membeli tiket event</p>
            <a href="{{ route('events.index') }}" 
               class="inline-block px-6 py-3 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#FFD700] text-black font-bold hover:from-[#FFD700] hover:to-[#D4AF37] transition-all">
                Jelajahi Event
            </a>
        </div>
    @endif

</div>
@endsection
