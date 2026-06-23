@extends('layouts.admin-master')

@section('title', 'Edit Event Organizer')

@section('content')

{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.users.event-organizers') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-[#111111] border border-[#242424] rounded-xl text-white text-sm hover:bg-black transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
<div class="mb-6 bg-[#22C55E]/10 border border-[#22C55E]/30 rounded-xl p-4 flex items-center gap-3">
    <svg class="w-5 h-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span class="text-[#22C55E]">{{ session('success') }}</span>
</div>
@endif

{{-- Form --}}
<form action="{{ route('admin.users.event-organizers.update', $user) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- LEFT COLUMN: Avatar Upload --}}
        <div class="lg:col-span-1">
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <h3 class="text-lg font-bold text-white mb-4">📸 Photo Profil</h3>
                
                {{-- Current Avatar Preview --}}
                <div class="mb-4">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-[#F5C518]">
                        <p class="text-xs text-[#A1A1AA] text-center mt-2">📷 Photo saat ini</p>
                    @else
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-[#F5C518] to-[#D4A017] flex items-center justify-center mx-auto text-4xl font-bold text-black">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <p class="text-xs text-[#A1A1AA] text-center mt-2">Belum upload photo</p>
                    @endif
                </div>

                {{-- Upload New Avatar --}}
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Upload Photo Baru</label>
                    <input type="file" 
                           name="avatar" 
                           accept="image/png,image/jpg,image/jpeg"
                           class="w-full text-sm text-white
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-gradient-to-r file:from-[#F5C518] file:to-[#D4A017]
                                  file:text-black
                                  hover:file:from-[#D4A017] hover:file:to-[#F5C518]
                                  file:cursor-pointer file:transition-all
                                  border border-[#242424] rounded-xl
                                  bg-black p-2 cursor-pointer">
                    <p class="mt-2 text-xs text-[#A1A1AA]">
                        Format: PNG, JPG (Max: 2MB)<br>
                        Rekomendasi: Photo square 400x400px
                    </p>
                    @error('avatar')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: User Info --}}
        <div class="lg:col-span-2">
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <h3 class="text-lg font-bold text-white mb-6">👤 Informasi Event Organizer</h3>
                
                <div class="space-y-4">
                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Nama Lengkap *</label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $user->name) }}"
                               required
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                        @error('name')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Email *</label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}"
                               required
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Company Name --}}
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Nama Perusahaan</label>
                        <input type="text" 
                               name="company_name" 
                               value="{{ old('company_name', $user->company_name) }}"
                               placeholder="PT. Contoh Event Organizer"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Nomor Telepon</label>
                        <input type="text" 
                               name="phone" 
                               value="{{ old('phone', $user->phone) }}"
                               placeholder="+62 812-3456-7890"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#A1A1AA] focus:outline-none focus:border-[#F5C518]">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Status *</label>
                        <select name="status"
                                required
                                class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                            <option value="pending" {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="suspended" {{ old('status', $user->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                            <option value="rejected" {{ old('status', $user->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-[#242424]">
                    <a href="{{ route('admin.users.event-organizers') }}" 
                       class="px-6 py-2.5 rounded-xl bg-black border border-[#242424] text-white text-sm font-semibold hover:bg-[#111111] transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-8 py-2.5 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black text-sm font-bold hover:from-[#D4A017] hover:to-[#F5C518] transition-all shadow-lg hover:shadow-xl hover:shadow-[#F5C518]/20 hover:scale-105">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>

@endsection
