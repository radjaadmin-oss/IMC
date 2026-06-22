@extends('layouts.admin-master')

@section('title', 'Event Categories')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Event Categories</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola kategori event</p>
        </div>
        <button 
            @click="$dispatch('open-modal', 'create-category')" 
            class="px-4 py-2 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg transition-colors duration-200 text-sm font-medium flex items-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori
        </button>
    </div>

    {{-- STATISTICS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Categories --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#FFD700] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#FFD700]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Total Kategori</p>
                <p class="text-3xl font-bold text-white">{{ $categories->count() }}</p>
            </div>
        </div>

        {{-- Active Categories --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#22C55E] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#22C55E]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Aktif</p>
                <p class="text-3xl font-bold text-white">{{ $categories->where('is_active', true)->count() }}</p>
            </div>
        </div>

        {{-- Inactive Categories --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#EF4444] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#EF4444]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Nonaktif</p>
                <p class="text-3xl font-bold text-white">{{ $categories->where('is_active', false)->count() }}</p>
            </div>
        </div>

        {{-- Total Events --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#3B82F6] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#3B82F6]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Total Event</p>
                <p class="text-3xl font-bold text-white">{{ $categories->sum('events_count') }}</p>
            </div>
        </div>
    </div>

    {{-- CATEGORIES TABLE --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl overflow-hidden">
        @if($categories->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#0a0a0a] border-b border-[#242424]">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Icon</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Total Event</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#242424]">
                        @foreach($categories as $category)
                        <tr class="hover:bg-[#0a0a0a] transition-colors duration-150">
                            {{-- Category Name --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-xl" style="background-color: {{ $category->color ?? '#FFD700' }}20;">
                                        {{ $category->icon ?? '📁' }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">{{ $category->name }}</p>
                                        <p class="text-xs text-slate-400">Order: {{ $category->sort_order }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Slug --}}
                            <td class="px-6 py-4">
                                <code class="text-sm text-[#FFD700] bg-[#FFD700]/10 px-2 py-1 rounded">{{ $category->slug }}</code>
                            </td>

                            {{-- Icon --}}
                            <td class="px-6 py-4">
                                <span class="text-2xl">{{ $category->icon ?? '—' }}</span>
                            </td>

                            {{-- Total Events --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#3B82F6]/10 text-[#3B82F6]">
                                    {{ $category->events_count }} event
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.categories.toggle-active', $category) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors duration-200 {{ $category->is_active ? 'bg-[#22C55E]/10 text-[#22C55E] hover:bg-[#22C55E]/20' : 'bg-[#EF4444]/10 text-[#EF4444] hover:bg-[#EF4444]/20' }}">
                                        {{ $category->is_active ? '✓ Aktif' : '✕ Nonaktif' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Edit --}}
                                    <button 
                                        @click="$dispatch('open-modal', 'edit-category-{{ $category->id }}')" 
                                        class="p-2 bg-[#F59E0B]/10 hover:bg-[#F59E0B]/20 text-[#F59E0B] rounded-lg transition-colors duration-200" 
                                        title="Edit"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus kategori {{ $category->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-[#EF4444]/10 hover:bg-[#EF4444]/20 text-[#EF4444] rounded-lg transition-colors duration-200" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- EDIT MODAL for each category --}}
                        <tr x-data="{ open: false }" @open-modal.window="open = ($event.detail === 'edit-category-{{ $category->id }}')" x-show="open" x-cloak style="display: none;">
                            <td colspan="6" class="p-0">
                                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" @click.self="open = false">
                                    <div class="bg-[#111111] border border-[#242424] rounded-2xl max-w-md w-full p-6" @click.stop>
                                        <div class="flex items-center justify-between mb-6">
                                            <h3 class="text-xl font-bold text-white">Edit Kategori</h3>
                                            <button @click="open = false" class="text-slate-400 hover:text-white transition-colors">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4">
                                            @csrf
                                            @method('PUT')

                                            {{-- Name --}}
                                            <div>
                                                <label class="block text-sm font-medium text-slate-300 mb-2">Nama Kategori *</label>
                                                <input 
                                                    type="text" 
                                                    name="name" 
                                                    value="{{ $category->name }}"
                                                    required
                                                    class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                                                >
                                            </div>

                                            {{-- Icon --}}
                                            <div>
                                                <label class="block text-sm font-medium text-slate-300 mb-2">Icon (Emoji)</label>
                                                <input 
                                                    type="text" 
                                                    name="icon" 
                                                    value="{{ $category->icon }}"
                                                    placeholder="🎵"
                                                    maxlength="10"
                                                    class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                                                >
                                            </div>

                                            {{-- Color --}}
                                            <div>
                                                <label class="block text-sm font-medium text-slate-300 mb-2">Warna</label>
                                                <input 
                                                    type="color" 
                                                    name="color" 
                                                    value="{{ $category->color ?? '#FFD700' }}"
                                                    class="w-full h-12 px-2 bg-[#000000] border border-[#242424] rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                                                >
                                            </div>

                                            {{-- Buttons --}}
                                            <div class="flex gap-3 pt-4">
                                                <button type="submit" class="flex-1 px-6 py-2.5 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg font-medium transition-colors duration-200">
                                                    Update Kategori
                                                </button>
                                                <button type="button" @click="open = false" class="px-6 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition-colors duration-200">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#FFD700]/10 rounded-full mb-4">
                    <svg class="w-8 h-8 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Belum Ada Kategori</h3>
                <p class="text-slate-400 mb-4">Mulai dengan menambahkan kategori pertama</p>
                <button 
                    @click="$dispatch('open-modal', 'create-category')" 
                    class="inline-flex items-center px-4 py-2 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg font-medium transition-colors duration-200"
                >
                    + Tambah Kategori
                </button>
            </div>
        @endif
    </div>
</div>

{{-- CREATE CATEGORY MODAL --}}
<div x-data="{ open: false }" @open-modal.window="open = ($event.detail === 'create-category')" x-show="open" x-cloak style="display: none;">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" @click.self="open = false">
        <div class="bg-[#111111] border border-[#242424] rounded-2xl max-w-md w-full p-6" @click.stop>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">Tambah Kategori Baru</h3>
                <button @click="open = false" class="text-slate-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Kategori *</label>
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Contoh: Musik, Seminar, Workshop..."
                        required
                        class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                </div>

                {{-- Icon --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Icon (Emoji)</label>
                    <input 
                        type="text" 
                        name="icon" 
                        placeholder="🎵"
                        maxlength="10"
                        class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                    <p class="text-xs text-slate-500 mt-1">Masukkan emoji atau karakter spesial</p>
                </div>

                {{-- Color --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Warna</label>
                    <input 
                        type="color" 
                        name="color" 
                        value="#FFD700"
                        class="w-full h-12 px-2 bg-[#000000] border border-[#242424] rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                </div>

                {{-- Buttons --}}
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 px-6 py-2.5 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg font-medium transition-colors duration-200">
                        Tambah Kategori
                    </button>
                    <button type="button" @click="open = false" class="px-6 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
