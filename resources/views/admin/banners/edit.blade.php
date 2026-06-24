@extends('layouts.admin-master')

@section('title', 'Edit Banner')
@section('page-title', 'Edit Banner')
@section('page-subtitle', 'Update informasi banner promo')

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
    <form action="{{ route('admin.banners.update', $banner) }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl border border-white/10 p-8">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-white mb-2">
                Judul Banner <span class="text-red-400">*</span>
            </label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   value="{{ old('title', $banner->title) }}"
                   class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-[#F5C518] focus:ring-2 focus:ring-[#F5C518]/20 transition-all"
                   required>
            @error('title')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Current Desktop Image --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-white mb-2">Current Desktop Image</label>
            <img src="{{ asset('storage/' . $banner->desktop_image) }}" 
                 alt="Current Banner"
                 class="w-full h-48 object-cover rounded-xl border border-white/10 mb-4">
        </div>

        {{-- Desktop Image (Update) --}}
        <div class="mb-6">
            <label for="desktop_image" class="block text-sm font-semibold text-white mb-2">
                Update Desktop Image <span class="text-gray-600">(Opsional)</span>
            </label>
            
            <div class="mb-4 p-4 rounded-xl bg-blue-500/10 border border-blue-500/30">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-blue-300">
                        <p class="font-semibold mb-1">📐 Ukuran Desktop Banner:</p>
                        <ul class="space-y-1 text-xs">
                            <li>• <span class="font-bold text-white">Dimensi:</span> 1920 x 550 pixel</li>
                            <li>• <span class="font-bold text-white">Format:</span> JPG, PNG, WEBP (maks 2MB)</li>
                        </ul>
                        <p class="mt-2 text-xs text-blue-400">
                            💡 Kosongkan jika tidak ingin mengganti gambar yang sudah ada.
                        </p>
                    </div>
                </div>
            </div>

            <input type="file" 
                   id="desktop_image" 
                   name="desktop_image" 
                   accept="image/jpeg,image/jpg,image/png,image/webp"
                   class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#F5C518] file:text-black hover:file:bg-[#D4A017] transition-all"
                   onchange="previewImage(event, 'desktop-preview')">
            @error('desktop_image')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
            <div id="desktop-preview" class="mt-4 hidden">
                <p class="text-xs text-gray-500 mb-2">Preview Baru:</p>
                <img src="" alt="Preview" class="w-full h-48 object-cover rounded-xl border border-white/10">
            </div>
        </div>

        {{-- Current Mobile Image --}}
        @if($banner->mobile_image)
            <div class="mb-6">
                <label class="block text-sm font-semibold text-white mb-2">Current Mobile Image</label>
                <img src="{{ asset('storage/' . $banner->mobile_image) }}" 
                     alt="Current Mobile Banner"
                     class="w-full h-32 object-cover rounded-xl border border-white/10 mb-4">
            </div>
        @endif

        {{-- Mobile Image (Update) --}}
        <div class="mb-6">
            <label for="mobile_image" class="block text-sm font-semibold text-white mb-2">
                Update Mobile Image <span class="text-gray-600">(Opsional)</span>
            </label>
            
            <div class="mb-4 p-4 rounded-xl bg-purple-500/10 border border-purple-500/30">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-purple-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <div class="text-sm text-purple-300">
                        <p class="font-semibold mb-1">📱 Ukuran Mobile Banner:</p>
                        <ul class="space-y-1 text-xs">
                            <li>• <span class="font-bold text-white">Dimensi:</span> 750 x 400 pixel</li>
                            <li>• <span class="font-bold text-white">Format:</span> JPG, PNG, WEBP (maks 2MB)</li>
                        </ul>
                        <p class="mt-2 text-xs text-purple-400">
                            💡 Kosongkan jika tidak ingin mengganti.
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
            <div id="mobile-preview" class="mt-4 hidden">
                <p class="text-xs text-gray-500 mb-2">Preview Baru:</p>
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
                    <option value="{{ $event->id }}" {{ old('event_id', $banner->event_id) == $event->id ? 'selected' : '' }}>
                        {{ $event->title }} ({{ $event->date->format('d M Y') }})
                    </option>
                @endforeach
            </select>
            @error('event_id')
                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status & Sort Order --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div>
                <label for="is_active" class="block text-sm font-semibold text-white mb-2">
                    Status <span class="text-red-400">*</span>
                </label>
                <select id="is_active" 
                        name="is_active"
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-[#F5C518] focus:ring-2 focus:ring-[#F5C518]/20 transition-all"
                        required>
                    <option value="1" {{ old('is_active', $banner->is_active) == 1 ? 'selected' : '' }}>Active (Tampil)</option>
                    <option value="0" {{ old('is_active', $banner->is_active) == 0 ? 'selected' : '' }}>Inactive (Sembunyi)</option>
                </select>
                @error('is_active')
                    <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-semibold text-white mb-2">
                    Urutan Tampil <span class="text-red-400">*</span>
                </label>
                <input type="number" 
                       id="sort_order" 
                       name="sort_order" 
                       value="{{ old('sort_order', $banner->sort_order) }}"
                       min="0"
                       class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:border-[#F5C518] focus:ring-2 focus:ring-[#F5C518]/20 transition-all"
                       required>
                <p class="text-xs text-gray-500 mt-2">Banner dengan urutan lebih kecil muncul lebih dulu</p>
                @error('sort_order')
                    <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="border-t border-white/10 my-8"></div>

        {{-- Action Buttons --}}
        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold text-sm hover:scale-105 transition-transform shadow-lg">
                Update Banner
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
