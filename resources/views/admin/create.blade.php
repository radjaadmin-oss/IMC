@extends('layouts.admin')

@section('content')

{{-- ═══════════════════════════════════════════════════════════════
    HEADER
═══════════════════════════════════════════════════════════════ --}}
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-wider mb-2">Tambah Event Baru</h1>
            <p class="text-gray-500 text-sm">Lengkapi semua informasi event untuk ditampilkan di website</p>
        </div>
        <a href="{{ route('admin.events.index') }}" 
           class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:border-white/20 transition-all text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Event
        </a>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════
    FORM
═══════════════════════════════════════════════════════════════ --}}
<form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-8 space-y-6">
        
        {{-- ─── BASIC INFO ─── --}}
        <div class="space-y-5">
            <h3 class="text-lg font-bold text-[#F5C518] tracking-wider">INFORMASI DASAR</h3>
            
            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Judul Event <span class="text-red-400">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}"
                       required
                       placeholder="Contoh: Radja Live In Concert 2026"
                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-[#F5C518] focus:ring-1 focus:ring-[#F5C518] transition-all">
                @error('title')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Location --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Lokasi <span class="text-red-400">*</span>
                </label>
                <input type="text" 
                       name="location" 
                       value="{{ old('location') }}"
                       required
                       placeholder="Contoh: Jakarta Convention Center, Jakarta"
                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-[#F5C518] focus:ring-1 focus:ring-[#F5C518] transition-all">
                @error('location')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Date & Time --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Tanggal <span class="text-red-400">*</span>
                    </label>
                    <input type="date" 
                           name="date" 
                           value="{{ old('date') }}"
                           required
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:border-[#F5C518] focus:ring-1 focus:ring-[#F5C518] transition-all">
                    @error('date')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Waktu <span class="text-gray-500">(Optional)</span>
                    </label>
                    <input type="text" 
                           name="time" 
                           value="{{ old('time') }}"
                           placeholder="Contoh: 19:00 WIB"
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-[#F5C518] focus:ring-1 focus:ring-[#F5C518] transition-all">
                    @error('time')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Deskripsi <span class="text-gray-500">(Optional)</span>
                </label>
                <textarea name="description" 
                          rows="5"
                          placeholder="Tulis deskripsi lengkap tentang event ini..."
                          class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-[#F5C518] focus:ring-1 focus:ring-[#F5C518] transition-all resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="border-t border-white/10"></div>
        
        {{-- ─── PRICING & QUOTA ─── --}}
        <div class="space-y-5">
            <h3 class="text-lg font-bold text-[#F5C518] tracking-wider">HARGA & KUOTA</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Price --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Harga per Tiket <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                        <input type="number" 
                               name="price" 
                               value="{{ old('price', 0) }}"
                               required
                               min="0"
                               placeholder="50000"
                               class="w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-[#F5C518] focus:ring-1 focus:ring-[#F5C518] transition-all">
                    </div>
                    <p class="text-xs text-gray-600 mt-1">Isi 0 untuk event gratis</p>
                    @error('price')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Quota --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Kuota Tiket <span class="text-red-400">*</span>
                    </label>
                    <input type="number" 
                           name="quota" 
                           value="{{ old('quota', 100) }}"
                           required
                           min="1"
                           placeholder="100"
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-[#F5C518] focus:ring-1 focus:ring-[#F5C518] transition-all">
                    <p class="text-xs text-gray-600 mt-1">Total tiket yang tersedia</p>
                    @error('quota')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="border-t border-white/10"></div>
        
        {{-- ─── IMAGE UPLOAD ─── --}}
        <div class="space-y-5">
            <h3 class="text-lg font-bold text-[#F5C518] tracking-wider">GAMBAR EVENT</h3>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Poster / Banner Event <span class="text-red-400">*</span>
                </label>
                
                <div class="mb-3 p-4 rounded-xl bg-blue-500/10 border border-blue-500/30">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div class="flex-1 text-sm">
                            <p class="text-blue-300 font-semibold mb-1">📐 Rekomendasi Ukuran:</p>
                            <ul class="text-blue-200 space-y-1 text-xs">
                                <li>• <strong>Rasio:</strong> 2:3 (Portrait) atau 16:9 (Landscape)</li>
                                <li>• <strong>Resolusi:</strong> Minimal 800x1200px (portrait) atau 1280x720px (landscape)</li>
                                <li>• <strong>Format:</strong> JPG, PNG, WEBP</li>
                                <li>• <strong>Ukuran File:</strong> Maksimal 2 MB</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <input type="file" 
                       name="image" 
                       id="imageInput"
                       accept="image/jpeg,image/png,image/webp"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#F5C518] file:text-black hover:file:bg-[#E5B50F] cursor-pointer transition-all">
                
                <p id="fileSizeDisplay" class="text-xs text-gray-600 mt-2"></p>
                
                @error('image')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
    </div>
    
    {{-- ─── ACTION BUTTONS ─── --}}
    <div class="flex items-center gap-4 mt-6">
        <button type="submit" 
                class="flex-1 py-3 px-6 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold text-sm tracking-wider hover:from-[#E5B50F] hover:to-[#C49016] transition-all shadow-lg hover:shadow-xl">
            💾 SIMPAN EVENT
        </button>
        
        <a href="{{ route('admin.events.index') }}" 
           class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:border-white/20 transition-all text-sm font-medium">
            Batal
        </a>
    </div>
    
</form>

@endsection

@push('scripts')
<script>
// File size validation
const fileInput = document.getElementById('imageInput');
const fileSizeDisplay = document.getElementById('fileSizeDisplay');

fileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
        fileSizeDisplay.textContent = `📁 Ukuran file: ${sizeInMB} MB`;
        
        if (sizeInMB > 2) {
            fileSizeDisplay.classList.add('text-red-400');
            fileSizeDisplay.classList.remove('text-gray-600');
            fileSizeDisplay.textContent += ' ⚠️ Ukuran melebihi batas maksimal 2MB!';
        } else {
            fileSizeDisplay.classList.add('text-green-400');
            fileSizeDisplay.classList.remove('text-red-400', 'text-gray-600');
            fileSizeDisplay.textContent += ' ✓ Ukuran file OK';
        }
    }
});
</script>
@endpush
