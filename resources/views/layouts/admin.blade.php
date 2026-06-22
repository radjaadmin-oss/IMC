<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') — Radjatiket</title>

    {{-- Vite CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @stack('styles')
</head>
<body class="antialiased bg-[#050B14]">

    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        <aside class="w-64 bg-[#0B1220] border-r border-white/10 flex-shrink-0 hidden lg:flex flex-col">
            
            {{-- Logo --}}
            <div class="h-16 flex items-center px-6 border-b border-white/10">
                <a href="{{ route('admin.index') }}" class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg gold-gradient flex items-center justify-center font-bold text-black text-sm">
                        R
                    </div>
                    <div>
                        <span class="text-sm font-bold text-white block">RADJATIKET</span>
                        <span class="text-[10px] text-gray-500 uppercase tracking-wider">Admin Panel</span>
                    </div>
                </a>
            </div>

            {{-- Navigation Menu --}}
            <nav class="flex-1 overflow-y-auto py-6 px-4">
                <div class="space-y-1">

                    {{-- Dashboard --}}
                    <a href="{{ route('admin.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                              {{ request()->routeIs('admin.index') ? 'bg-[#F5C518]/10 text-[#F5C518] border border-[#F5C518]/30' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    {{-- Banners --}}
                    <a href="{{ route('admin.banners.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                              {{ request()->routeIs('admin.banners.*') ? 'bg-[#F5C518]/10 text-[#F5C518] border border-[#F5C518]/30' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Home Banners
                    </a>

                    {{-- Events --}}
<a href="{{ route('admin.events.index') }}" 
   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
          {{ request()->routeIs('admin.events.*') ? 'bg-[#F5C518]/10 text-[#F5C518] border border-[#F5C518]/30' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
    </svg>
    Events
</a>

                    {{-- Orders --}}
                    <a href="#" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:bg-white/5 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Orders
                        <span class="ml-auto text-xs bg-gray-700 text-gray-400 px-2 py-0.5 rounded-full">Soon</span>
                    </a>

                </div>
            </nav>

            {{-- User Profile at Bottom --}}
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-white/5">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#F5C518] to-[#D4A017] flex items-center justify-center text-black font-bold text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
            </div>

        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Header --}}
            <header class="h-16 bg-[#0B1220] border-b border-white/10 flex items-center justify-between px-6">
                
                {{-- Page Title --}}
                <div>
                    <h1 class="text-lg font-bold text-white">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-xs text-gray-500">@yield('page-subtitle', 'Welcome back, Admin')</p>
                </div>

                {{-- Right Side Actions --}}
                <div class="flex items-center gap-4">
                    
                    {{-- View Website --}}
                    <a href="{{ route('home') }}" 
                       target="_blank"
                       class="text-sm text-gray-400 hover:text-white transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <span class="hidden sm:inline">View Website</span>
                    </a>

                    {{-- Logout --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="text-sm px-4 py-2 rounded-lg bg-red-500/10 border border-red-500/30 text-red-400 hover:bg-red-500/20 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>

            </header>

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto bg-[#050B14] p-6">
                
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Page Content --}}
                @yield('content')

            </main>

        </div>

    </div>

    {{-- Scripts --}}
    @stack('scripts')

</body>
</html>
