@extends('layouts.admin')

@section('content')

{{-- ═══════════════════════════════════════════════════════════════
    HEADER
═══════════════════════════════════════════════════════════════ --}}
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-wider mb-2">Kelola Event</h1>
            <p class="text-gray-500 text-sm">Daftar semua event yang tersedia</p>
        </div>
        <a href="{{ route('admin.events.create') }}" 
           class="flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold text-sm tracking-wider hover:from-[#E5B50F] hover:to-[#C49016] transition-all shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Event
        </a>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════
    SUCCESS MESSAGE
═══════════════════════════════════════════════════════════════ --}}
@if(session('success'))
    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

{{-- ═══════════════════════════════════════════════════════════════
    STATS CARDS
═══════════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
    <div class="bg-[#0B1220] rounded-xl p-5 border border-white/10">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Total Event</p>
                <p class="text-2xl font-bold text-white">{{ $events->total() }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-[#0B1220] rounded-xl p-5 border border-white/10">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Upcoming</p>
                <p class="text-2xl font-bold text-white">{{ \App\Models\Event::where('date', '>=', now())->count() }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-[#0B1220] rounded-xl p-5 border border-white/10">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Past Event</p>
                <p class="text-2xl font-bold text-white">{{ \App\Models\Event::where('date', '<', now())->count() }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-gray-500/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-[#0B1220] rounded-xl p-5 border border-white/10">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Sold Out</p>
                <p class="text-2xl font-bold text-white">0</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════
    EVENTS TABLE
═══════════════════════════════════════════════════════════════ --}}
<div class="bg-[#0B1220] rounded-2xl border border-white/10 overflow-hidden">
    
    @if($events->isEmpty())
        <div class="p-20 text-center">
            <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <p class="text-gray-500 font-medium mb-1">Belum ada event</p>
            <p class="text-gray-600 text-sm mb-6">Tambahkan event pertama untuk mulai menjual tiket</p>
            <a href="{{ route('admin.events.create') }}" 
               class="inline-block px-6 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold text-sm">
                Tambah Event
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Event</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Lokasi</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Harga</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Kuota</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="text-right px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($events as $event)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" 
                                             alt="{{ $event->title }}"
                                             class="w-16 h-16 rounded-lg object-cover">
                                    @else
                                        <div class="w-16 h-16 rounded-lg bg-white/5 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-white font-semibold">{{ $event->title }}</p>
                                        <p class="text-gray-500 text-xs">{{ $event->time ?? 'TBA' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-white text-sm">{{ $event->date->format('d M Y') }}</p>
                                <p class="text-gray-500 text-xs">{{ $event->date->diffForHumans() }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-white text-sm">{{ Str::limit($event->location, 30) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if($event->price == 0)
                                    <span class="text-green-400 font-bold text-sm">GRATIS</span>
                                @else
                                    <p class="text-[#F5C518] font-bold text-sm">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-white text-sm">{{ $event->remaining_quota }} / {{ $event->quota }}</p>
                                <div class="w-20 bg-white/10 rounded-full h-1.5 mt-1">
                                    @php
                                        $percent = $event->quota > 0 ? (($event->quota - $event->remaining_quota) / $event->quota * 100) : 0;
                                    @endphp
                                    <div class="h-1.5 rounded-full {{ $percent >= 100 ? 'bg-red-500' : ($percent >= 75 ? 'bg-yellow-500' : 'bg-green-500') }}" 
                                         style="width: {{ $percent }}%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($event->is_sold_out)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-500/10 border border-red-500/30 text-red-400">
                                        Sold Out
                                    </span>
                                @elseif($event->date < now())
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-500/10 border border-gray-500/30 text-gray-400">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500/10 border border-green-500/30 text-green-400">
                                        Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('events.show', $event) }}" 
                                       target="_blank"
                                       class="p-2 rounded-lg bg-blue-500/10 border border-blue-500/30 text-blue-400 hover:bg-blue-500/20 transition-all"
                                       title="Lihat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.events.edit', $event) }}" 
                                       class="p-2 rounded-lg bg-[#F5C518]/10 border border-[#F5C518]/30 text-[#F5C518] hover:bg-[#F5C518]/20 transition-all"
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus event ini?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-lg bg-red-500/10 border border-red-500/30 text-red-400 hover:bg-red-500/20 transition-all"
                                                title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($events->hasPages())
            <div class="px-6 py-4 border-t border-white/10">
                {{ $events->links() }}
            </div>
        @endif
    @endif
    
</div>

@endsection
