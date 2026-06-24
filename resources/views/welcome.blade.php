{{-- ═══════════════════════════════════════════════════════════ --}}
{{-- RADJATIKET HOMEPAGE - ARTATIX INSPIRED LAYOUT --}}
{{-- Dark Navy + Gold Premium Theme --}}
{{-- ═══════════════════════════════════════════════════════════ --}}

@extends('layouts.app')
@section('title', 'RADJATIKET — Your Professional Ticketing Partner')

@section('content')

{{-- START HERO BANNER SLIDER --}}
@if(config('app.debug'))
    {{-- DEBUG INFO (only in development) --}}
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded mb-4 max-w-7xl mx-auto" role="alert">
        <p class="font-bold">🔍 Hero Debug Info:</p>
        <ul class="text-sm mt-2 space-y-1">
            <li>• Banner Count: <strong>{{ $banners->count() }}</strong></li>
            @if($banners->count() > 0)
                @foreach($banners as $debugBanner)
                    <li>• Banner #{{ $loop->iteration }}: "{{ $debugBanner->title }}" 
                        - Desktop: <code class="bg-yellow-200 px-1">{{ $debugBanner->desktop_image }}</code>
                        @if($debugBanner->mobile_image)
                            - Mobile: <code class="bg-yellow-200 px-1">{{ $debugBanner->mobile_image }}</code>
                        @endif
                        - URL: <code class="bg-yellow-200 px-1 text-xs">{{ asset('storage/' . $debugBanner->desktop_image) }}</code>
                    </li>
                @endforeach
            @endif
            <li>• Storage Link Status: Check if <code class="bg-yellow-200 px-1">public/storage</code> symlink exists</li>
            <li>• Run: <code class="bg-yellow-200 px-1">php artisan storage:link</code> if images don't display</li>
        </ul>
    </div>
@endif

<section class="bg-white py-8" 
         x-data="heroSlider()" 
         @keydown.arrow-left="prev(); stopAutoplay(); startAutoplay();"
         @keydown.arrow-right="next(); stopAutoplay(); startAutoplay();"
         aria-label="Banner promosi">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Banner Container --}}
        <div class="relative rounded-3xl overflow-hidden shadow-lg bg-gray-100">
            
            {{-- Banner Slides --}}
            <div class="relative w-full h-[220px] md:h-[400px] lg:h-[600px]"
                 @touchstart="touchStart($event)"
                 @touchend="touchEnd($event)">
                
                @forelse($banners as $index => $banner)
                    {{-- Individual Slide --}}
                    <div x-show="currentSlide === {{ $index }}"
                         x-transition:enter="transition ease-in-out duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in-out duration-500"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="absolute inset-0">
                        
                        @if($banner->event_id && $banner->event)
                            {{-- Clickable Banner (linked to event) --}}
                            <a href="{{ route('events.show', $banner->event) }}" 
                               class="block w-full h-full cursor-pointer hover:opacity-95 transition-opacity">
                                <picture>
                                    @if($banner->mobile_image)
                                        <source media="(max-width: 767px)" 
                                                srcset="{{ asset('storage/' . $banner->mobile_image) }}">
                                    @endif
                                    
                                    <img src="{{ asset('storage/' . $banner->desktop_image) }}" 
                                         alt="{{ $banner->title }}"
                                         class="w-full h-full object-cover"
                                         loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%221920%22 height=%22600%22%3E%3Crect fill=%22%23e5e7eb%22 width=%221920%22 height=%22600%22/%3E%3Ctext fill=%22%23374151%22 font-family=%22Arial%22 font-size=%2224%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3EImage not found: {{ $banner->desktop_image }}%3C/text%3E%3C/svg%3E'; this.parentElement.parentElement.classList.add('bg-red-50', 'border-2', 'border-red-300');">
                                </picture>
                            </a>
                        @else
                            {{-- Display-only Banner (no event link) --}}
                            <picture>
                                @if($banner->mobile_image)
                                    <source media="(max-width: 767px)" 
                                            srcset="{{ asset('storage/' . $banner->mobile_image) }}">
                                @endif
                                
                                <img src="{{ asset('storage/' . $banner->desktop_image) }}" 
                                     alt="{{ $banner->title }}"
                                     class="w-full h-full object-cover"
                                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%221920%22 height=%22600%22%3E%3Crect fill=%22%23e5e7eb%22 width=%221920%22 height=%22600%22/%3E%3Ctext fill=%22%23374151%22 font-family=%22Arial%22 font-size=%2224%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3EImage not found: {{ $banner->desktop_image }}%3C/text%3E%3C/svg%3E'; this.parentElement.classList.add('bg-red-50', 'border-2', 'border-red-300');">
                            </picture>
                        @endif
                        
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                        <div class="text-center px-6">
                            <svg class="w-16 h-16 md:w-20 md:h-20 text-gray-400 mx-auto mb-4" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="text-lg md:text-xl font-bold text-gray-700 mb-2">Belum Ada Banner Promo</h3>
                            <p class="text-sm text-gray-500 mb-4">Banner promosi akan ditampilkan di sini</p>
                            
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.banners.index') }}" 
                                       class="inline-block px-6 py-2.5 rounded-xl bg-primary-600 text-white text-sm font-semibold hover:bg-primary-700 transition-colors">
                                        Kelola Banner
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforelse
                
            </div>
            
            @if($banners->count() > 1)
                {{-- Previous Button --}}
                <button @click="prev(); stopAutoplay(); startAutoplay();"
                        aria-label="Banner sebelumnya"
                        class="absolute left-4 top-1/2 -translate-y-1/2 z-10 
                               w-10 h-10 md:w-12 md:h-12 
                               rounded-full 
                               bg-black/40 backdrop-blur-sm
                               text-white
                               hover:bg-black/60 
                               transition-all duration-300
                               flex items-center justify-center
                               focus:outline-none focus:ring-2 focus:ring-white/50
                               group">
                    <svg class="w-5 h-5 md:w-6 md:h-6 group-hover:scale-110 transition-transform" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                {{-- Next Button --}}
                <button @click="next(); stopAutoplay(); startAutoplay();"
                        aria-label="Banner berikutnya"
                        class="absolute right-4 top-1/2 -translate-y-1/2 z-10 
                               w-10 h-10 md:w-12 md:h-12 
                               rounded-full 
                               bg-black/40 backdrop-blur-sm
                               text-white
                               hover:bg-black/60 
                               transition-all duration-300
                               flex items-center justify-center
                               focus:outline-none focus:ring-2 focus:ring-white/50
                               group">
                    <svg class="w-5 h-5 md:w-6 md:h-6 group-hover:scale-110 transition-transform" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                {{-- Dot Indicators --}}
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-10 flex items-center gap-2">
                    @foreach($banners as $dotIndex => $banner)
                        <button @click="goToSlide({{ $dotIndex }})"
                                :class="currentSlide === {{ $dotIndex }} ? 'bg-white w-8' : 'bg-white/40 w-2'"
                                aria-label="Ke banner {{ $dotIndex + 1 }}"
                                class="h-2 rounded-full transition-all duration-300 hover:bg-white/80 focus:outline-none focus:ring-1 focus:ring-white">
                        </button>
                    @endforeach
                </div>
            @endif
            
        </div>
        
    </div>
</section>
{{-- END HERO BANNER SLIDER --}}

{{-- START BENEFIT SECTION --}}
<section class="py-16 bg-white">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-gray-900 mb-3">Kenapa Harus RADJATIKET?</h2>
            <p class="text-gray-600">Layanan terbaik untuk pengalaman pembelian tiket yang mudah dan aman</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            {{-- Benefit 1: Aman dan Terpercaya --}}
            <div class="bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-primary-300 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Aman dan Terpercaya</h3>
                <p class="text-gray-600 text-sm">Transaksi aman dengan sistem keamanan berlapis dan terpercaya</p>
            </div>
            
            {{-- Benefit 2: Tiket Resmi --}}
            <div class="bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-primary-300 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tiket Resmi</h3>
                <p class="text-gray-600 text-sm">Semua tiket dijamin asli dan resmi dari penyelenggara event</p>
            </div>
            
            {{-- Benefit 3: Promo Menarik --}}
            <div class="bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-primary-300 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Promo Menarik</h3>
                <p class="text-gray-600 text-sm">Dapatkan diskon dan cashback untuk pembelian tiket event favorit</p>
            </div>
            
            {{-- Benefit 4: Pembayaran Mudah --}}
            <div class="bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-primary-300 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Pembayaran Mudah</h3>
                <p class="text-gray-600 text-sm">Berbagai metode pembayaran: Transfer, E-wallet, QRIS, dan lainnya</p>
            </div>
            
            {{-- Benefit 5: Bantuan 24 Jam --}}
            <div class="bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-primary-300 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-yellow-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Bantuan 24 Jam</h3>
                <p class="text-gray-600 text-sm">Tim support siap membantu Anda kapan saja melalui chat dan email</p>
            </div>
            
            {{-- Benefit 6: Refund dan Reschedule --}}
            <div class="bg-white p-8 rounded-2xl border-2 border-gray-200 hover:border-primary-300 hover:shadow-xl transition-all group">
                <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Refund dan Reschedule</h3>
                <p class="text-gray-600 text-sm">Proses refund dan reschedule yang cepat jika event dibatalkan</p>
            </div>
            
        </div>
    </div>
</section>
{{-- END BENEFIT SECTION --}}

{{-- START PAYMENT PROMO SECTION --}}
<section class="py-16 bg-gradient-to-br from-black to-gray-900 relative overflow-hidden">
    {{-- Decorative Background --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary-600/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-600/10 rounded-full blur-3xl"></div>
    
    <div class="max-w-[1280px] mx-auto px-6 relative z-10">
        
        <div class="text-center mb-12">
            <div class="inline-block px-4 py-1.5 bg-primary-600 rounded-full text-white text-xs font-bold mb-4">
                💳 METODE PEMBAYARAN
            </div>
            <h2 class="text-3xl font-black text-white mb-3">Bayar dengan Mudah</h2>
            <p class="text-gray-300">Pilih metode pembayaran favorit Anda dengan cashback hingga 50%</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-12">
            
            {{-- QRIS --}}
            <div class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:border-primary-600 hover:bg-white/10 transition-all group">
                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-10 h-10 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h8v8H3V3zm10 0h8v8h-8V3zM3 13h8v8H3v-8zm10 0h8v8h-8v-8z"/>
                    </svg>
                </div>
                <p class="text-white text-center font-semibold text-sm">QRIS</p>
            </div>
            
            {{-- GoPay --}}
            <div class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:border-primary-600 hover:bg-white/10 transition-all group">
                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="text-2xl font-black text-[#00AED6]">Go</span>
                </div>
                <p class="text-white text-center font-semibold text-sm">GoPay</p>
            </div>
            
            {{-- OVO --}}
            <div class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:border-primary-600 hover:bg-white/10 transition-all group">
                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="text-2xl font-black text-[#4C3494]">OVO</span>
                </div>
                <p class="text-white text-center font-semibold text-sm">OVO</p>
            </div>
            
            {{-- DANA --}}
            <div class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:border-primary-600 hover:bg-white/10 transition-all group">
                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="text-2xl font-black text-[#118EEA]">DANA</span>
                </div>
                <p class="text-white text-center font-semibold text-sm">DANA</p>
            </div>
            
            {{-- ShopeePay --}}
            <div class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:border-primary-600 hover:bg-white/10 transition-all group">
                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="text-xl font-black text-[#EE4D2D]">Shopee</span>
                </div>
                <p class="text-white text-center font-semibold text-sm">ShopeePay</p>
            </div>
            
            {{-- LinkAja --}}
            <div class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:border-primary-600 hover:bg-white/10 transition-all group">
                <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="text-xl font-black text-[#ED1C24]">Link</span>
                </div>
                <p class="text-white text-center font-semibold text-sm">LinkAja</p>
            </div>
            
        </div>
        
        {{-- Cashback Banner --}}
        <div class="bg-gradient-to-r from-primary-600 to-red-700 rounded-3xl p-8 text-center border-2 border-white/20">
            <h3 class="text-2xl font-black text-white mb-2">🎉 Cashback Hingga 50%</h3>
            <p class="text-white/90 mb-4">Gunakan metode pembayaran digital dan dapatkan cashback langsung!</p>
            <button class="px-8 py-3 bg-white text-primary-600 font-bold rounded-xl hover:bg-gray-100 transition-all shadow-xl">
                Selengkapnya
            </button>
        </div>
        
    </div>
</section>
{{-- END PAYMENT PROMO SECTION --}}

{{-- START REKOMENDASI EVENT SECTION --}}
@if(($settings->show_recommended_events ?? true) && isset($recommendedEvents) && $recommendedEvents->isNotEmpty())
<section class="py-10">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-gray-900">{{ $settings->recommended_events_title ?? 'Rekomendasi Event' }}</h2>
            <a href="{{ route('events.index') }}" class="flex items-center gap-1.5 text-primary-600 text-xs font-semibold hover:gap-2 transition-all">
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
<section class="py-10 bg-gray-50">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="text-center mb-5">
            <h2 class="text-xl font-bold text-gray-900">{{ $settings->categories_title ?? 'Kategori Event' }}</h2>
            @if($settings->categories_subtitle)
                <p class="text-gray-600 mt-2">{{ $settings->categories_subtitle }}</p>
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
                   class="category-card flex flex-col items-center gap-4 p-6 rounded-xl bg-white hover:shadow-lg border border-gray-200 hover:border-primary-300 transition-all duration-300 group">
                    
                    <div class="w-14 h-14 rounded-full bg-primary-50 flex items-center justify-center group-hover:scale-110 group-hover:bg-primary-100 transition-all duration-300 text-primary-600">
                        {!! $category['icon'] !!}
                    </div>
                    
                    <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors text-center font-medium">
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
                <h2 class="text-xl font-bold text-gray-900">{{ $settings->nearest_events_title ?? 'Event Terdekat' }}</h2>
                @if($settings->nearest_events_subtitle)
                    <p class="text-gray-600 mt-1">{{ $settings->nearest_events_subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('events.index') }}" class="flex items-center gap-1.5 text-primary-600 text-xs font-semibold hover:gap-2 transition-all">
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
<section class="py-10 bg-gray-50">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $settings->upcoming_events_title ?? 'Upcoming Event' }}</h2>
                @if($settings->upcoming_events_subtitle)
                    <p class="text-gray-600 mt-1">{{ $settings->upcoming_events_subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('events.index') }}" class="flex items-center gap-1.5 text-primary-600 text-xs font-semibold hover:gap-2 transition-all">
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
                <h2 class="text-xl font-bold text-gray-900">{{ $settings->popular_events_title ?? 'Popular Event' }}</h2>
                @if($settings->popular_events_subtitle)
                    <p class="text-gray-600 mt-1">{{ $settings->popular_events_subtitle }}</p>
                @endif
            </div>
            <a href="{{ route('events.index', ['sort' => 'popular']) }}" class="flex items-center gap-1.5 text-primary-600 text-xs font-semibold hover:gap-2 transition-all">
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
<section class="py-16 bg-gray-50">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <div class="bg-white rounded-3xl p-10 border border-gray-200 shadow-lg">
            
            <h2 class="text-xl font-bold text-gray-900 mb-2 text-center">{{ $settings->regions_title ?? 'Temukan Event Menarik di Kotamu' }}</h2>
            <p class="text-gray-600 text-center mb-8 max-w-2xl mx-auto">
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
                       class="city-card flex flex-col items-center gap-4 p-6 rounded-xl bg-gray-50 hover:bg-white hover:shadow-md border border-gray-200 hover:border-primary-300 transition-all duration-300 group">
                        
                        <div class="w-14 h-14 rounded-full bg-primary-50 flex items-center justify-center group-hover:scale-110 group-hover:bg-primary-100 transition-all duration-300 text-primary-600">
                            {!! $city['icon'] !!}
                        </div>
                        
                        <span class="text-xs text-gray-700 group-hover:text-primary-600 transition-colors text-center font-medium leading-tight">
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

<script>
/**
 * Hero Banner Slider - AlpineJS Component
 * Auto-slides every 5 seconds with manual controls
 */
function heroSlider() {
    return {
        currentSlide: 0,
        totalSlides: {{ $banners->count() }},
        autoplayInterval: null,
        touchStartX: 0,
        touchEndX: 0,
        
        init() {
            this.startAutoplay();
        },
        
        startAutoplay() {
            // Don't start autoplay if 0 or 1 slides
            if (this.totalSlides <= 1) return;
            
            this.autoplayInterval = setInterval(() => {
                this.next();
            }, 5000); // 5 seconds
        },
        
        stopAutoplay() {
            if (this.autoplayInterval) {
                clearInterval(this.autoplayInterval);
            }
        },
        
        next() {
            if (this.totalSlides <= 1) return;
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        },
        
        prev() {
            if (this.totalSlides <= 1) return;
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        },
        
        goToSlide(index) {
            this.currentSlide = index;
            this.stopAutoplay();
            this.startAutoplay(); // Restart autoplay after manual navigation
        },
        
        touchStart(event) {
            this.touchStartX = event.touches[0].clientX;
        },
        
        touchEnd(event) {
            this.touchEndX = event.changedTouches[0].clientX;
            this.handleSwipe();
        },
        
        handleSwipe() {
            const diff = this.touchStartX - this.touchEndX;
            
            // Minimum swipe distance: 50px
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    // Swipe left - next slide
                    this.next();
                } else {
                    // Swipe right - previous slide
                    this.prev();
                }
                this.stopAutoplay();
                this.startAutoplay(); // Restart autoplay after swipe
            }
        }
    }
}
</script>

@endpush