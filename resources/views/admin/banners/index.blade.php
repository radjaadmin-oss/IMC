@extends('layouts.admin-master')

@section('title', 'Banner Management')

@section('page-title', 'Banner Management')

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

{{-- STATISTICS CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    
    {{-- Total Banners --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:border-[#B22222]/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/20 to-blue-600/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <div>
            <p class="text-sm text-[#A1A1AA] mb-1">Total Banners</p>
            <p class="text-2xl font-bold text-white">{{ number_format($stats['total']) }}</p>
        </div>
    </div>

    {{-- Active Banners --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:border-[#22C55E]/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500/20 to-green-600/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div>
            <p class="text-sm text-[#A1A1AA] mb-1">Active</p>
            <p class="text-2xl font-bold text-green-400">{{ number_format($stats['active']) }}</p>
        </div>
    </div>

    {{-- Inactive Banners --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:border-[#EF4444]/30 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500/20 to-red-600/20 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
            </div>
        </div>
        <div>
            <p class="text-sm text-[#A1A1AA] mb-1">Inactive</p>
            <p class="text-2xl font-bold text-red-400">{{ number_format($stats['inactive']) }}</p>
        </div>
    </div>

    {{-- Linked Events --}}
    <div class="bg-gradient-to-br from-[#B22222] to-[#8B0000] border border-[#B22222]/50 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
            </div>
        </div>
        <div>
            <p class="text-sm text-white/70 mb-1">Linked to Events</p>
            <p class="text-2xl font-bold text-white">{{ number_format($stats['linked']) }}</p>
        </div>
    </div>

</div>

{{-- FILTERS & ACTIONS --}}
<div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 mb-6">
    <form method="GET" action="{{ route('admin.banners.index') }}" class="space-y-4">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            {{-- Search --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Search Banner</label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari banner..." 
                           class="w-full bg-black border border-[#242424] rounded-xl pl-10 pr-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#B22222]">
                    <svg class="w-4 h-4 text-[#A1A1AA] absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Status Filter --}}
            <div>
                <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Status</label>
                <select name="status" 
                        class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#B22222]">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Event Filter --}}
            <div>
                <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Event</label>
                <select name="event_id" 
                        class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#B22222]">
                    <option value="">All Events</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                            {{ $event->title }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#B22222] text-white font-semibold text-sm hover:bg-[#8B0000] transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.banners.index') }}" class="px-6 py-2.5 rounded-xl bg-[#111111] border border-[#242424] text-[#A1A1AA] font-semibold text-sm hover:bg-black hover:text-white transition-colors">
                    Reset
                </a>
            </div>

            <a href="{{ route('admin.banners.create') }}" 
               class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#FFD700] to-[#F5C518] text-black font-bold text-sm hover:from-[#F5C518] hover:to-[#FFD700] transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Banner
            </a>
        </div>

    </form>
</div>

{{-- BANNERS GRID --}}
@if($banners->count() > 0)

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    @foreach($banners as $banner)
    <div class="bg-[#111111] border border-[#242424] rounded-2xl overflow-hidden hover:border-[#B22222]/30 transition-all group">
        
        {{-- Banner Image --}}
        <div class="relative aspect-[1920/550] overflow-hidden bg-[#080808]">
            @if($banner->desktop_image)
                <img src="{{ Storage::url($banner->desktop_image) }}" 
                     alt="{{ $banner->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-[#A1A1AA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
            
            {{-- Status Badge Overlay --}}
            <div class="absolute top-4 right-4">
                <span class="px-3 py-1.5 rounded-lg text-xs font-semibold border backdrop-blur-sm {{ $banner->status === 'active' ? 'bg-green-500/20 text-green-400 border-green-500/40' : 'bg-gray-700/50 text-gray-400 border-gray-600/40' }}">
                    {{ ucfirst($banner->status) }}
                </span>
            </div>

            {{-- Sort Order Badge --}}
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1.5 rounded-lg text-xs font-bold bg-black/60 text-white border border-white/20 backdrop-blur-sm">
                    #{{ $banner->sort_order }}
                </span>
            </div>
        </div>

        {{-- Banner Info --}}
        <div class="p-6">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-white mb-2">{{ $banner->title }}</h3>
                
                @if($banner->event)
                    <div class="flex items-center gap-2 text-sm text-[#A1A1AA]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        <span>{{ $banner->event->title }}</span>
                    </div>
                @else
                    <p class="text-sm text-gray-600">No event linked</p>
                @endif
            </div>

            {{-- Meta Info --}}
            <div class="flex items-center gap-4 text-xs text-[#A1A1AA] mb-4 pb-4 border-b border-[#242424]">
                <div>Created: {{ $banner->created_at->format('d M Y') }}</div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                {{-- Toggle Status --}}
                <form action="{{ route('admin.banners.toggle-status', $banner) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" 
                            class="px-3 py-2 rounded-lg text-xs font-semibold transition-colors {{ $banner->status === 'active' ? 'bg-gray-500/10 text-gray-400 border border-gray-500/30 hover:bg-gray-500/20' : 'bg-green-500/10 text-green-400 border border-green-500/30 hover:bg-green-500/20' }}">
                        {{ $banner->status === 'active' ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>

                {{-- Edit --}}
                <a href="{{ route('admin.banners.edit', $banner) }}" 
                   class="flex-1 px-3 py-2 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/30 text-xs font-semibold text-center hover:bg-blue-500/20 transition-colors">
                    Edit
                </a>

                {{-- Delete --}}
                <form action="{{ route('admin.banners.destroy', $banner) }}" 
                      method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this banner?')"
                      class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-3 py-2 rounded-lg bg-red-500/10 text-red-400 border border-red-500/30 text-xs font-semibold hover:bg-red-500/20 transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>

    </div>
    @endforeach
</div>

{{-- Pagination --}}
<div class="bg-[#111111] border border-[#242424] rounded-2xl p-4">
    {{ $banners->links() }}
</div>

@else

{{-- Empty State --}}
<div class="bg-[#111111] border border-[#242424] rounded-2xl p-20 text-center">
    <div class="inline-flex w-20 h-20 rounded-full bg-[#080808] items-center justify-center mb-4">
        <svg class="w-10 h-10 text-[#A1A1AA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>
    <h3 class="text-xl font-bold text-white mb-2">No Banners Found</h3>
    <p class="text-[#A1A1AA] mb-6">Start by creating your first banner for the homepage</p>
    <a href="{{ route('admin.banners.create') }}" 
       class="inline-block px-6 py-3 rounded-xl bg-gradient-to-r from-[#FFD700] to-[#F5C518] text-black font-bold hover:from-[#F5C518] hover:to-[#FFD700] transition-all">
        Create First Banner
    </a>
</div>

@endif

@endsection
