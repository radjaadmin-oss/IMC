@extends('layouts.admin-master')

@section('title', 'Semua Event')

@section('content')
<div class="space-y-4">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-white">Semua Event</h1>
            <p class="text-[#94A3B8] text-xs mt-0.5">Kelola semua event dan status approval</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="px-4 py-2 bg-[#F5C518] text-black rounded-xl text-xs font-bold hover:bg-[#F5C518]/90 transition-all duration-300 flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Event
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="bg-[#22C55E]/10 border border-[#22C55E]/30 rounded-xl p-3 flex items-center gap-2">
        <svg class="w-4 h-4 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span class="text-[#22C55E] text-xs">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-[#EF4444]/10 border border-[#EF4444]/30 rounded-xl p-3 flex items-center gap-2">
        <svg class="w-4 h-4 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="text-[#EF4444] text-xs">{{ session('error') }}</span>
    </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-2.5">
                <div class="w-9 h-9 bg-[#3B82F6]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\Event::count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Total Event</div>
        </div>

        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-2.5">
                <div class="w-9 h-9 bg-[#22C55E]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\Event::where('status', 'approved')->count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Approved</div>
        </div>

        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-2.5">
                <div class="w-9 h-9 bg-[#F59E0B]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\Event::where('status', 'pending')->count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Pending</div>
        </div>

        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-2.5">
                <div class="w-9 h-9 bg-[#F5C518]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-[#F5C518]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\Event::where('is_featured', true)->count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Featured</div>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-[#0B1220] border border-white/5 rounded-xl p-4">
        <form method="GET" action="{{ route('admin.events.index') }}" class="space-y-3">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                {{-- Search --}}
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama event atau lokasi..." class="w-full px-3 py-2 text-xs bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
                </div>

                {{-- Status Filter --}}
                <div>
                    <select name="status" class="w-full px-3 py-2 text-xs bg-[#050B14] border border-white/5 rounded-lg text-white focus:outline-none focus:border-[#F5C518] transition-all duration-300">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                {{-- Category Filter --}}
                <div>
                    <select name="category_id" class="w-full px-3 py-2 text-xs bg-[#050B14] border border-white/5 rounded-lg text-white focus:outline-none focus:border-[#F5C518] transition-all duration-300">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Filter Actions --}}
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-[#F5C518] text-black rounded-lg text-xs font-bold hover:bg-[#F5C518]/90 transition-all duration-300 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                @if(request('search') || request('status') || request('category_id'))
                <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-white/5 text-white rounded-lg text-xs font-semibold hover:bg-white/10 transition-all duration-300">
                    Reset
                </a>
                @endif
                <div class="ml-auto flex items-center gap-2">
                    <label class="flex items-center gap-1.5 px-3 py-2 bg-[#050B14] border border-white/5 rounded-lg cursor-pointer hover:border-[#F5C518] transition-all duration-300">
                        <input type="checkbox" name="is_featured" value="1" {{ request('is_featured') ? 'checked' : '' }} class="w-3.5 h-3.5 rounded border-white/5 bg-[#050B14] text-[#F5C518] focus:ring-[#F5C518]">
                        <span class="text-white text-[10px]">Featured Only</span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    {{-- Events Table --}}
    <div class="bg-[#0B1220] border border-white/5 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#050B14] border-b border-white/5">
                    <tr>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Event</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Lokasi</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($events as $event)
                    <tr class="hover:bg-[#050B14] transition-all duration-300">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                <div class="w-12 h-12 bg-[#050B14] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                @endif
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-white font-semibold text-xs">{{ $event->title }}</span>
                                        @if($event->is_featured)
                                        <svg class="w-3 h-3 text-[#F5C518]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        @endif
                                    </div>
                                    <div class="text-[10px] text-[#94A3B8] mt-0.5">
                                        @if($event->is_free)
                                        <span class="text-[#22C55E]">GRATIS</span>
                                        @elseif($event->has_ticket_categories && $event->ticketCategories->isNotEmpty())
                                        <span class="text-[#F5C518]">Mulai dari Rp {{ number_format($event->ticketCategories->min('price'), 0, ',', '.') }}</span>
                                        @else
                                        <span class="text-[#F5C518]">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-[#94A3B8] text-xs">{{ $event->category->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-[#94A3B8] text-xs">{{ $event->date->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-[#94A3B8] text-xs">{{ Str::limit($event->location, 20) }}</td>
                        <td class="px-4 py-3">
                            @if($event->status === 'approved')
                            <span class="px-2 py-0.5 bg-[#22C55E]/10 text-[#22C55E] rounded-full text-[10px] font-semibold">Approved</span>
                            @elseif($event->status === 'pending')
                            <span class="px-2 py-0.5 bg-[#F59E0B]/10 text-[#F59E0B] rounded-full text-[10px] font-semibold">Pending</span>
                            @else
                            <span class="px-2 py-0.5 bg-[#EF4444]/10 text-[#EF4444] rounded-full text-[10px] font-semibold">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1.5">
                                {{-- Toggle Featured --}}
                                <form action="{{ route('admin.events.toggle-featured', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-1.5 {{ $event->is_featured ? 'bg-[#F5C518]/10 text-[#F5C518]' : 'bg-white/5 text-[#64748B]' }} rounded-lg hover:bg-[#F5C518]/20 transition-all duration-300" title="{{ $event->is_featured ? 'Remove Featured' : 'Set Featured' }}">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </form>

                                {{-- Edit --}}
                                <a href="{{ route('admin.events.edit', $event) }}" class="p-1.5 bg-[#F59E0B]/10 text-[#F59E0B] rounded-lg hover:bg-[#F59E0B]/20 transition-all duration-300" title="Edit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                {{-- Duplicate --}}
                                <form action="{{ route('admin.events.duplicate', $event) }}" method="POST" onsubmit="return confirm('Duplikasi event ini?')">
                                    @csrf
                                    <button type="submit" class="p-1.5 bg-[#3B82F6]/10 text-[#3B82F6] rounded-lg hover:bg-[#3B82F6]/20 transition-all duration-300" title="Duplicate">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-[#EF4444]/10 text-[#EF4444] rounded-lg hover:bg-[#EF4444]/20 transition-all duration-300" title="Hapus">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-[#64748B]">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                                <p class="text-xs">Tidak ada event ditemukan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($events->hasPages())
    <div class="flex justify-center">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection
