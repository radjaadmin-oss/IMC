<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RADJATIKET — Your Professional Ticketing Partner')</title>
    
    {{-- TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* ═══════════════════════════════════════════════════════ */
        /* NAVBAR CLICKABILITY FIX - AGGRESSIVE MODE */
        /* ═══════════════════════════════════════════════════════ */
        
        /* Create new stacking context for navbar */
        nav {
            position: sticky !important;
            top: 0 !important;
            z-index: 999999 !important;
            pointer-events: auto !important;
            isolation: isolate;
        }
        
        /* Force all navbar links and buttons to be clickable */
        nav *,
        nav a,
        nav button,
        nav form,
        nav input {
            pointer-events: auto !important;
            cursor: pointer !important;
            position: relative !important;
            z-index: 999999 !important;
        }
        
        /* Ensure navbar content doesn't get overlapped */
        nav > div {
            position: relative;
            z-index: 999999;
        }
        
        /* Force main content to be below navbar */
        main,
        section,
        .swiper,
        .swiper-container,
        .swiper-wrapper,
        .swiper-slide {
            position: relative;
            z-index: 1 !important;
        }
        
        /* Prevent ANY element from going above navbar */
        body > *:not(nav) {
            z-index: 1 !important;
        }
        
        /* Extra aggressive for navbar links */
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="antialiased bg-white text-gray-900">

    {{-- NAVBAR - RED TO BLACK GRADIENT --}}
    <nav class="sticky top-0 z-[9999] backdrop-blur-xl border-b border-red-900/20 shadow-lg" style="position: sticky !important; top: 0 !important; z-index: 9999 !important; background: linear-gradient(90deg, #B91C1C 0%, #DC2626 40%, #991B1B 70%, #000000 100%);">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-20">
                
                {{-- LEFT: Logo (25% width) --}}
                <div class="w-1/4 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        @php
                            $homepageSetting = \App\Models\HomepageSetting::first();
                            $logo = $homepageSetting?->logo;
                        @endphp
                        
                        @if($logo && file_exists(public_path('storage/' . $logo)))
                            {{-- Logo dari Database --}}
                            <img 
                                src="{{ asset('storage/' . $logo) }}" 
                                alt="Logo" 
                                class="h-12 md:h-14 lg:h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                            >
                        @else
                            {{-- Icon Tiket Emas --}}
                            <div class="w-12 h-12 md:w-14 md:h-14 lg:w-16 lg:h-16 rounded-xl bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 text-black" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                                </svg>
                            </div>
                        @endif
                    </a>
                </div>

                {{-- CENTER: Navigation (flex-1, centered) --}}
                <div class="hidden lg:flex flex-1 items-center justify-center">
                    <div class="flex items-center gap-10">
                        <a href="{{ route('home') }}" 
                           onclick="window.location.href='{{ route('home') }}'; return false;"
                           class="text-base font-semibold text-white hover:text-primary-500 transition-colors cursor-pointer {{ request()->routeIs('home') ? 'text-primary-500' : '' }}"
                           style="pointer-events: auto !important; z-index: 99999 !important; position: relative !important;">
                            Beranda
                        </a>
                        <a href="{{ route('events.index') }}" 
                           onclick="window.location.href='{{ route('events.index') }}'; return false;"
                           class="text-base font-semibold text-white hover:text-primary-500 transition-colors cursor-pointer {{ request()->routeIs('events.*') ? 'text-primary-500' : '' }}"
                           style="pointer-events: auto !important; z-index: 99999 !important; position: relative !important;">
                            Event
                        </a>
                        <a href="#" class="text-base font-semibold text-white hover:text-primary-500 transition-colors cursor-pointer">
                            Kategori
                        </a>
                        <a href="#" class="text-base font-semibold text-white hover:text-primary-500 transition-colors cursor-pointer">
                            Promo
                        </a>
                        <a href="#" class="text-base font-semibold text-white hover:text-primary-500 transition-colors cursor-pointer">
                            Bantuan
                        </a>
                    </div>
                </div>

                {{-- RIGHT: Search + Buttons --}}
                <div class="flex items-center gap-4">
                    
                    {{-- Search Box (260px width, rounded-full) --}}
                    <div class="hidden lg:block relative">
                        <input type="text" 
                               placeholder="Cari event..." 
                               class="w-[260px] px-5 py-2.5 pl-11 bg-white/10 border border-white/20 rounded-full text-sm text-white placeholder-gray-400 focus:outline-none focus:border-primary-500 focus:bg-white/15 transition-all">
                        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    @auth
                        {{-- Tiket Saya Icon --}}
                        <a href="{{ route('orders.index') }}" 
                           class="hidden md:flex items-center gap-2 text-base font-semibold text-white hover:text-primary-500 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                            </svg>
                            <span>Tiket Saya</span>
                        </a>

                        {{-- User Info --}}
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-base">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden md:block text-base text-white font-semibold">{{ auth()->user()->name }}</span>
                            </div>

                            {{-- Logout Button --}}
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-base px-5 py-2.5 rounded-xl border border-red-500/30 text-red-400 hover:bg-red-500/10 hover:border-red-500 transition-all font-semibold">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Login & Register untuk Guest --}}
                        <a href="{{ route('login') }}" 
                           class="text-base px-6 py-2.5 rounded-full border-2 border-white text-white hover:bg-white hover:text-black transition-all font-semibold">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" 
                           class="text-base px-6 py-2.5 rounded-full bg-primary-600 text-white font-bold hover:bg-primary-700 transition-all shadow-lg hover:shadow-primary-500/30">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success') || session('error'))
        <div class="fixed top-20 right-4 z-50 space-y-2 max-w-sm w-full">
            @if(session('success'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-green-500/15 border border-green-500/30 text-green-400 text-sm shadow-lg backdrop-blur-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/15 border border-red-500/30 text-red-400 text-sm shadow-lg backdrop-blur-sm">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>
    @endif

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

        {{-- FOOTER PREMIUM 4-COLUMN (DYNAMIC FROM CMS) --}}
<footer class="bg-[#1F2937] border-t border-white/10 py-16 mt-16">
    @php
        $settings = \App\Models\HomepageSetting::first();
        
        // Get pages dynamically and group them
        $allPages = \App\Models\Page::where('is_published', true)->orderBy('order')->get();
        
        // Group pages by category based on slug
        $aboutPages = $allPages->whereIn('slug', ['about-us', 'contact-us', 'careers']);
        $infoPages = $allPages->whereIn('slug', ['how-to-buy', 'how-to-sell', 'eo-guide', 'faq']);
        $legalPages = $allPages->whereIn('slug', ['privacy-policy', 'terms-of-service']);
    @endphp

    <div class="max-w-[1280px] mx-auto px-6">

        {{-- Footer Grid 4 Column --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

            {{-- Column 1: Brand + Social Media --}}
            <div>
                @if($settings?->logo && file_exists(public_path('storage/' . $settings->logo)))
                    {{-- Logo dari Database di Footer --}}
                    <img
                        src="{{ asset('storage/' . $settings->logo) }}"
                        alt="{{ $settings->site_name ?? 'RADJATIKET' }}"
                        class="h-12 w-auto object-contain mb-4"
                    >
                @else
                    {{-- Fallback Icon + Text untuk Footer --}}
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#F5C518] to-[#D4A017] flex items-center justify-center">
                            <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-black text-white">{{ $settings->site_name ?? 'RADJATIKET' }}</span>
                    </div>
                @endif

                <p class="text-gray-400 text-sm mb-6">{{ $settings->footer_tagline ?? 'Your Professional Ticketing Partner' }}</p>

                {{-- Social Media Icons (Dynamic) --}}
                <div class="flex items-center gap-3">
                    @if($settings?->social_instagram)
                        <a href="{{ $settings->social_instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-primary-500/20 border border-white/5 hover:border-primary-500/30 flex items-center justify-center text-gray-400 hover:text-primary-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($settings?->social_tiktok)
                        <a href="{{ $settings->social_tiktok }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-primary-500/20 border border-white/5 hover:border-primary-500/30 flex items-center justify-center text-gray-400 hover:text-primary-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/></svg>
                        </a>
                    @endif
                    @if($settings?->social_youtube)
                        <a href="{{ $settings->social_youtube }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-primary-500/20 border border-white/5 hover:border-primary-500/30 flex items-center justify-center text-gray-400 hover:text-primary-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                    @if($settings?->social_facebook)
                        <a href="{{ $settings->social_facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-primary-500/20 border border-white/5 hover:border-primary-500/30 flex items-center justify-center text-gray-400 hover:text-primary-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if($settings?->social_twitter)
                        <a href="{{ $settings->social_twitter }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-primary-500/20 border border-white/5 hover:border-primary-500/30 flex items-center justify-center text-gray-400 hover:text-primary-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    @endif
                    @if($settings?->social_whatsapp)
                        <a href="https://wa.me/{{ $settings->social_whatsapp }}" target="_blank" class="w-10 h-10 rounded-full bg-white/5 hover:bg-primary-500/20 border border-white/5 hover:border-primary-500/30 flex items-center justify-center text-gray-400 hover:text-primary-500 transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Column 2: Tentang Kami (DYNAMIC) --}}
            <div>
                <h4 class="text-white font-bold text-lg mb-4">Tentang Kami</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    @forelse($aboutPages as $page)
                        <li>
                            <a href="{{ route('page.show', $page->slug) }}" 
                               class="hover:text-primary-500 transition-colors">
                                {{ $page->title }}
                            </a>
                        </li>
                    @empty
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Tentang RADJATIKET</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Hubungi Kami</a></li>
                    @endforelse
                    
                    {{-- Add Legal Pages Here --}}
                    @foreach($legalPages as $page)
                        <li>
                            <a href="{{ route('page.show', $page->slug) }}" 
                               class="hover:text-primary-500 transition-colors">
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 3: Informasi (DYNAMIC) --}}
            <div>
                <h4 class="text-white font-bold text-lg mb-4">Informasi</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    @forelse($infoPages as $page)
                        <li>
                            <a href="{{ route('page.show', $page->slug) }}" 
                               class="hover:text-primary-500 transition-colors">
                                {{ $page->title }}
                            </a>
                        </li>
                    @empty
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Cara Membeli Tiket</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Cara Menjual Tiket</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">FAQ</a></li>
                    @endforelse
                </ul>
            </div>

            {{-- Column 4: Kategori Event --}}
            <div>
                <h4 class="text-white font-bold text-lg mb-4">Kategori Event</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ route('events.index', ['category' => 'musik']) }}" class="hover:text-primary-500 transition-colors">Musik</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'festival']) }}" class="hover:text-primary-500 transition-colors">Festival</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'seminar']) }}" class="hover:text-primary-500 transition-colors">Seminar</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'pameran']) }}" class="hover:text-primary-500 transition-colors">Pameran</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'olahraga']) }}" class="hover:text-primary-500 transition-colors">Olahraga</a></li>
                    <li><a href="{{ route('events.index', ['category' => 'workshop']) }}" class="hover:text-primary-500 transition-colors">Workshop</a></li>
                </ul>
            </div>

        </div>

        {{-- Bottom Copyright (Dynamic) --}}
        <div class="border-t border-white/10 pt-8 text-center">
            <p class="text-gray-500 text-sm">{{ $settings->footer_copyright ?? '© 2026 RADJATIKET, Hak Cipta Dilindungi.' }}</p>
        </div>

    </div>
</footer>


    {{-- SCRIPTS --}}
    @stack('scripts')

    {{-- NAVBAR CLICK DEBUG SCRIPT - ENHANCED --}}
    <script>
    // Debug: Log all navbar links and their clickability
    document.addEventListener('DOMContentLoaded', function() {
        console.log('%c═══════════════════════════════════════', 'color: #F5C518; font-weight: bold');
        console.log('%c NAVBAR LINKS DEBUG - ENHANCED VERSION',
