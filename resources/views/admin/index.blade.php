@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview statistik dan aktivitas terbaru')

@section('content')

{{-- STATISTICS CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
    
    {{-- Total Events --}}
    <div class="bg-[#0B1220] rounded-xl p-3.5 border border-white/5 hover:border-[#F5C518]/30 transition-all duration-300">
        <div class="flex items-center justify-between mb-2.5">
            <div class="w-9 h-9 rounded-lg bg-blue-500/10 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <span class="text-[10px] text-gray-500 uppercase tracking-wide">Total Event</span>
        </div>
        <h3 class="text-xl font-bold text-white mb-0.5">{{ number_format($stats['total_events']) }}</h3>
        <p class="text-[10px] text-gray-500">Event tersedia</p>
    </div>

    {{-- Total Orders --}}
    <div class="bg-[#0B1220] rounded-xl p-3.5 border border-white/5 hover:border-[#F5C518]/30 transition-all duration-300">
        <div class="flex items-center justify-between mb-2.5">
            <div class="w-9 h-9 rounded-lg bg-green-500/10 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <span class="text-[10px] text-gray-500 uppercase tracking-wide">Total Order</span>
        </div>
        <h3 class="text-xl font-bold text-white mb-0.5">{{ number_format($stats['total_orders']) }}</h3>
        <p class="text-[10px] text-gray-500">Pesanan berhasil</p>
    </div>

    {{-- Total Revenue --}}
    <div class="bg-[#0B1220] rounded-xl p-3.5 border border-white/5 hover:border-[#F5C518]/30 transition-all duration-300">
        <div class="flex items-center justify-between mb-2.5">
            <div class="w-9 h-9 rounded-lg bg-[#F5C518]/10 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-[10px] text-gray-500 uppercase tracking-wide">Total Revenue</span>
        </div>
        <h3 class="text-xl font-bold text-[#F5C518] mb-0.5">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
        <p class="text-[10px] text-gray-500">Pendapatan</p>
    </div>

    {{-- Total Users --}}
    <div class="bg-[#0B1220] rounded-xl p-3.5 border border-white/5 hover:border-[#F5C518]/30 transition-all duration-300">
        <div class="flex items-center justify-between mb-2.5">
            <div class="w-9 h-9 rounded-lg bg-purple-500/10 flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="text-[10px] text-gray-500 uppercase tracking-wide">Total User</span>
        </div>
        <h3 class="text-xl font-bold text-white mb-0.5">{{ number_format($stats['total_users']) }}</h3>
        <p class="text-[10px] text-gray-500">Pengguna terdaftar</p>
    </div>

</div>
{{-- RECENT SECTIONS (2 COLUMNS) --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-5">

    {{-- Latest Orders --}}
    <div class="bg-[#0B1220] rounded-xl border border-white/5">
        <div class="p-3.5 border-b border-white/5">
            <h2 class="text-sm font-bold text-white">Pesanan Terbaru</h2>
        </div>
        
        <div class="p-3.5">
            @if($latestOrders->isEmpty())
                <div class="text-center py-6">
                    <svg class="w-8 h-8 text-gray-700 mx-auto mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-gray-500 text-[10px]">Belum ada pesanan</p>
                </div>
            @else
                <div class="space-y-2">
                    @foreach($latestOrders as $order)
                        <div class="flex items-center gap-2.5 p-2.5 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-white truncate">{{ $order->event->title }}</p>
                                <p class="text-[10px] text-gray-500 mt-0.5">{{ $order->user->name }} • {{ $order->quantity }} tiket</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs font-bold text-[#F5C518]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Upcoming Events --}}
    <div class="bg-[#0B1220] rounded-xl border border-white/5">
        <div class="p-3.5 border-b border-white/5">
            <h2 class="text-sm font-bold text-white">Event Terdekat</h2>
        </div>
        
        <div class="p-3.5">
            @if($upcomingEvents->isEmpty())
                <div class="text-center py-6">
                    <svg class="w-8 h-8 text-gray-700 mx-auto mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <p class="text-gray-500 text-[10px]">Belum ada event mendatang</p>
                </div>
            @else
                <div class="space-y-2">
                    @foreach($upcomingEvents as $event)
                        <div class="flex items-center gap-2.5 p-2.5 rounded-lg bg-white/5 hover:bg-white/10 transition-all duration-300">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-white truncate">{{ $event->title }}</p>
                                <div class="flex items-center gap-1.5 text-[10px] text-gray-500 mt-0.5">
                                    <svg class="w-3 h-3 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $event->date->format('d M Y') }}</span>
                                    <span class="text-gray-600">•</span>
                                    <svg class="w-3 h-3 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs font-bold text-[#F5C518]">
                                    @if($event->price == 0)
                                        GRATIS
                                    @else
                                        Rp {{ number_format($event->price, 0, ',', '.') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</div>

{{-- QUICK ACTIONS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    
    <a href="{{ route('admin.banners.create') }}" 
       class="bg-[#0B1220] rounded-xl p-3.5 border border-white/5 hover:border-[#F5C518]/50 transition-all duration-300 group">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-[#F5C518]/10 group-hover:bg-[#F5C518]/20 flex items-center justify-center transition-all duration-300">
                <svg class="w-5 h-5 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xs font-bold text-white group-hover:text-[#F5C518] transition-colors duration-300">Tambah Banner</h3>
                <p class="text-[10px] text-gray-500">Upload banner promo baru</p>
            </div>
        </div>
    </a>

    <div class="bg-[#0B1220] rounded-xl p-3.5 border border-white/5 opacity-50 cursor-not-allowed">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-gray-700/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xs font-bold text-gray-600">Tambah Event</h3>
                <p class="text-[10px] text-gray-700">Coming soon</p>
            </div>
        </div>
    </div>

    <div class="bg-[#0B1220] rounded-xl p-3.5 border border-white/5 opacity-50 cursor-not-allowed">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-gray-700/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xs font-bold text-gray-600">Lihat Report</h3>
                <p class="text-[10px] text-gray-700">Coming soon</p>
            </div>
        </div>
    </div>

</div>

@endsection
