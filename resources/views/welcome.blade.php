{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- RADJATIKET HOMEPAGE - ARTATIX INSPIRED LAYOUT --}}
{{-- Dark Navy + Gold Premium Theme --}}
{{-- ═══════════════════════════════════════════════════════════ --}}

@extends('layouts.app')
@section('title', 'RADJATIKET — Your Professional Ticketing Partner')

@section('content')

{{-- START HERO BANNER SECTION --}}
<section class="mt-4 mb-5">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="swiper hero-swiper rounded-[28px] overflow-hidden shadow-2xl relative">
            <div class="swiper-wrapper">
                
                @if(isset($banners) && $banners->isNotEmpty())
                    @foreach($banners as $banner)
                        <div class="swiper-slide">
                            <a href="{{ $banner->event ? route('events.show', $banner->event) : '#' }}" class="block">
                                <div class="relative w-full aspect-[750/400] md:aspect-[1920/550]">
                                    {{-- Mobile Image (jika ada, fallback ke desktop) --}}
                                    <picture>
                                        @if($banner->mobile_image)
                                            <source media="(max-width: 768px)" srcset="{{ asset('storage/' . $banner->mobile_image) }}">
                                        @endif
                                        <img src="{{ asset('storage/' . $banner->desktop_image) }}"
                                             alt="{{ $banner->title ?? 'Event Banner' }}"
                                             class="absolute inset-0 w-full h-full object-cover">
                                    </picture>
                                    
                                    {{-- Gradient Overlay (optional) --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>
                                    
                                    {{-- Banner Title (optional, hanya jika ada) --}}
                                    @if($banner->title && strlen($banner->title) > 0 && $banner->title !== 'promosi')
                                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 pointer-events-none">
                                            <div class="max-w-7xl mx-auto">
                                                <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-white tracking-tight drop-shadow-2xl">
                                                    {{ $banner->title }}
                                                </h2>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    {{-- Dummy Banner jika database kosong --}}
                    @for($i = 1; $i <= 5; $i++)
                        <div class="swiper-slide">
                            <div class="relative w-full aspect-[750/400] md:aspect-[1920/550] bg-gradient-to-br from-[#0B1220] via-[#050B14] to-black flex items-center justify-center">
                                <div class="text-center z-10">
                                    <svg class="w-20 h-20 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-600 text-sm">Event Promo {{ $i }}</p>
                                    <p class="text-gray-700 text-xs mt-1">Temukan Event Terbaik di Indonesia</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
                
            </div>
            
            {{-- Navigation Arrows --}}
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            
            {{-- Pagination Dots --}}
            <div class="swiper-pagination"></div>
        </div>
        
    </div>
</section>
{{-- END HERO BANNER SECTION --}}
{{-- END HERO BANNER SECTION --}}
{{-- START TRUST BADGES SECTION --}}
<section class="py-6 border-y border-white/5">
    <div class="max-w-[1280px] mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            
            {{-- Badge 1: 100% Aman --}}
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-[#0B1220] border border-white/5">
                <div class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-sm">100% Aman</h4>
                    <p class="text-gray-500 text-xs">Transaksi Terpercaya</p>
                </div>
            </div>

            {{-- Badge 2: Mudah & Cepat --}}
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-[#0B1220] border border-white/5">
                <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-sm">Mudah & Cepat</h4>
                    <p class="text-gray-500 text-xs">Proses Instan</p>
                </div>
            </div>

            {{-- Badge 3: E-Ticket Instan --}}
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-[#0B1220] border border-white/5">
                <div class="w-12 h-12 rounded-full bg-yellow-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-[#F5C518]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-sm">E-Ticket Instan</h4>
                    <p class="text-gray-500 text-xs">Langsung ke Email</p>
                </div>
            </div>

            {{-- Badge 4: 24/7 Support --}}
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-[#0B1220] border border-white/5">
                <div class="w-12 h-12 rounded-full bg-purple-500/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-sm">24/7 Support</h4>
                    <p class="text-gray-500 text-xs">Siap Membantu</p>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- END TRUST BADGES SECTION --}}
{{-- START REKOMENDASI EVENT SECTION --}}
@if(($settings->show_recommended_events ?? true) && isset($recommendedEvents) && $recommendedEvents->isNotEmpty())
<section class="py-10">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-white">{{ $settings->recommended_events_title ?? 'Rekomendasi Event' }}</h2>
            <a href="{{ route('events.index') }}" class="flex items-center gap-1.5 text-[#F5C518] text-xs font-semibold hover:gap-2 transition-all">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($recommendedEvents as $event)
                @include('partials.event-card', ['event' => $event])
            @endforeach
        </div>
        
    </div>
</section>
@endif
{{-- END REKOMENDASI EVENT SECTION --}}
{{-- START KATEGORI EVENT SECTION --}}
@if($settings->show_categories ?? true)
<section class="py-10 bg-[#050B14]/50">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="text-center mb-5">
            <h2 class="text-xl font-bold text-white">{{ $settings->categories_title ?? 'Kategori Event' }}</h2>
            @if($settings->categories_subtitle)
                <p class="text-gray-400 mt-2">{{ $settings->categories_subtitle }}</p>
            @endif
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
            
            @php
            $categories = [
                [
                    'name' => 'Musik',
                    'slug' => 'musik',
                    'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/></svg>'
                ],
                [
                    'name' => 'Festival',
                    'slug' => 'festival',
                    'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"/><path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"/></svg>'
                ],
                [
                    'name' => 'Seminar',
                    'slug' => 'seminar',
                    'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/></svg>'
                ],
                [
                    'name' => 'Pameran',
                    'slug' => 'pameran',
                    'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>'
                ],
                [
                    'name' => 'Olahraga',
                    'slug' => 'olahraga',
                    'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
                ],
                [
                    'name' => 'Workshop',
                    'slug' => 'workshop',
                    'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>'
                ],
            ];
            @endphp
            
            @foreach($categories as $category)
                <a href="{{ route('events.index', ['category' => $category['slug']]) }}" 
                   class="category-card flex flex-col items-center gap-4 p-6 rounded-[18px] bg-[#0B1220] hover:bg-[#0F1520] border border-white/5 transition-all duration-300 group">
                    
                    <div class="w-14 h-14 rounded-full bg-[#F5C518]/10 flex items-center justify-center group-hover:scale-110 group-hover:bg-[#F5C518]/20 transition-all duration-300 text-[#F5C518]">
                        {!! $category['icon'] !!}
                    </div>
                    
                    <span class="text-sm text-gray-400 group-hover:text-[#F5C518] transition-colors text-center font-medium">
                        {{ $category['name'] }}
                    </span>
                    
                </a>
            @endforeach
            
        </div>
        
    </div>
</section>
@endif
{{-- END KATEGORI EVENT SECTION --}}

{{-- START EVENT TERDEKAT SECTION --}}
@if(($settings->show_nearest_events ?? true) && isset($nearestEvents) && $nearestEvents->isNotEmpty())
<section class="py-10">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-bold text-white">{{ $settings->nearest_events_title ?? 'Event Terdekat' }}</h2>
                @if($settings->nearest_events_subtitle)
                    <p class="text-gray-400 mt-1">{{ $settings->nearest_events_subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('events.index') }}" class="flex items-center gap-1.5 text-[#F5C518] text-xs font-semibold hover:gap-2 transition-all">
                Lihat Event Lainnya
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($nearestEvents->take(8) as $event)
                    @include('partials.event-card', ['event' => $event])
                @endforeach
            </div>
        </div>
</section>
@endif
{{-- END EVENT TERDEKAT SECTION --}}
{{-- START UPCOMING EVENT SECTION --}}
@if(($settings->show_upcoming_events ?? true) && isset($upcomingEvents) && $upcomingEvents->isNotEmpty())
<section class="py-10 bg-[#050B14]/50">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-bold text-white">{{ $settings->upcoming_events_title ?? 'Upcoming Event' }}</h2>
                @if($settings->upcoming_events_subtitle)
                    <p class="text-gray-400 mt-1">{{ $settings->upcoming_events_subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('events.index') }}" class="flex items-center gap-1.5 text-[#F5C518] text-xs font-semibold hover:gap-2 transition-all">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($upcomingEvents->take(8) as $event)
                    @include('partials.event-card', ['event' => $event])
                @endforeach
            </div>
        </div>
</section>
@endif
{{-- END UPCOMING EVENT SECTION --}}

{{-- START POPULAR EVENT SECTION --}}
@if(($settings->show_popular_events ?? true) && isset($popularEvents) && $popularEvents->isNotEmpty())
<section class="py-10">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-bold text-white">{{ $settings->popular_events_title ?? 'Popular Event' }}</h2>
                @if($settings->popular_events_subtitle)
                    <p class="text-gray-400 mt-1">{{ $settings->popular_events_subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('events.index', ['sort' => 'popular']) }}" class="flex items-center gap-1.5 text-[#F5C518] text-xs font-semibold hover:gap-2 transition-all">
                Lihat Semua
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($popularEvents->take(8) as $event)
                    @include('partials.event-card', ['event' => $event])
                @endforeach
            </div>
        </div>
</section>
@endif
{{-- END POPULAR EVENT SECTION --}}
{{-- START TEMUKAN EVENT DI KOTAMU SECTION --}}
@if($settings->show_regions ?? true)
<section class="py-16">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="bg-[#0B1220] rounded-[28px] p-10 border border-white/5">
            
            <h2 class="text-xl font-bold text-white mb-2 text-center">{{ $settings->regions_title ?? 'Temukan Event Menarik di Kotamu' }}</h2>
            <p class="text-gray-400 text-center mb-8 max-w-2xl mx-auto">
                {{ $settings->regions_subtitle ?? 'Jelajahi berbagai event seru di kota-kota besar Indonesia. Pilih kotamu dan temukan pengalaman tak terlupakan!' }}
            </p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 md:gap-5 lg:gap-4">
                
                @php
                $cities = [
                    [
                        'name' => 'Sumatera',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>'
                    ],
                    [
                        'name' => 'Jabodetabek',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>'
                    ],
                    [
                        'name' => 'Jawa Barat',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>'
                    ],
                    [
                        'name' => 'DIY-Jateng',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>'
                    ],
                    [
                        'name' => 'Jawa Timur',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>'
                    ],
                    [
                        'name' => 'Kalimantan',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>'
                    ],
                    [
                        'name' => 'Sulawesi',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>'
                    ],
                    [
                        'name' => 'Indonesia Timur',
                        'icon' => '<svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>'
                    ],
                ];
                @endphp
                
                @foreach($cities as $city)
                    <a href="{{ route('events.index', ['city' => strtolower($city['name'])]) }}" 
                       class="city-card flex flex-col items-center gap-4 p-6 rounded-2xl bg-gradient-to-br from-[#0F1520] to-[#0B1220] hover:from-[#121825] hover:to-[#0D1422] border border-white/5 transition-all duration-300 group">
                        
                        <div class="w-14 h-14 rounded-full bg-[#F5C518]/10 flex items-center justify-center group-hover:scale-110 group-hover:bg-[#F5C518]/20 transition-all duration-300 text-[#F5C518]">
                            {!! $city['icon'] !!}
                        </div>
                        
                        <span class="text-xs text-gray-400 group-hover:text-[#F5C518] transition-colors text-center font-medium leading-tight">
                            {{ $city['name'] }}
                        </span>
                        
                    </a>
                @endforeach
                
            </div>
            
        </div>
        
    </div>
</section>
@endif
{{-- END TEMUKAN EVENT DI KOTAMU SECTION --}}

@endsection

@push('scripts')

{{-- SwiperJS Library (sudah di-load di app.blade.php) --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ═══════════════════════════════════════════════════════════════
    // HERO BANNER SWIPER
    // ═══════════════════════════════════════════════════════════════
    
    const heroSwiper = new Swiper('.hero-swiper', {
        // Basic Config
        loop: true,
        speed: 800,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        
        // Effect: Slide (bukan fade untuk avoid shifting)
        effect: 'slide',
        
        // Slides
        slidesPerView: 1,
        spaceBetween: 0,
        
        // Navigation Arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        
        // Pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        
        // Prevent layout shifting
        watchOverflow: true,
        observer: true,
        observeParents: true,
    });
    
    console.log('✓ Hero Swiper Initialized:', heroSwiper);
});
</script>

<style>
/* ═══════════════════════════════════════════════════════════════════════════
   HERO BANNER SWIPER STYLES
═══════════════════════════════════════════════════════════════════════════ */

.hero-swiper {
    border-radius: 28px;
    overflow: hidden;
    position: relative;
    width: 100%;
}

.hero-swiper .swiper-wrapper {
    width: 100%;
}

.hero-swiper .swiper-slide {
    width: 100%;
    flex-shrink: 0;
}

.hero-swiper .swiper-slide img,
.hero-swiper .swiper-slide > div {
    width: 100%;
    height: 100%;
    display: block;
}

/* Make sure links in slides are clickable */
.hero-swiper .swiper-slide a {
    cursor: pointer;
    position: relative;
    z-index: 1;
}

/* Navigation buttons should not block banner clicks */
.hero-swiper .swiper-button-prev,
.hero-swiper .swiper-button-next {
    z-index: 10;
    pointer-events: auto;
}

/* Pagination Bullets */
.hero-swiper .swiper-pagination {
    bottom: 20px !important;
    z-index: 10;
}

.hero-swiper .swiper-pagination-bullet {
    background: #ffffff;
    opacity: 0.5;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    transition: all 0.3s ease;
    pointer-events: auto;
}

.hero-swiper .swiper-pagination-bullet-active {ve {
    background: #F5C518;
    opacity: 1;
    width: 32px;
    border-radius: 6px;
}

/* No navigation arrows - clean minimal design */

/* Navigation Arrows - Gold Theme */
.hero-swiper .swiper-button-prev,
.hero-swiper .swiper-button-next {
    width: 48px;
    height: 48px;
    background: rgba(245, 197, 24, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    border: 1px solid rgba(245, 197, 24, 0.2);
    color: #F5C518;
    transition: all 0.3s ease;
}

.hero-swiper .swiper-button-prev:hover,
.hero-swiper .swiper-button-next:hover {
    background: rgba(245, 197, 24, 0.3);
    border-color: rgba(245, 197, 24, 0.5);
    transform: scale(1.1);
    box-shadow: 0 4px 20px rgba(245, 197, 24, 0.3);
}

.hero-swiper .swiper-button-prev::after,
.hero-swiper .swiper-button-next::after {
    font-size: 18px;
    font-weight: bold;
}

/* Mobile: Hide navigation arrows */
@media (max-width: 768px) {
    .hero-swiper .swiper-button-prev,
    .hero-swiper .swiper-button-next {
        display: none;
    }
}

/* ═══════════════════════════════════════════════════════════════════════════
   PREVENT HORIZONTAL SCROLL
═══════════════════════════════════════════════════════════════════════════ */

html, body {
    overflow-x: hidden;
    max-width: 100%;
}

* {
    box-sizing: border-box;
}
</style>

@endpush