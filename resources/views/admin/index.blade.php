@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview statistik dan aktivitas terbaru')

@section('content')

{{-- STATISTICS CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    
    {{-- Total Events --}}
    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-xl p-4 border border-white/10 hover:border-[#F5C518]/30 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <span class="text-xs text-gray-500 uppercase tracking-wide">Total Event</span>
        </div>
        <h3 class="text-2xl font-bold text-white mb-0.5">{{ number_format($stats['total_events']) }}</h3>
        <p class="text-xs text-gray-500">Event tersedia</p>
    </div>

    {{-- Total Orders --}}
    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-xl p-4 border border-white/10 hover:border-[#F5C518]/30 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <span class="text-xs text-gray-500 uppercase tracking-wide">Total Order</span>
        </div>
        <h3 class="text-2xl font-bold text-white mb-0.5">{{ number_format($stats['total_orders']) }}</h3>
        <p class="text-xs text-gray-500">Pesanan berhasil</p>
    </div>

    {{-- Total Revenue --}}
    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-xl p-4 border border-white/10 hover:border-[#F5C518]/30 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-[#F5C518]/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-xs text-gray-500 uppercase tracking-wide">Total Revenue</span>
        </div>
        <h3 class="text-2xl font-bold text-[#F5C518] mb-0.5">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
        <p class="text-xs text-gray-500">Pendapatan</p>
    </div>

    {{-- Total Users --}}
    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-xl p-4 border border-white/10 hover:border-[#F5C518]/30 transition-all">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="text-xs text-gray-500 uppercase tracking-wide">Total User</span>
        </div>
        <h3 class="text-2xl font-bold text-white mb-0.5">{{ number_format($stats['total_users']) }}</h3>
        <p class="text-xs text-gray-500">Pengguna terdaftar</p>
    </div>

</div>
{{-- RECENT SECTIONS (2 COLUMNS) --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

    {{-- Latest Orders --}}
    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-xl border border-white/10">
        <div class="p-4 border-b border-white/10">
            <h2 class="text-base font-bold text-white">Pesanan Terbaru</h2>
        </div>
        
        <div class="p-4">
            @if($latestOrders->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-10 h-10 text-gray-700 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-gray-500 text-xs">Belum ada pesanan</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($latestOrders as $order)
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-white truncate">{{ $order->event->title }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $order->user->name }} • {{ $order->quantity }} tiket</p>
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
    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-xl border border-white/10">
        <div class="p-4 border-b border-white/10">
            <h2 class="text-base font-bold text-white">Event Terdekat</h2>
        </div>
        
        <div class="p-4">
            @if($upcomingEvents->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-10 h-10 text-gray-700 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <p class="text-gray-500 text-xs">Belum ada event mendatang</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($upcomingEvents as $event)
                        <div class="flex items-center gap-3 p-3 rounded-lg bg-white/5 hover:bg-white/10 transition-all">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-white truncate">{{ $event->title }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    📅 {{ $event->date->format('d M Y') }} • 📍 {{ $event->location }}
                                </p>
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
       class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-xl p-4 border border-white/10 hover:border-[#F5C518]/50 transition-all group">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-[#F5C518]/10 group-hover:bg-[#F5C518]/20 flex items-center justify-center transition-all">
                <svg class="w-6 h-6 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-white group-hover:text-[#F5C518] transition-colors">Tambah Banner</h3>
                <p class="text-xs text-gray-500">Upload banner promo baru</p>
            </div>
        </div>
    </a>

    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl p-6 border border-white/10 opacity-50 cursor-not-allowed">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gray-700/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-600">Tambah Event</h3>
                <p class="text-xs text-gray-700">Coming soon</p>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl p-6 border border-white/10 opacity-50 cursor-not-allowed">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gray-700/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-600">Lihat Report</h3>
                <p class="text-xs text-gray-700">Coming soon</p>
            </div>
        </div>
    </div>

</div>

@endsection
