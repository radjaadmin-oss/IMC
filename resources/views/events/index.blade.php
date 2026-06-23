@extends('layouts.app')
@section('title', 'Jelajahi Event — Radjatiket')
@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- ═══════════════════════════════════════════════════════════════
        HEADER
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-white mb-2 tracking-wider">JELAJAHI EVENT</h1>
        <p class="text-gray-400 text-sm">Temukan event menarik untukmu</p>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
        FILTER & SEARCH (Optional - Coming Soon)
    ═══════════════════════════════════════════════════════════════ --}}
    {{--
    <div class="mb-8 flex flex-wrap gap-4">
        <input type="search" placeholder="Cari event..." class="...">
        <select class="...">Kategori</select>
        <select class="...">Lokasi</select>
    </div>
    --}}

    {{-- ═══════════════════════════════════════════════════════════════
        EVENT GRID
    ═══════════════════════════════════════════════════════════════ --}}
    @if($events->isEmpty())
        <div class="bg-[#0B1220] rounded-2xl p-20 text-center border border-white/10">
            <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <p class="text-gray-400 font-medium mb-1">Belum ada event</p>
            <p class="text-gray-600 text-sm">Event akan segera hadir. Pantau terus!</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($events as $event)
                <a href="{{ route('events.show', $event) }}"
                   class="bg-[#0B1220] rounded-2xl overflow-hidden border border-white/10 hover:border-[#F5C518]/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-[#F5C518]/10 group block">

                    {{-- Image --}}
                    <div class="relative aspect-video overflow-hidden">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}"
                                 alt="{{ $event->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
                        @else
                            <div class="w-full h-full bg-white/5 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Sold Out Overlay --}}
                        @if($event->is_sold_out)
                            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center">
                                <span class="text-xs font-bold tracking-widest px-4 py-2 rounded-full
                                             bg-red-500/20 border border-red-500/40 text-red-400">
                                    TIKET HABIS
                                </span>
                            </div>
                        @endif

                        {{-- Date Badge --}}
                        <div class="absolute top-3 left-3">
                            <span class="text-xs px-3 py-1 rounded-full bg-black/60 text-gray-300 backdrop-blur-sm border border-white/10">
                                {{ $event->date->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5">
                        <h3 class="text-white font-bold text-lg mb-1 line-clamp-1 group-hover:text-[#F5C518] transition-colors">
                            {{ $event->title }}
                        </h3>
                        <p class="text-gray-500 text-sm mb-4 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ Str::limit($event->location, 25) }}
                        </p>

                                                <div class="flex items-center justify-between mb-3">
                            @if($event->is_free || $event->lowest_price == 0)
                                <span class="text-green-400 font-bold">GRATIS</span>
                            @else
                                <span class="text-[#F5C518] font-bold">
                                    Rp {{ number_format($event->lowest_price, 0, ',', '.') }}
                                </span>
                            @endif

                            <span class="text-xs text-gray-500">
                                {{ $event->remaining_quota }} tiket tersisa
                            </span>
                        </div>


                        {{-- ═══════════════════════════════════════════════════════════
                            PRESENTED BY SECTION - Event Organizer Info
                        ═══════════════════════════════════════════════════════════ --}}
                        @if($event->organizer)
                            <div class="pt-3 mt-3 border-t border-white/5">
                                <div class="flex items-center gap-2">
                                    {{-- EO Avatar --}}
                                    <div class="flex-shrink-0">
                                        @if($event->organizer->avatar)
                                            <img src="{{ asset('storage/' . $event->organizer->avatar) }}"
                                                 alt="{{ $event->organizer->name }}"
                                                 class="w-8 h-8 rounded-full object-cover border-2 border-[#F5C518]/20">
                                        @else
                                            {{-- Fallback: Initial Circle (Gold) --}}
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#F5C518] to-[#d4a617] flex items-center justify-center border-2 border-[#F5C518]/20">
                                                <span class="text-black font-bold text-xs">
                                                    {{ strtoupper(substr($event->organizer->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- EO Company Name --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="text-[9px] text-slate-500 mb-0.5">Presented by</p>
                                        <p class="text-[11px] text-slate-300 font-medium truncate">
                                            {{ $event->organizer->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($events->hasPages())
            <div class="mt-10">
                {{ $events->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
