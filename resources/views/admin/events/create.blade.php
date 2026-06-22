@extends('layouts.admin')

@section('page-title', 'Tambah Event')
@section('page-subtitle', 'Buat event baru')

@section('content')

<div class="max-w-4xl">
    
    <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-8">
        
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
            @csrf
            
            <div class="space-y-6">
                
                {{-- Title --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Nama Event <span class="text-red-400">*</span>
                    </label>
                    <input type="text" 
                           name="title"
                           value="{{ old('title') }}"
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('title') border-red-500 @else border-white/10 @enderror 
                                  text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors"
                           placeholder="Masukkan nama event"
                           required>
                    @error('title')
                        <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Location & Date --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    {{-- Location --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Lokasi <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="location"
                               value="{{ old('location') }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('location') border-red-500 @else border-white/10 @enderror 
                                      text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors"
                               placeholder="Jakarta, Indonesia"
                               required>
                        @error('location')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Tanggal <span class="text-red-400">*</span>
                        </label>
                        <input type="date" 
                               name="date"
                               value="{{ old('date') }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('date') border-red-500 @else border-white/10 @enderror 
                                      text-white focus:outline-none focus:border-[#D4AF37] transition-colors"
                               required>
                        @error('date')
                            <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Time --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Waktu
                    </label>
                    <input type="time" 
                           name="time"
                           value="{{ old('time') }}"
                           class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('time') border-red-500 @else border-white/10 @enderror 
                                  text-white focus:outline-none focus:border-[#D4AF37] transition-colors">
                    @error('time')
                        <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Deskripsi Event
                    </label>
                    <textarea name="description"
                              rows="5"
                              class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('description') border-red-500 @else border-white/10 @enderror 
                                     text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors resize-none"
                              placeholder="Jelaskan detail event...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TOGGLE: Gunakan Kategori Tiket --}}
                <div class="p-5 rounded-xl bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-500/30">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-white font-semibold mb-1">🎫 Gunakan Kategori Tiket</h3>
                            <p class="text-gray-400 text-sm">Aktifkan untuk membuat multiple kategori tiket (Early Bird, Presale, Regular, VIP)</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="has_ticket_categories" 
                                   id="toggleCategories"
                                   class="sr-only peer"
                                   {{ old('has_ticket_categories') ? 'checked' : '' }}>
                            <div class="w-14 h-7 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-500/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>
                </div>

                {{-- SECTION: Single Price & Quota (Default) --}}
                <div id="singlePriceSection" class="space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">
                                Harga Tiket <span class="text-red-400">*</span>
                            </label>
                            <input type="number" 
                                   name="price"
                                   value="{{ old('price', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('price') border-red-500 @else border-white/10 @enderror 
                                          text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors"
                                   placeholder="500000">
                            @error('price')
                                <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Quota --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">
                                Kuota Tiket <span class="text-red-400">*</span>
                            </label>
                            <input type="number" 
                                   name="quota"
                                   value="{{ old('quota', 100) }}"
                                   min="1"
                                   class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('quota') border-red-500 @else border-white/10 @enderror 
                                          text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors"
                                   placeholder="100">
                            @error('quota')
                                <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- SECTION: Multiple Ticket Categories --}}
                <div id="categoriesSection" class="hidden space-y-6">
                    
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">🎟️ Kategori Tiket</h3>
                        <button type="button" 
                                onclick="addCategory()"
                                class="px-4 py-2 rounded-lg bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Kategori
                        </button>
                    </div>

                    <div id="categoriesContainer" class="space-y-4">
                        <!-- Categories will be added here dynamically -->
                    </div>

                    @error('categories')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Image Upload --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Gambar Event <span class="text-red-400">*</span>
                    </label>
                    
                    {{-- Keterangan Ukuran Gambar --}}
                    <div class="mb-4 p-4 rounded-xl bg-blue-500/10 border border-blue-500/30">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="flex-1 text-sm">
                                <p class="text-blue-300 font-semibold mb-1">📐 Ukuran yang Disarankan:</p>
                                <ul class="text-blue-200 space-y-1 text-xs">
                                    <li>• <strong>Lebar:</strong> 800 pixel (px)</li>
                                    <li>• <strong>Tinggi:</strong> 400 pixel (px)</li>
                                    <li>• <strong>Rasio:</strong> 2:1 (Landscape - Event Card)</li>
                                    <li>• <strong>Format:</strong> JPEG, PNG, JPG, WEBP</li>
                                    <li>• <strong>Ukuran File:</strong> Maksimal 2 MB</li>
                                </ul>
                                <p class="text-yellow-300 text-xs mt-2">
                                    💡 <strong>Tips:</strong> Gunakan gambar landscape berkualitas tinggi agar tampil optimal di card homepage dan halaman detail.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="relative rounded-2xl overflow-hidden aspect-[2/1] shadow-2xl border border-white/10" id="image-preview-container">
                            @if(!empty($event->image ?? null))
                                <img src="{{ asset('storage/' . $event->image) }}"
                                     alt="{{ $event->title ?? '' }}"
                                     class="w-full h-full object-cover"
                                     id="preview-image"/>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="w-24 h-24 text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-gray-600 text-sm">Preview gambar akan muncul di sini</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <input type="file" 
                           name="image"
                           id="image-input"
                           accept="image/jpeg,image/png,image/jpg,image/webp"
                           onchange="previewEventImage(event)"
                           class="mt-3 block w-full text-sm text-gray-400
                                  file:mr-4 file:py-2.5 file:px-5
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-[#D4AF37]/10 file:text-[#D4AF37]
                                  hover:file:bg-[#D4AF37]/20 file:transition-colors file:cursor-pointer"
                           required>
                    
                    @error('image')
                        <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Buttons --}}
                <div class="flex items-center gap-4 pt-6 border-t border-white/10">
                    <button type="submit"
                            class="px-6 py-3 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#FFD700] 
                                   text-black font-bold text-sm tracking-wider
                                   hover:from-[#FFD700] hover:to-[#D4AF37] 
                                   transition-all duration-300 shadow-lg hover:shadow-[#D4AF37]/50">
                        💾 SIMPAN EVENT
                    </button>
                    
                    <a href="{{ route('admin.events.index') }}"
                       class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 
                              text-gray-300 font-semibold text-sm
                              hover:bg-white/10 transition-colors">
                        Batal
                    </a>
                </div>

            </div>
            
        </form>
        
    </div>
    
</div>

@endsection

@push('scripts')
<script>
let categoryIndex = 0;

// Toggle Categories Section
document.getElementById('toggleCategories').addEventListener('change', function() {
    const singleSection = document.getElementById('singlePriceSection');
    const categoriesSection = document.getElementById('categoriesSection');
    
    if (this.checked) {
        singleSection.classList.add('hidden');
        categoriesSection.classList.remove('hidden');
        
        // Add default category if empty
        if (document.getElementById('categoriesContainer').children.length === 0) {
            addCategory();
        }
    } else {
        singleSection.classList.remove('hidden');
        categoriesSection.classList.add('hidden');
    }
});

// Add Category
function addCategory() {
    const container = document.getElementById('categoriesContainer');
    const index = categoryIndex++;
    
    const categoryHtml = `
        <div class="category-item p-5 rounded-xl bg-white/5 border border-white/10" data-index="${index}">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-white font-semibold">Kategori #${index + 1}</h4>
                <button type="button" onclick="removeCategory(${index})" class="text-red-400 hover:text-red-300 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama Kategori <span class="text-red-400">*</span></label>
                    <input type="text" name="categories[${index}][name]" 
                           class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                           placeholder="Early Bird, Presale, Regular, VIP" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                    <input type="text" name="categories[${index}][description]" 
                           class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                           placeholder="Harga spesial untuk pembeli awal">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Harga <span class="text-red-400">*</span></label>
                        <input type="number" name="categories[${index}][price]" 
                               class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                               placeholder="125000" min="0" step="1000" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Kuota <span class="text-red-400">*</span></label>
                        <input type="number" name="categories[${index}][quota]" 
                               class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                               placeholder="50" min="1" required>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', categoryHtml);
}

// Remove Category
function removeCategory(index) {
    const item = document.querySelector(`[data-index="${index}"]`);
    if (item) {
        item.remove();
    }
}

// Preview Image
function previewEventImage(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('image-preview-container');
    const previewImg = document.getElementById('preview-image');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            if (previewImg) {
                previewImg.src = e.target.result;
            } else {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Preview" 
                         id="preview-image"
                         class="w-full h-full object-cover"/>
                `;
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
