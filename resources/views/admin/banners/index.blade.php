@extends('layouts.admin')

@section('title', 'Kelola Banner')
@section('page-title', 'Home Banners')
@section('page-subtitle', 'Kelola banner promo di halaman utama')

@section('content')

{{-- Header Actions --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Total: <span class="font-semibold text-white">{{ $banners->total() }}</span> banner</p>
    </div>
    <a href="{{ route('admin.banners.create') }}" 
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-semibold text-sm hover:scale-105 transition-transform shadow-lg">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Banner
    </a>
</div>

{{-- Banners List --}}
@if($banners->isEmpty())
    <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl border border-white/10 p-20 text-center">
        <svg class="w-16 h-16 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-gray-400 font-medium mb-2">Belum ada banner</p>
        <p class="text-gray-600 text-sm mb-6">Tambahkan banner promo untuk halaman utama website</p>
        <a href="{{ route('admin.banners.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-semibold text-sm hover:scale-105 transition-transform">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Banner Pertama
        </a>
    </div>
@else
    <div class="space-y-4">
        @foreach($banners as $banner)
            <div class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl border border-white/10 overflow-hidden hover:border-[#F5C518]/30 transition-all">
                <div class="flex flex-col md:flex-row gap-6 p-6">
                    
                    {{-- Preview Image --}}
                    <div class="w-full md:w-64 flex-shrink-0">
                        <img src="{{ asset('storage/' . $banner->desktop_image) }}" 
                             alt="{{ $banner->title }}"
                             class="w-full h-32 object-cover rounded-xl border border-white/10">
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-white mb-1">{{ $banner->title }}</h3>
                                @if($banner->event)
                                    <p class="text-sm text-gray-500">Linked to: {{ $banner->event->title }}</p>
                                @else
                                    <p class="text-sm text-gray-600">No event linked</p>
                                @endif
                            </div>

                            {{-- Status Badge --}}
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $banner->status === 'active' ? 'bg-green-500/10 text-green-400 border border-green-500/30' : 'bg-gray-700/50 text-gray-400 border border-gray-600' }}">
                                {{ ucfirst($banner->status) }}
                            </span>
                        </div>

                        {{-- Meta Info --}}
                        <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 mb-4">
                            <div>Sort Order: <span class="text-white font-semibold">{{ $banner->sort_order }}</span></div>
                            <div>{{ $banner->created_at->format('d M Y') }}</div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.banners.edit', $banner) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-500/10 border border-blue-500/30 text-blue-400 text-sm font-medium hover:bg-blue-500/20 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('admin.banners.destroy', $banner) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus banner ini?')"
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500/10 border border-red-500/30 text-red-400 text-sm font-medium hover:bg-red-500/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($banners->hasPages())
        <div class="mt-8">
            {{ $banners->links() }}
        </div>
    @endif
@endif

@endsection
