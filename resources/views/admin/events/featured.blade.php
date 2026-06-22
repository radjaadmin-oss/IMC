@extends('layouts.admin-master')

@section('title', 'Featured Events')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Featured Events</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola event yang ditampilkan di homepage</p>
        </div>
        <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors duration-200 text-sm font-medium">
            ← Kembali ke Semua Event
        </a>
    </div>

    {{-- SEARCH & FILTER --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <form method="GET" action="{{ route('admin.events.featured') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Search --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-300 mb-2">Cari Event</label>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau lokasi event..." 
                    class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                >
            </div>

            {{-- Category Filter --}}
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Kategori</label>
                <select 
                    name="category_id" 
                    class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Buttons --}}
            <div class="md:col-span-3 flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg font-medium transition-colors duration-200">
                    🔍 Cari
                </button>
                <a href="{{ route('admin.events.featured') }}" class="px-6 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition-colors duration-200">
                    Reset Filter
                </a>
            </div>
        </form>
    </div>

    {{-- STATISTICS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Featured --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#FFD700] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#FFD700]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Total Featured</p>
                <p class="text-3xl font-bold text-white">{{ $events->total() }}</p>
            </div>
        </div>

        {{-- Upcoming Featured --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#22C55E] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#22C55E]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Upcoming</p>
                <p class="text-3xl font-bold text-white">{{ \App\Models\Event::where('is_featured', true)->where('date', '>=', now())->count() }}</p>
            </div>
        </div>

        {{-- Past Featured --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#F59E0B] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#F59E0B]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Past Featured</p>
                <p class="text-3xl font-bold text-white">{{ \App\Models\Event::where('is_featured', true)->where('date', '<', now())->count() }}</p>
            </div>
        </div>

        {{-- Categories Used --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#3B82F6] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#3B82F6]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Kategori Digunakan</p>
                <p class="text-3xl font-bold text-white">{{ \App\Models\Event::where('is_featured', true)->distinct('category_id')->count() }}</p>
            </div>
        </div>
    </div>

    {{-- EVENTS TABLE --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl overflow-hidden">
        @if($events->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#0a0a0a] border-b border-[#242424]">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Event</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Tickets Sold</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#242424]">
                        @foreach($events as $event)
                        <tr class="hover:bg-[#0a0a0a] transition-colors duration-150">
                            {{-- Event --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://placehold.co/100x100/1a1a1a/666?text=No+Image' }}" 
                                         alt="{{ $event->title }}" 
                                         class="w-16 h-16 rounded-lg object-cover border border-[#242424]">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="font-semibold text-white">{{ $event->title }}</p>
                                            <span class="text-[#FFD700]">·</span>
                                        </div>
                                        <p class="text-sm text-[#22C55E] font-medium">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Category --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#3B82F6]/10 text-[#3B82F6]">
                                    {{ $event->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="text-white font-medium">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                                    <p class="text-slate-400">{{ $event->time }}</p>
                                </div>
                            </td>

                            {{-- Location --}}
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-300">{{ $event->location }}</p>
                            </td>

                            {{-- Tickets Sold --}}
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="text-white font-medium">{{ $event->sold_count }}/{{ $event->quota }}</p>
                                    <div class="w-24 bg-[#242424] rounded-full h-1.5 mt-1">
                                        <div class="bg-[#FFD700] h-1.5 rounded-full" style="width: {{ $event->quota > 0 ? ($event->sold_count / $event->quota * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Remove from Featured --}}
                                    <form action="{{ route('admin.events.toggle-featured', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus event dari Featured?')">
                                        @csrf
                                        <button type="submit" class="p-2 bg-[#F59E0B]/10 hover:bg-[#F59E0B]/20 text-[#F59E0B] rounded-lg transition-colors duration-200" title="Remove from Featured">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        </button>
                                    </form>

                                    {{-- View Event --}}
                                    <a href="{{ route('admin.events.show', $event) }}" class="p-2 bg-[#3B82F6]/10 hover:bg-[#3B82F6]/20 text-[#3B82F6] rounded-lg transition-colors duration-200" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="px-6 py-4 border-t border-[#242424]">
                {{ $events->links() }}
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#FFD700]/10 rounded-full mb-4">
                    <svg class="w-8 h-8 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Belum Ada Featured Event</h3>
                <p class="text-slate-400 mb-4">Tandai event sebagai featured dari halaman Semua Event</p>
                <a href="{{ route('admin.events.index') }}" class="inline-flex items-center px-4 py-2 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg font-medium transition-colors duration-200">
                    Kelola Event →
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
