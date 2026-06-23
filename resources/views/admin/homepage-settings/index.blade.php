@extends('layouts.admin-master')

@section('title', 'Homepage Settings')

@section('page-title', 'Homepage Settings')

@section('content')

{{-- SUCCESS ALERT --}}
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
     class="mb-6 bg-green-500/10 border border-green-500/30 rounded-xl p-4 flex items-start gap-3">
    <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div class="flex-1">
        <p class="text-sm text-green-400 font-medium">{{ session('success') }}</p>
    </div>
    <button @click="show = false" class="text-green-400/60 hover:text-green-400">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>
</div>
@endif

{{-- FORM --}}
<form action="{{ route('admin.homepage-settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="space-y-4">

        {{-- ============================================ --}}
        {{-- LOGO & BRANDING SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-white mb-1">🎨 Logo & Branding</h3>
                <p class="text-sm text-[#A1A1AA]">Upload logo dan atur identitas brand</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Logo Upload --}}
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Logo Situs</label>
                    
                    @if(isset($settings->logo) && $settings->logo)
                        <div class="mb-4 p-4 bg-black border border-[#242424] rounded-xl">
                            <img src="{{ asset('storage/' . $settings->logo) }}" 
                                 alt="Current Logo" 
                                 class="h-16 w-auto object-contain">
                            <p class="text-xs text-[#A1A1AA] mt-2">📷 Logo saat ini</p>
                        </div>
                    @endif
                    
                    <input type="file" 
                           name="logo" 
                           accept="image/png,image/jpg,image/jpeg,image/svg+xml" 
                           class="w-full text-sm text-white
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-gradient-to-r file:from-[#F5C518] file:to-[#D4A017]
                                  file:text-black
                                  hover:file:from-[#D4A017] hover:file:to-[#F5C518]
                                  file:cursor-pointer file:transition-all
                                  border border-[#242424] rounded-xl
                                  bg-black p-2 cursor-pointer">
                    
                    <p class="mt-2 text-xs text-[#A1A1AA]">
                        Format: PNG, JPG, SVG (Max: 2MB)<br>
                        Rekomendasi: Background transparan, 200x60px
                    </p>
                    
                    @error('logo')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Site Info --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Nama Situs *</label>
                        <input type="text" 
                               name="site_name" 
                               value="{{ old('site_name', $settings->site_name ?? 'RADJATIKET') }}" 
                               required 
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                        @error('site_name')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Tagline</label>
                        <input type="text" 
                               name="site_tagline" 
                               value="{{ old('site_tagline', $settings->site_tagline ?? '') }}" 
                               placeholder="Your Professional Ticketing Partner" 
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- HERO BANNER SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-white mb-1">🎯 Hero Banner</h3>
                <p class="text-sm text-[#A1A1AA]">Konten utama di bagian atas homepage</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Judul Hero *</label>
                    <input type="text" 
                           name="hero_title" 
                           value="{{ old('hero_title', $settings->hero_title ?? 'Festival Musik Senja') }}" 
                           required 
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                    @error('hero_title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Subtitle Hero (Optional)</label>
                    <input type="text" 
                           name="hero_subtitle" 
                           value="{{ old('hero_subtitle', $settings->hero_subtitle ?? '') }}" 
                           placeholder="Subtitle hero banner" 
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- FEATURES SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">· Features Section</h3>
                    <p class="text-sm text-[#A1A1AA]">4 fitur unggulan yang ditampilkan di homepage</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="show_features" 
                           value="1"
                           {{ ($settings->show_features ?? true) ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                    <span class="ms-3 text-sm font-medium text-[#A1A1AA]">Show</span>
                </label>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @for($i = 1; $i <= 4; $i++)
                <div class="bg-black border border-[#242424] rounded-xl p-4">
                    <p class="text-xs font-bold text-[#F5C518] mb-3 uppercase">Feature {{ $i }}</p>
                    <div class="space-y-3">
                        <input type="text" 
                               name="feature_{{ $i }}_title" 
                               value="{{ old("feature_{$i}_title", $settings->{"feature_{$i}_title"} ?? '') }}" 
                               placeholder="Judul Feature {{ $i }}" 
                               class="w-full px-3 py-2 text-sm bg-[#111111] border border-[#242424] rounded-lg text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                        <input type="text" 
                               name="feature_{{ $i }}_subtitle" 
                               value="{{ old("feature_{$i}_subtitle", $settings->{"feature_{$i}_subtitle"} ?? '') }}" 
                               placeholder="Subtitle Feature {{ $i }}" 
                               class="w-full px-3 py-2 text-xs bg-[#111111] border border-[#242424] rounded-lg text-[#A1A1AA] placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]">
                    </div>
                </div>
                @endfor
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- REKOMENDASI EVENT SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">🎪 Rekomendasi Event</h3>
                    <p class="text-sm text-[#A1A1AA]">Section yang menampilkan event pilihan</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="show_recommended_events" 
                           value="1"
                           {{ $settings->show_recommended_events ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                    <span class="ms-3 text-sm font-medium text-[#A1A1AA]">Show</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Title *</label>
                    <input type="text" 
                           name="recommended_events_title" 
                           value="{{ old('recommended_events_title', $settings->recommended_events_title) }}"
                           required
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                    @error('recommended_events_title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Subtitle (Optional)</label>
                    <input type="text" 
                           name="recommended_events_subtitle" 
                           value="{{ old('recommended_events_subtitle', $settings->recommended_events_subtitle) }}"
                           placeholder="Kalimat pendek deskripsi"
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- EVENT TERDEKAT SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">📍 Event Terdekat</h3>
                    <p class="text-sm text-[#A1A1AA]">Event yang akan segera berlangsung</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="show_nearest_events" 
                           value="1"
                           {{ $settings->show_nearest_events ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                    <span class="ms-3 text-sm font-medium text-[#A1A1AA]">Show</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Title *</label>
                    <input type="text" 
                           name="nearest_events_title" 
                           value="{{ old('nearest_events_title', $settings->nearest_events_title) }}"
                           required
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Subtitle (Optional)</label>
                    <input type="text" 
                           name="nearest_events_subtitle" 
                           value="{{ old('nearest_events_subtitle', $settings->nearest_events_subtitle) }}"
                           placeholder="Kalimat pendek deskripsi"
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- UPCOMING EVENT SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">📅 Upcoming Event</h3>
                    <p class="text-sm text-[#A1A1AA]">Event yang akan datang</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="show_upcoming_events" 
                           value="1"
                           {{ $settings->show_upcoming_events ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                    <span class="ms-3 text-sm font-medium text-[#A1A1AA]">Show</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Title *</label>
                    <input type="text" 
                           name="upcoming_events_title" 
                           value="{{ old('upcoming_events_title', $settings->upcoming_events_title) }}"
                           required
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Subtitle (Optional)</label>
                    <input type="text" 
                           name="upcoming_events_subtitle" 
                           value="{{ old('upcoming_events_subtitle', $settings->upcoming_events_subtitle) }}"
                           placeholder="Kalimat pendek deskripsi"
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- POPULAR EVENT SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">🔥 Popular Event</h3>
                    <p class="text-sm text-[#A1A1AA]">Event paling populer</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="show_popular_events" 
                           value="1"
                           {{ $settings->show_popular_events ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                    <span class="ms-3 text-sm font-medium text-[#A1A1AA]">Show</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Title *</label>
                    <input type="text" 
                           name="popular_events_title" 
                           value="{{ old('popular_events_title', $settings->popular_events_title) }}"
                           required
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Subtitle (Optional)</label>
                    <input type="text" 
                           name="popular_events_subtitle" 
                           value="{{ old('popular_events_subtitle', $settings->popular_events_subtitle) }}"
                           placeholder="Kalimat pendek deskripsi"
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- KATEGORI EVENT SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">🎭 Kategori Event</h3>
                    <p class="text-sm text-[#A1A1AA]">Kategori event yang tersedia</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="show_categories" 
                           value="1"
                           {{ $settings->show_categories ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                    <span class="ms-3 text-sm font-medium text-[#A1A1AA]">Show</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Title *</label>
                    <input type="text" 
                           name="categories_title" 
                           value="{{ old('categories_title', $settings->categories_title) }}"
                           required
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Subtitle (Optional)</label>
                    <input type="text" 
                           name="categories_subtitle" 
                           value="{{ old('categories_subtitle', $settings->categories_subtitle) }}"
                           placeholder="Kalimat pendek deskripsi"
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- REGIONS SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">🗺️ Temukan Event di Kotamu</h3>
                    <p class="text-sm text-[#A1A1AA]">Section pencarian event berdasarkan wilayah</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="show_regions" 
                           value="1"
                           {{ $settings->show_regions ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                    <span class="ms-3 text-sm font-medium text-[#A1A1AA]">Show</span>
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Title *</label>
                    <input type="text" 
                           name="regions_title" 
                           value="{{ old('regions_title', $settings->regions_title) }}"
                           required
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Section Subtitle (Optional)</label>
                    <input type="text" 
                           name="regions_subtitle" 
                           value="{{ old('regions_subtitle', $settings->regions_subtitle) }}"
                           placeholder="Kalimat pendek deskripsi"
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                </div>
            </div>
        </div>

                {{-- ============================================ --}}
        {{-- FOOTER SETTINGS SECTION --}}
        {{-- ============================================ --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-white mb-1">🔗 Footer Settings</h3>
                <p class="text-sm text-[#A1A1AA]">Kelola konten footer (tagline, social media, copyright)</p>
            </div>

            {{-- Footer Tagline --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Footer Tagline</label>
                <input type="text"
                       name="footer_tagline"
                       value="{{ old('footer_tagline', $settings->footer_tagline ?? 'Your Professional Ticketing Partner') }}"
                       placeholder="Your Professional Ticketing Partner"
                       class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
            </div>

            {{-- Social Media Links --}}
            <div class="mb-6">
                <h4 class="text-sm font-bold text-white mb-4">Social Media Links</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-[#A1A1AA] mb-2">Instagram URL</label>
                        <input type="url"
                               name="social_instagram"
                               value="{{ old('social_instagram', $settings->social_instagram ?? '') }}"
                               placeholder="https://instagram.com/radjatiket"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#A1A1AA] mb-2">TikTok URL</label>
                        <input type="url"
                               name="social_tiktok"
                               value="{{ old('social_tiktok', $settings->social_tiktok ?? '') }}"
                               placeholder="https://tiktok.com/@radjatiket"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#A1A1AA] mb-2">YouTube URL</label>
                        <input type="url"
                               name="social_youtube"
                               value="{{ old('social_youtube', $settings->social_youtube ?? '') }}"
                               placeholder="https://youtube.com/@radjatiket"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#A1A1AA] mb-2">Facebook URL</label>
                        <input type="url"
                               name="social_facebook"
                               value="{{ old('social_facebook', $settings->social_facebook ?? '') }}"
                               placeholder="https://facebook.com/radjatiket"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#A1A1AA] mb-2">Twitter/X URL</label>
                        <input type="url"
                               name="social_twitter"
                               value="{{ old('social_twitter', $settings->social_twitter ?? '') }}"
                               placeholder="https://twitter.com/radjatiket"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-[#A1A1AA] mb-2">WhatsApp (Phone Number)</label>
                        <input type="text"
                               name="social_whatsapp"
                               value="{{ old('social_whatsapp', $settings->social_whatsapp ?? '') }}"
                               placeholder="6281234567890"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]">
                        <p class="text-xs text-[#71717A] mt-1">Format: 6281234567890 (tanpa +)</p>
                    </div>
                </div>
            </div>

            {{-- Copyright Text --}}
            <div>
                <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Copyright Text</label>
                <input type="text"
                       name="footer_copyright"
                       value="{{ old('footer_copyright', $settings->footer_copyright ?? '© 2026 RADJATIKET, Hak Cipta Dilindungi.') }}"
                       placeholder="© 2026 RADJATIKET, Hak Cipta Dilindungi."
                       class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
            </div>

            {{-- Info: Footer Menu Management --}}
            <div class="mt-6 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-blue-400 font-medium mb-1">▪ Footer Menu Links</p>
                        <p class="text-xs text-blue-400/80">
                            Footer menu links akan dikembangkan di fase berikutnya.<br>
                            Saat ini menggunakan default: Tentang Kami, Informasi, dan Kategori Event.
                        </p>
                    </div>
                </div>
            </div>
        </div>


        {{-- ============================================ --}}
        {{-- SAVE BUTTON --}}
        {{-- ============================================ --}}
        <div class="flex items-center justify-end gap-3 sticky bottom-4 z-10">
            <a href="{{ route('admin.index') }}" 
               class="px-6 py-3 rounded-xl bg-[#111111] border border-[#242424] text-white font-semibold hover:bg-black transition-colors">
                Cancel
            </a>
            <button type="submit" 
                    class="px-8 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold hover:from-[#D4A017] hover:to-[#F5C518] transition-all shadow-lg hover:shadow-xl hover:shadow-[#F5C518]/20 hover:scale-105">
                💾 Save Settings
            </button>
        </div>

    </div>

</form>

@endsection
