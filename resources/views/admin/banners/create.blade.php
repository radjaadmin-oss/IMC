@extends('layouts.admin')

@section('title', 'Tambah Banner')
@section('page-title', 'Tambah Banner Baru')
@section('page-subtitle', 'Upload banner promo untuk halaman utama')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('admin.banners.index') }}" 
           class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Banner
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.banners.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl border border-white/10 p-8">
        @csrf

        {{-- Title --}}
        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-white mb-2">
                Judul Banner <span class="text-red-400">*</span>
            </label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title') }}"
                   class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-[#F5C518] focus:ring-2 focus:ring-[#F5C518]/20 transition-all"
                   placeholder="Contoh: Promo Event Spesial 50%"
                   required>
            @error('title')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Desktop Image --}}
<div class="col-span-2">
    <label class="block text-sm font-medium text-gray-300 mb-2">
        Desktop Image <span class="text-red-400">*</span>
    </label>
    
    <div class="mb-3 p-4 rounded-xl bg-blue-500/10 border border-blue-500/30">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div class="flex-1 text-sm">
                <p class="text-blue-300 font-semibold mb-1">📐 Ukuran yang Disarankan:</p>
                <ul class="text-blue-200 space-y-1 text-xs">
                    <li>• <strong>Lebar:</strong> 1920 pixel (px)</li>
                    <li>• <strong>Tinggi:</strong> 500 pixel (px)</li>
                    <li>• <strong>Rasio:</strong> 3.84:1 (Landscape)</li>
                    <li>• <strong>Format:</strong> JPG, PNG, WEBP</li>
                    <li>• <strong>Ukuran File:</strong> Maksimal 2 MB</li>
                </ul>
                <p class="text-yellow-300 text-xs mt-2">
                    💡 <strong>Tips:</strong> Gunakan gambar berkualitas tinggi dengan resolusi minimal 1920x500px agar tampil tajam di layar besar.
                </p>
            </div>
        </div>
    </div>
    
    <input type="file" 
           name="desktop_image" 
           id="desktop_image"
           accept="image/jpeg,image/png,image/webp"
           required
           class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#F5C518] file:text-black hover:file:bg-[#E5B50F] cursor-pointer">
    
    @error('desktop_image')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
    @enderror
</div>
            
            {{-- Preview Container --}}
            <div id="desktop-preview" class="mt-4 hidden">
                <p class="text-xs text-gray-500 mb-2">Preview Desktop Banner:</p>
                <img src="" alt="Preview" class="w-full h-48 object-cover rounded-xl border border-white/10">
            </div>
        </div>
        {{-- Mobile Image (Optional) --}}
        <div class="mb-6">
            <label for="mobile_image" class="block text-sm font-semibold text-white mb-2">
                Mobile Image <span class="text-gray-600">(Opsional)</span>
            </label>
            
            {{-- Keterangan Ukuran Mobile --}}
            <div class="mb-4 p-4 rounded-xl bg-purple-500/10 border border-purple-500/30">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-purple-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <div class="text-sm text-purple-300">
                        <p class="font-semibold mb-1">📱 Ukuran Mobile (Opsional):</p>
                        <ul class="space-y-1 text-xs">
                            <li>• <span class="font-bold text-white">Lebar:</span> 750 pixel (px)</li>
                            <li>• <span class="font-bold text-white">Tinggi:</span> 400 pixel (px)</li>
                            <li>• <span class="font-bold text-white">Rasio:</span> 1.9:1 (Landscape)</li>
                            <li>• <span class="font-bold text-white">Format:</span> JPG, PNG, WEBP</li>
                            <li>• <span class="font-bold text-white">Ukuran File:</span> Maksimal 2 MB</li>
                        </ul>
                        <p class="mt-2 text-xs text-purple-400">
                            💡 <strong>Tips:</strong> Jika tidak diupload, banner desktop akan otomatis dipakai untuk mobile.
                        </p>
                    </div>
                </div>
            </div>

            <input type="file" 
                   id="mobile_image" 
                   name="mobile_image" 
                   accept="image/jpeg,image/jpg,image/png,image/webp"
                   class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-500 file:text-white hover:file:bg-purple-600 transition-all"
                   onchange="previewImage(event, 'mobile-preview')">
            @error('mobile_image')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
            
            {{-- Preview Container --}}
            <div id="mobile-preview" class="mt-4 hidden">
                <p class="text-xs text-gray-500 mb-2">Preview Mobile Banner:</p>
                <img src="" alt="Preview" class="w-full h-32 object-cover rounded-xl border border-white/10">
            </div>
        </div>

        {{-- Link to Event --}}
        <div class="mb-6">
            <label for="event_id" class="block text-sm font-semibold text-white mb-2">
                Link ke Event <span class="text-gray-600">(Opsional)</span>
            </label>
            <select id="event_id" 
                    name="event_id"
                    class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-[#F5C518] focus:ring-2 focus:ring-[#F5C518]/20 transition-all">
                <option value="">-- Pilih Event (Opsional) --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                        {{ $event->title }} ({{ $event->date->format('d M Y') }})
                    </option>
                @endforeach
            </select>
            @error('event_id')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        {{-- Status & Sort Order (2 columns) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            {{-- Status --}}
            <div>
                <label for="status" class="block text-sm font-semibold text-white mb-2">
                    Status <span class="text-red-400">*</span>
                </label>
                <select id="status" 
                        name="status"
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-[#F5C518] focus:ring-2 focus:ring-[#F5C518]/20 transition-all"
                        required>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active (Tampil)</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive (Sembunyi)</option>
                </select>
                @error('status')
                    <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-white mb-2">
                    Urutan Tampil <span class="text-red-400">*</span>
                </label>
                <input type="number" 
                       id="sort_order" 
                       name="sort_order" 
                       value="{{ old('sort_order', 1) }}"
                       min="0"
                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-[#F5C518] focus:ring-2 focus:ring-[#F5C518]/20 transition-all"
                       required>
                <p class="text-xs text-gray-500 mt-2">Banner dengan urutan lebih kecil muncul lebih dulu</p>
                @error('sort_order')
                    <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Divider --}}
        <div class="border-t border-white/10 my-8"></div>

        {{-- Action Buttons --}}
        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold text-sm hover:scale-105 transition-transform shadow-lg">
                Simpan Banner
            </button>
            <a href="{{ route('admin.banners.index') }}" 
               class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-400 font-semibold text-sm hover:bg-white/10 hover:text-white transition-all">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection

@push('scripts')
<script>
function previewImage(event, previewId) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById(previewId);
    const previewImg = previewContainer.querySelector('img');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('hidden');
    }
}
</script>
@endpush
