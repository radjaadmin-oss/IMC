<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — RADJATIKET Admin</title>

    {{-- TailwindCSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #111111;
        }
        ::-webkit-scrollbar-thumb {
            background: #242424;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #333333;
        }
        
        /* Smooth transitions */
        * {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased bg-black text-white overflow-hidden">


    <div class="flex h-screen" x-data="{ sidebarOpen: true, darkMode: true }">

        {{-- ═══════════════════════════════════════════════════════════
            SIDEBAR - 280px Fixed Left
        ═══════════════════════════════════════════════════════════ --}}
        <aside class="w-[280px] bg-[#080808] border-r border-[#242424] flex-shrink-0 flex flex-col fixed h-full z-30">
            
            {{-- Logo Header --}}
            <div class="h-16 flex items-center justify-between px-6 border-b border-[#242424]">
                <a href="{{ route('admin.index') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#B22222] to-[#8B0000] flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-base font-black text-white tracking-tight">RADJATIKET</span>
                        <span class="block text-[10px] text-[#A1A1AA] uppercase tracking-wider font-semibold">Master Admin</span>
                    </div>
                </a>
            </div>

            {{-- Navigation Menu --}}
            <nav class="flex-1 overflow-y-auto py-4 px-3">
                <div class="space-y-1">

                    {{-- Dashboard --}}
                    <a href="{{ route('admin.index') }}" 
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all group
                              {{ request()->routeIs('admin.index') ? 'bg-[#B22222] text-white shadow-lg shadow-[#B22222]/20' : 'text-[#A1A1AA] hover:bg-[#111111] hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    {{-- Section: Manajemen User --}}
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-[#A1A1AA] uppercase tracking-wider">Manajemen User</span>
                    </div>

                    <a href="{{ route('admin.users.admins') }}" 
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all
                              {{ request()->routeIs('admin.users.admins*') ? 'bg-[#B22222] text-white shadow-lg shadow-[#B22222]/20' : 'text-[#A1A1AA] hover:bg-[#111111] hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Admin</span>
                    </a>

                    <a href="{{ route('admin.users.event-organizers') }}" 
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all
                              {{ request()->routeIs('admin.users.event-organizers*') ? 'bg-[#B22222] text-white shadow-lg shadow-[#B22222]/20' : 'text-[#A1A1AA] hover:bg-[#111111] hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Event Organizer</span>
                    </a>

                    <a href="{{ route('admin.users.customers') }}" 
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all
                              {{ request()->routeIs('admin.users.customers*') ? 'bg-[#B22222] text-white shadow-lg shadow-[#B22222]/20' : 'text-[#A1A1AA] hover:bg-[#111111] hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Customer</span>
                    </a>

                    {{-- Section: Event --}}
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-[#A1A1AA] uppercase tracking-wider">Event</span>
                    </div>

                    <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all {{ request()->routeIs('admin.events.*') ? 'bg-[#B22222] text-white shadow-lg shadow-[#B22222]/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <span>Semua Event</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Approval Event</span>
                        <span class="ml-auto bg-[#FFD700] text-black text-[10px] font-bold px-2 py-0.5 rounded-full">3</span>
                    </a>



                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span>Featured Event</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Kategori Event</span>
                    </a>

                    {{-- Section: CMS Website --}}
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-[#A1A1AA] uppercase tracking-wider">CMS Website</span>
                    </div>

                    <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all {{ request()->routeIs('admin.banners.*') ? 'bg-[#B22222] text-white shadow-lg shadow-[#B22222]/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Banner Slider</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Homepage</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span>Artikel</span>
                    </a>

                    {{-- Section: Transaksi --}}
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-[#A1A1AA] uppercase tracking-wider">Transaksi</span>
                    </div>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Order</span>
                    </a>



                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <span>Payment</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"/>
                        </svg>
                        <span>Refund</span>
                        <span class="ml-auto bg-[#EF4444] text-white text-[10px] font-bold px-2 py-0.5 rounded-full">2</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Settlement EO</span>
                    </a>

                    {{-- Section: Laporan --}}
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-[#A1A1AA] uppercase tracking-wider">Laporan</span>
                    </div>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Analytics</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Laporan</span>
                    </a>

                    {{-- Section: System --}}
                    <div class="pt-4 pb-2 px-4">
                        <span class="text-[10px] font-bold text-[#A1A1AA] uppercase tracking-wider">System</span>
                    </div>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Website Setting</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-[#A1A1AA] hover:bg-[#111111] hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Audit Log</span>
                    </a>

                </div>
            </nav>

            {{-- User Profile Bottom --}}
            <div class="p-4 border-t border-[#242424]">
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-[#111111]">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#B22222] to-[#8B0000] flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-[#A1A1AA]">Master Administrator</p>
                    </div>
                </div>
            </div>

        </aside>



        {{-- ═══════════════════════════════════════════════════════════
            MAIN CONTENT AREA
        ═══════════════════════════════════════════════════════════ --}}
        <div class="flex-1 flex flex-col ml-[280px]">

            {{-- TOPBAR --}}
            <header class="h-16 bg-[#080808] border-b border-[#242424] flex items-center justify-between px-6 sticky top-0 z-20">
                
                {{-- Search Bar --}}
                <div class="flex-1 max-w-xl">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search anything..." 
                               class="w-full bg-[#111111] border border-[#242424] rounded-xl pl-10 pr-4 py-2 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#B22222] transition-colors">
                        <svg class="w-4 h-4 text-[#A1A1AA] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-3 ml-6">
                    
                    {{-- Notification --}}
                    <button class="relative p-2 rounded-xl bg-[#111111] border border-[#242424] hover:border-[#B22222] text-[#A1A1AA] hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-[#B22222] rounded-full"></span>
                    </button>

                    {{-- Dark Mode Toggle --}}
                    <button @click="darkMode = !darkMode" class="p-2 rounded-xl bg-[#111111] border border-[#242424] hover:border-[#FFD700] text-[#A1A1AA] hover:text-[#FFD700] transition-colors">
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>

                    {{-- View Website --}}
                    <a href="{{ route('home') }}" 
                       target="_blank"
                       class="p-2 rounded-xl bg-[#111111] border border-[#242424] hover:border-[#22C55E] text-[#A1A1AA] hover:text-[#22C55E] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>

                    {{-- Divider --}}
                    <div class="w-px h-6 bg-[#242424]"></div>

                    {{-- User Profile Dropdown --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#111111] border border-[#242424] hover:border-[#B22222] transition-colors">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#B22222] to-[#8B0000] flex items-center justify-center text-white font-bold text-xs">
                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="text-left hidden sm:block">
                                <p class="text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                                <p class="text-[10px] text-[#A1A1AA]">Master Admin</p>
                            </div>
                            <svg class="w-4 h-4 text-[#A1A1AA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-56 bg-[#111111] border border-[#242424] rounded-xl shadow-2xl py-2 z-50">
                            
                            <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-[#A1A1AA] hover:bg-[#080808] hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile Settings
                            </a>

                            <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-[#A1A1AA] hover:bg-[#080808] hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Account Settings
                            </a>

                            <div class="border-t border-[#242424] my-2"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-[#EF4444] hover:bg-[#080808] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </header>



            {{-- MAIN CONTENT --}}
            <main class="flex-1 overflow-y-auto bg-black p-6">
                
                {{-- Breadcrumb --}}
                <div class="mb-6">
                    <div class="flex items-center gap-2 text-sm text-[#A1A1AA]">
                        <a href="{{ route('admin.index') }}" class="hover:text-white transition-colors">Dashboard</a>
                        @if(isset($breadcrumb))
                            @foreach($breadcrumb as $item)
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                @if($loop->last)
                                    <span class="text-white font-medium">{{ $item['label'] }}</span>
                                @else
                                    <a href="{{ $item['url'] }}" class="hover:text-white transition-colors">{{ $item['label'] }}</a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Page Header --}}
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-white mb-1">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-sm text-[#A1A1AA]">@yield('page-subtitle', 'Welcome to RADJATIKET Master Admin Panel')</p>
                </div>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-[#22C55E]/10 border border-[#22C55E]/30 text-[#22C55E] flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-2xl bg-[#EF4444]/10 border border-[#EF4444]/30 text-[#EF4444] flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-[#EF4444]/10 border border-[#EF4444]/30 text-[#EF4444]">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-bold">Terjadi kesalahan:</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 ml-8">
                            @foreach($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
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
