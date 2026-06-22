@extends('layouts.app')
@section('title', $event->title . ' — Radjatiket')
@section('content')

<div class="max-w-6xl mx-auto px-4 py-6">
    
    {{-- Back Button --}}
    <a href="{{ route('events.index') }}" 
       class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-white mb-4 transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-5">
        
        {{-- LEFT: Event Details --}}
        <div class="space-y-4">
            
            {{-- Hero Image --}}
            @if($event->image)
                <div class="rounded-xl overflow-hidden aspect-[16/9]">
                    <img src="{{ asset('storage/' . $event->image) }}" 
                         alt="{{ $event->title }}"
                         class="w-full h-full object-cover"/>
                </div>
            @else
                <div class="rounded-xl aspect-[16/9] bg-white/5 border border-white/10 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif

            {{-- Title & Status --}}
            <div>
                @if($event->is_sold_out)
                    <span class="inline-block text-[10px] font-bold tracking-wider px-2.5 py-1 rounded-md
                                 bg-red-500/10 border border-red-500/30 text-red-400 mb-2">
                        SOLD OUT
                    </span>
                @else
                    <span class="inline-block text-[10px] font-bold tracking-wider px-2.5 py-1 rounded-md
                                 bg-green-500/10 border border-green-500/30 text-green-400 mb-2">
                        AVAILABLE
                    </span>
                @endif
                <h1 class="text-2xl font-bold text-white leading-tight">{{ $event->title }}</h1>
            </div>

            {{-- Meta Info --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="card-dark rounded-lg p-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#D4AF37]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] text-gray-500 uppercase">Tanggal</p>
                            <p class="text-xs text-white font-semibold truncate">{{ $event->date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-dark rounded-lg p-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#D4AF37]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] text-gray-500 uppercase">Waktu</p>
                            <p class="text-xs text-white font-semibold truncate">{{ $event->time ?? 'TBA' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-dark rounded-lg p-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-[#D4AF37]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] text-gray-500 uppercase">Lokasi</p>
                            <p class="text-xs text-white font-semibold truncate">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="card-dark rounded-lg p-4">
                <h2 class="text-sm font-bold text-white mb-3">Tentang Event</h2>
                <div class="text-gray-300 text-xs leading-relaxed whitespace-pre-line">
                    @if($event->description)
                        {{ $event->description }}
                    @else
                        <p class="text-gray-600 italic">Tidak ada deskripsi.</p>
                    @endif
                </div>
            </div>

            {{-- Info Penting --}}
            <div class="card-dark rounded-lg p-4">
                <h3 class="text-xs font-bold text-[#D4AF37] uppercase mb-3">Syarat & Ketentuan</h3>
                <ul class="space-y-2 text-xs text-gray-300">
                    <li class="flex items-start gap-2">
                        <svg class="w-3.5 h-3.5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Tiket tidak dapat dibatalkan atau dikembalikan</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-3.5 h-3.5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>E-ticket dikirim via email setelah pembayaran</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-3.5 h-3.5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Tunjukkan e-ticket saat masuk venue</span>
                    </li>
                </ul>
            </div>

        </div>

        {{-- RIGHT: Booking Card --}}
        <div class="lg:sticky lg:top-20 h-fit">
            <div class="card-dark rounded-xl p-5 space-y-4">
                
                {{-- Price --}}
                <div class="pb-4 border-b border-white/10">
                    <p class="text-[10px] text-gray-500 uppercase mb-1.5">Harga Tiket</p>
                    @if($event->price == 0)
                        <p class="text-2xl font-bold text-green-400">GRATIS</p>
                    @else
                        <p class="text-2xl font-bold text-[#D4AF37]">
                            Rp {{ number_format($event->price, 0, ',', '.') }}
                        </p>
                        <p class="text-[10px] text-gray-600">per tiket</p>
                    @endif
                </div>

                {{-- Quota --}}
                <div class="space-y-3">
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Total Kuota</span>
                        <span class="text-white font-semibold">{{ number_format($event->quota) }}</span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Tersisa</span>
                        <span class="font-semibold {{ $event->remaining_quota <= 10 && !$event->is_sold_out ? 'text-yellow-400' : 'text-white' }}">
                            {{ number_format($event->remaining_quota) }} tiket
                        </span>
                    </div>

                    {{-- Progress --}}
                    @php
                        $soldPercent = $event->quota > 0
                            ? round((($event->quota - $event->remaining_quota) / $event->quota) * 100)
                            : 0;
                    @endphp
                    <div>
                        <div class="w-full bg-white/10 rounded-full h-1 overflow-hidden">
                            <div class="h-1 rounded-full transition-all
                                {{ $soldPercent >= 100 ? 'bg-red-500' : ($soldPercent >= 75 ? 'bg-yellow-500' : 'bg-[#D4AF37]') }}"
                                 style="width: {{ $soldPercent }}%">
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-500 mt-1">{{ $soldPercent }}% terjual</p>
                    </div>
                </div>

                {{-- CTA Button --}}
                <div class="pt-1">
                    @if($event->is_sold_out)
                        <button disabled
                                class="w-full py-3 rounded-xl bg-white/5 border border-white/10
                                       text-center text-gray-500 text-sm font-bold tracking-wider cursor-not-allowed">
                            TIKET HABIS
                        </button>
                    @else
                        <a href="{{ route('orders.create', $event) }}"
                           class="block w-full py-3 rounded-xl text-center text-sm font-bold tracking-wider
                                  transition-opacity hover:opacity-90"
                           style="background: linear-gradient(135deg, #D4AF37, #F4C542); color: #000;">
                            PESAN SEKARANG
                        </a>
                    @endif
                </div>

                {{-- Low Stock Warning --}}
                @if(!$event->is_sold_out && $event->remaining_quota <= 10)
                    <div class="flex items-start gap-2 p-3 rounded-lg bg-yellow-500/10 border border-yellow-500/20">
                        <svg class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-yellow-400 text-[10px] font-semibold">Tiket hampir habis!</p>
                    </div>
                @endif

                {{-- Trust Badges --}}
                <div class="pt-3 border-t border-white/10">
                    <div class="flex items-center justify-center gap-5 text-[10px] text-gray-500">
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Aman</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <span>E-Ticket</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
