@extends('layouts.admin-master')

@section('title', 'Edit Event')

@section('content')

{{-- Header --}}
<div class="mb-4">
    <h1 class="text-xl font-bold text-white">Edit Event</h1>
    <p class="text-gray-400 text-sm mt-1">Ubah detail event</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    
    {{-- LEFT: Form --}}
    <div class="lg:col-span-8">
        <div class="bg-[#0B1220] rounded-xl border border-white/10 p-5">
        
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" id="eventForm">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                
                {{-- Title --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">
                        Nama Event <span class="text-red-400">*</span>
                    </label>
                    <input type="text" 
                           name="title"
                           value="{{ old('title', $event->title) }}"
                           class="w-full px-3 py-2 text-sm rounded-lg bg-white/5 border @error('title') border-red-500 @else border-white/10 @enderror 
                                  text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors"
                           placeholder="Masukkan nama event"
                           required>
                    @error('title')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Location & Date --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    
                    {{-- Location --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5">
                            Lokasi <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="location"
                               value="{{ old('location', $event->location) }}"
                               class="w-full px-3 py-2 text-sm rounded-lg bg-white/5 border @error('location') border-red-500 @else border-white/10 @enderror 
                                      text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors"
                               placeholder="Jakarta, Indonesia"
                               required>
                        @error('location')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-300 mb-1.5">
                            Tanggal <span class="text-red-400">*</span>
                        </label>
                        <input type="date" 
                               name="date"
                               value="{{ old('date', $event->date->format('Y-m-d')) }}"
                               class="w-full px-3 py-2 text-sm rounded-lg bg-white/5 border @error('date') border-red-500 @else border-white/10 @enderror 
                                      text-white focus:outline-none focus:border-[#D4AF37] transition-colors"
                               required>
                        @error('date')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Time --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">
                        Waktu
                    </label>
                    <input type="time" 
                           name="time"
                           value="{{ old('time', $event->time) }}"
                           class="w-full px-3 py-2 text-sm rounded-lg bg-white/5 border @error('time') border-red-500 @else border-white/10 @enderror 
                                  text-white focus:outline-none focus:border-[#D4AF37] transition-colors">
                    @error('time')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">
                        Deskripsi Event
                    </label>
                    <textarea name="description"
                              rows="4"
                              class="w-full px-3 py-2 text-sm rounded-lg bg-white/5 border @error('description') border-red-500 @else border-white/10 @enderror 
                                     text-white placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] transition-colors resize-none"
                              placeholder="Jelaskan detail event...">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Event Category --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1.5">
                        Kategori Event <span class="text-red-400">*</span>
                    </label>
                    <select name="category_id" 
                            style="background-color: #1a2332 !important; color: #ffffff !important;"
                            class="w-full px-3 py-2 text-sm rounded-lg border @error('category_id') border-red-500 @else border-white/10 @enderror 
                                   focus:outline-none focus:border-[#D4AF37] transition-colors category-select"
                            required>
                        <option value="" style="background-color: #1a2332; color: #9CA3AF;">-- Pilih Kategori --</option>
                        @foreach(\App\Models\EventCategory::where('is_active', true)->orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}" style="background-color: #1a2332; color: #ffffff;" {{ old('category_id', $event->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
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
                                   {{ old('has_ticket_categories', $event->has_ticket_categories) ? 'checked' : '' }}>
                            <div class="w-14 h-7 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-500/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                        </label>
                    </div>
                </div>

                {{-- SECTION: Single Price & Quota (Default) --}}
                <div id="singlePriceSection" class="space-y-6 {{ old('has_ticket_categories', $event->has_ticket_categories) ? 'hidden' : '' }}">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">
                                Harga Tiket <span class="text-red-400">*</span>
                            </label>
                            <input type="number" 
                                   name="price"
                                   value="{{ old('price', $event->price) }}"
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
                                   value="{{ old('quota', $event->quota) }}"
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
                <div id="categoriesSection" class="space-y-6 {{ old('has_ticket_categories', $event->has_ticket_categories) ? '' : 'hidden' }}">
                    
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
                        @foreach($event->ticketCategories as $index => $category)
                        <div class="category-item p-5 rounded-xl bg-white/5 border border-white/10" data-index="{{ $index }}">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-white font-semibold">Kategori #{{ $index + 1 }}</h4>
                                <button type="button" onclick="removeCategory({{ $index }})" class="text-red-400 hover:text-red-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama Kategori <span class="text-red-400">*</span></label>
                                    <input type="text" name="categories[{{ $index }}][name]" 
                                           value="{{ old('categories.'.$index.'.name', $category->name) }}"
                                           class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                                           placeholder="Early Bird, Presale, Regular, VIP" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                                    <input type="text" name="categories[{{ $index }}][description]" 
                                           value="{{ old('categories.'.$index.'.description', $category->description) }}"
                                           class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                                           placeholder="Harga spesial untuk pembeli awal">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Harga <span class="text-red-400">*</span></label>
                                        <input type="number" name="categories[{{ $index }}][price]" 
                                               value="{{ old('categories.'.$index.'.price', $category->price) }}"
                                               class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                                               placeholder="125000" min="0" step="1000" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Kuota <span class="text-red-400">*</span></label>
                                        <input type="number" name="categories[{{ $index }}][quota]" 
                                               value="{{ old('categories.'.$index.'.quota', $category->quota) }}"
                                               class="w-full px-4 py-2.5 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-purple-500 focus:outline-none transition-colors" 
                                               placeholder="50" min="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @error('categories')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                    @enderror

                </div>

                {{-- SECTION PLACEMENT --}}
<div class="bg-white/5 rounded-xl border border-white/10 p-6">
    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1v-3z"/>
        </svg>
        📍 Penempatan di Homepage
    </h3>
    <p class="text-gray-400 text-sm mb-6">Pilih section mana event ini akan ditampilkan di halaman utama</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        {{-- Rekomendasi Event --}}
        <label class="flex items-start gap-3 p-4 rounded-lg bg-white/5 border border-white/10 hover:border-purple-500/50 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_recommended"
                   value="1"
                   {{ old('show_in_recommended', $event->show_in_recommended) ? 'checked' : '' }}
                   class="mt-1 w-5 h-5 rounded border-gray-600 text-purple-600 focus:ring-purple-500 focus:ring-offset-gray-900">
            <div class="flex-1">
                <div class="text-white font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Rekomendasi Event
                </div>
                <p class="text-gray-400 text-xs mt-1">Event pilihan editor yang direkomendasikan</p>
            </div>
        </label>

        {{-- Event Terdekat --}}
        <label class="flex items-start gap-3 p-4 rounded-lg bg-white/5 border border-white/10 hover:border-purple-500/50 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_nearest"
                   value="1"
                   {{ old('show_in_nearest', $event->show_in_nearest) ? 'checked' : '' }}
                   class="mt-1 w-5 h-5 rounded border-gray-600 text-purple-600 focus:ring-purple-500 focus:ring-offset-gray-900">
            <div class="flex-1">
                <div class="text-white font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Event Terdekat
                </div>
                <p class="text-gray-400 text-xs mt-1">Event yang dekat dari tanggal hari ini</p>
            </div>
        </label>

        {{-- Upcoming Event --}}
        <label class="flex items-start gap-3 p-4 rounded-lg bg-white/5 border border-white/10 hover:border-purple-500/50 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_upcoming"
                   value="1"
                   {{ old('show_in_upcoming', $event->show_in_upcoming) ? 'checked' : '' }}
                   class="mt-1 w-5 h-5 rounded border-gray-600 text-purple-600 focus:ring-purple-500 focus:ring-offset-gray-900">
            <div class="flex-1">
                <div class="text-white font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Upcoming Event
                </div>
                <p class="text-gray-400 text-xs mt-1">Event yang akan datang dalam waktu dekat</p>
            </div>
        </label>

        {{-- Popular Event --}}
        <label class="flex items-start gap-3 p-4 rounded-lg bg-white/5 border border-white/10 hover:border-purple-500/50 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_popular"
                   value="1"
                   {{ old('show_in_popular', $event->show_in_popular) ? 'checked' : '' }}
                   class="mt-1 w-5 h-5 rounded border-gray-600 text-purple-600 focus:ring-purple-500 focus:ring-offset-gray-900">
            <div class="flex-1">
                <div class="text-white font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                    </svg>
                    Popular Event
                </div>
                <p class="text-gray-400 text-xs mt-1">Event paling populer dan banyak diminati</p>
            </div>
        </label>

    </div>
</div>

                {{-- Image Upload --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Gambar Event
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
                                    💡 <strong>Tips:</strong> Kosongkan jika tidak ingin mengubah gambar event.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="relative rounded-2xl overflow-hidden aspect-[2/1] shadow-2xl border border-white/10" id="image-preview-container">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}"
                                     alt="{{ $event->title }}"
                                     class="w-full h-full object-cover"
                                     id="preview-image"/>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center" id="preview-placeholder">
                                    <svg class="w-24 h-24 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <img src="" alt="Preview" class="w-full h-full object-cover hidden" id="preview-image"/>
                            @endif
                        </div>
                    </div>

                    <input type="file" 
                           name="image"
                           accept="image/jpeg,image/png,image/jpg,image/webp"
                           id="image-input"
                           onchange="previewEventImage(event)"
                           class="mt-3 block w-full text-sm text-gray-400
                                  file:mr-4 file:py-2.5 file:px-5
                                  file:rounded-xl file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-[#D4AF37]/10 file:text-[#D4AF37]
                                  hover:file:bg-[#D4AF37]/20 file:transition-colors file:cursor-pointer">
                    
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
                        💾 UPDATE EVENT
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
    
    {{-- RIGHT: Live Preview --}}
    <div class="lg:sticky lg:top-20 h-fit">
        <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <h3 class="text-white font-bold">Preview Event Card</h3>
            </div>
            
            {{-- Preview Card --}}
            <div class="bg-[#050B14] rounded-2xl border border-white/10 overflow-hidden">
                {{-- Image Preview --}}
                <div class="relative aspect-[2/1] bg-gradient-to-br from-gray-900 via-gray-800 to-black overflow-hidden">
                    @if($event->image)
                    <img id="preview-card-image" 
                         src="{{ asset('storage/' . $event->image) }}" 
                         alt="Preview" 
                         class="w-full h-full object-cover">
                    @else
                    <img id="preview-card-image" 
                         src="" 
                         alt="Preview" 
                         class="w-full h-full object-cover hidden">
                    <div id="preview-card-placeholder" class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                    
                    {{-- Category Badge --}}
                    <div class="absolute top-3 left-3">
                        <span id="preview-category" class="inline-block px-3 py-1 rounded-full text-[10px] font-bold tracking-wider bg-[#D4AF37]/10 border border-[#D4AF37]/30 text-[#D4AF37]">
                            {{ $event->category->name ?? 'Kategori' }}
                        </span>
                    </div>
                </div>
                
                {{-- Card Content --}}
                <div class="p-4 space-y-3">
                    {{-- Title --}}
                    <h3 id="preview-title" class="text-white font-bold text-base line-clamp-1">
                        {{ $event->title }}
                    </h3>
                    
                    {{-- Location & Date --}}
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center gap-2 text-gray-400">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span id="preview-location" class="line-clamp-1">{{ $event->location }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-400">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span id="preview-date">{{ $event->date->format('d M Y') }}</span>
                        </div>
                    </div>
                    
                    {{-- Price --}}
                    <div class="flex items-center justify-between pt-2 border-t border-white/10">
                        <div>
                            <p class="text-[10px] text-gray-500 mb-0.5">Harga</p>
                            <p id="preview-price" class="text-[#D4AF37] font-bold text-sm">
                                @if($event->has_ticket_categories && $event->ticketCategories->isNotEmpty())
                                    Mulai dari Rp {{ number_format($event->ticketCategories->min('price'), 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($event->price, 0, ',', '.') }}
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-gray-500 mb-0.5">Tersisa</p>
                            <p id="preview-quota" class="text-white font-semibold text-sm">
                                {{ $event->quota - $event->sold_count }} tiket
                            </p>
                        </div>
                    </div>
                    
                    {{-- Button --}}
                    <button type="button" class="w-full py-2.5 rounded-xl text-xs font-bold tracking-wider bg-gradient-to-r from-[#D4AF37] to-[#F4C542] text-black hover:opacity-90 transition-opacity">
                        BELI TIKET
                    </button>
                </div>
            </div>
            
            <p class="text-xs text-gray-500 mt-4 text-center">
                Preview akan update otomatis saat Anda mengubah data
            </p>
        </div>
    </div>
    
</div>

@endsection

@push('styles')
<style>
/* Custom styling for category select dropdown */
.category-select {
    color-scheme: dark;
    background-color: #1a2332 !important;
    color: #ffffff !important;
}

/* Styling untuk Firefox */
.category-select option {
    background-color: #1a2332;
    color: #ffffff;
    padding: 8px;
}

.category-select option:checked {
    background-color: #D4AF37;
    color: #000000;
}

/* Styling placeholder */
.category-select option[value=""] {
    color: #9CA3AF;
}
</style>
@endpush

@push('scripts')
<script>
let categoryIndex = {{ $event->ticketCategories->count() }};

// Fix dropdown styling on click (for browsers that don't support option CSS)
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.querySelector('.category-select');
    
    if (categorySelect) {
        // Set dark background when dropdown opens
        categorySelect.addEventListener('focus', function() {
            this.style.backgroundColor = '#1a2332';
            this.style.color = '#ffffff';
        });
        
        // Keep styling on change
        categorySelect.addEventListener('change', function() {
            this.style.backgroundColor = '#0B1220';
            this.style.color = '#ffffff';
        });
    }
});

// Toggle Categories Section
const toggleCategories = document.getElementById('toggleCategories');
const singleSection = document.getElementById('singlePriceSection');
const categoriesSection = document.getElementById('categoriesSection');

if (toggleCategories) {
    toggleCategories.addEventListener('change', function() {
        if (this.checked) {
            singleSection.classList.add('hidden');
            categoriesSection.classList.remove('hidden');
            
            // Disable required validation on single price fields
            const priceInput = singleSection.querySelector('input[name="price"]');
            const quotaInput = singleSection.querySelector('input[name="quota"]');
            if (priceInput) priceInput.removeAttribute('required');
            if (quotaInput) quotaInput.removeAttribute('required');
            
            // Add default category if empty
            if (document.getElementById('categoriesContainer').children.length === 0) {
                addCategory();
            }
        } else {
            singleSection.classList.remove('hidden');
            categoriesSection.classList.add('hidden');
            
            // Re-enable required validation on single price fields
            const priceInput = singleSection.querySelector('input[name="price"]');
            const quotaInput = singleSection.querySelector('input[name="quota"]');
            if (priceInput) priceInput.setAttribute('required', 'required');
            if (quotaInput) quotaInput.setAttribute('required', 'required');
        }
    });
    
    // Initialize on page load
    if (toggleCategories.checked) {
        const priceInput = singleSection.querySelector('input[name="price"]');
        const quotaInput = singleSection.querySelector('input[name="quota"]');
        if (priceInput) priceInput.removeAttribute('required');
        if (quotaInput) quotaInput.removeAttribute('required');
    }
}

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
    const previewImg = document.getElementById('preview-image');
    const previewPlaceholder = document.getElementById('preview-placeholder');
    const previewCardImg = document.getElementById('preview-card-image');
    const previewCardPlaceholder = document.getElementById('preview-card-placeholder');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update form preview
            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                
                if (previewPlaceholder) {
                    previewPlaceholder.classList.add('hidden');
                }
            }
            
            // Update card preview
            if (previewCardImg) {
                previewCardImg.src = e.target.result;
                previewCardImg.classList.remove('hidden');
                
                if (previewCardPlaceholder) {
                    previewCardPlaceholder.classList.add('hidden');
                }
            }
        }
        reader.readAsDataURL(file);
    }
}

// Live Preview Updates
document.addEventListener('DOMContentLoaded', function() {
    // Title
    const titleInput = document.querySelector('input[name="title"]');
    if (titleInput) {
        titleInput.addEventListener('input', function() {
            document.getElementById('preview-title').textContent = this.value || 'Nama Event';
        });
    }
    
    // Location
    const locationInput = document.querySelector('input[name="location"]');
    if (locationInput) {
        locationInput.addEventListener('input', function() {
            document.getElementById('preview-location').textContent = this.value || 'Lokasi';
        });
    }
    
    // Date
    const dateInput = document.querySelector('input[name="date"]');
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            if (this.value) {
                const date = new Date(this.value);
                const formatted = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                document.getElementById('preview-date').textContent = formatted;
            }
        });
    }
    
    // Category
    const categorySelect = document.querySelector('select[name="category_id"]');
    if (categorySelect) {
        categorySelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('preview-category').textContent = selectedOption.text || 'Kategori';
        });
    }
    
    // Price (single price mode)
    const priceInput = document.querySelector('input[name="price"]');
    if (priceInput) {
        priceInput.addEventListener('input', function() {
            const price = parseInt(this.value) || 0;
            const formatted = price.toLocaleString('id-ID');
            document.getElementById('preview-price').textContent = 'Rp ' + formatted;
        });
    }
    
    // Quota (single quota mode)
    const quotaInput = document.querySelector('input[name="quota"]');
    if (quotaInput) {
        quotaInput.addEventListener('input', function() {
            const quota = parseInt(this.value) || 0;
            document.getElementById('preview-quota').textContent = quota + ' tiket';
        });
    }
    
    // Toggle Categories - update preview when switching modes
    const toggleCategoriesCheckbox = document.getElementById('toggleCategories');
    if (toggleCategoriesCheckbox) {
        toggleCategoriesCheckbox.addEventListener('change', function() {
            updatePricePreview();
        });
    }
    
    // Function to update price preview from categories
    function updatePricePreview() {
        const categoriesContainer = document.getElementById('categoriesContainer');
        if (!categoriesContainer) return;
        
        const priceInputs = categoriesContainer.querySelectorAll('input[name*="[price]"]');
        const prices = Array.from(priceInputs).map(input => parseInt(input.value) || 0).filter(p => p > 0);
        
        if (prices.length > 0) {
            const minPrice = Math.min(...prices);
            const formatted = minPrice.toLocaleString('id-ID');
            document.getElementById('preview-price').textContent = 'Mulai dari Rp ' + formatted;
            
            // Update quota from categories
            const quotaInputs = categoriesContainer.querySelectorAll('input[name*="[quota]"]');
            const totalQuota = Array.from(quotaInputs).reduce((sum, input) => sum + (parseInt(input.value) || 0), 0);
            document.getElementById('preview-quota').textContent = totalQuota + ' tiket';
        }
    }
    
    // Listen to category price/quota changes
    document.addEventListener('input', function(e) {
        if (e.target.matches('input[name*="categories"][name*="[price]"]') || 
            e.target.matches('input[name*="categories"][name*="[quota]"]')) {
            updatePricePreview();
        }
    });
});
</script>
@endpush
