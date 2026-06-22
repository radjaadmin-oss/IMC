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
    </style>
</head>
<body class="antialiased bg-[#050B14] text-white">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 bg-[rgba(5,11,20,0.8)] backdrop-blur-xl border-b border-white/5">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex justify-between items-center h-18">
                
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-black tracking-tight text-white group-hover:text-[#F5C518] transition-colors">
                        RADJATIKET
                    </span>
                </a>

                {{-- Menu Navigation --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-400 hover:text-white transition-colors {{ request()->routeIs('home') ? 'text-[#F5C518]' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('events.index') }}" class="text-sm font-medium text-gray-400 hover:text-white transition-colors {{ request()->routeIs('events.*') ? 'text-[#F5C518]' : '' }}">
                        Event
                    </a>
                    
                    {{-- Menu Admin (hanya tampil jika user adalah admin) --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.index') }}" class="text-sm font-medium text-gray-400 hover:text-white transition-colors {{ request()->routeIs('admin.*') ? 'text-[#F5C518]' : '' }}">
                                Admin Dashboard
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-4">
                    @auth
                        {{-- Tiket Saya --}}
                        <a href="{{ route('orders.index') }}" 
                           class="hidden md:block text-sm font-medium text-gray-400 hover:text-white transition-colors">
                            Tiket Saya
                        </a>

                        {{-- User Info --}}
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-black font-bold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden md:block text-sm text-white font-medium">{{ auth()->user()->name }}</span>
                            </div>

                            {{-- Logout Button --}}
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-sm px-4 py-2 rounded-lg border border-red-500/30 text-red-400 hover:bg-red-500/10 hover:border-red-500 transition-all font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Login & Register untuk Guest --}}
                        <a href="{{ route('login') }}" 
                           class="text-sm font-medium text-gray-400 hover:text-white transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" 
                           class="text-sm px-5 py-2 rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-600 text-black font-bold hover:from-yellow-500 hover:to-yellow-700 transition-all shadow-lg hover:shadow-yellow-500/25">
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

    {{-- FOOTER --}}
    <footer class="bg-[#0B1220] border-t border-white/5 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
                        <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-black text-white">RADJATIKET</span>
                </div>
                <p class="text-gray-500 text-sm">&copy; 2026 Radjatiket. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    @stack('scripts')

</body>
</html>
