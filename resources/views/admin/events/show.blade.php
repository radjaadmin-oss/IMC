@extends('layouts.admin-master')

@section('title', 'Detail Event - ' . $event->title)

@section('content')

<div class="space-y-6">
    
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Detail Event</h1>
            <p class="text-gray-400 mt-1">Informasi lengkap event</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.events.edit', $event) }}" class="flex items-center gap-2 px-4 py-2.5 bg-yellow-500/10 hover:bg-yellow-500/20 border border-yellow-500/30 text-yellow-500 rounded-xl font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Event
            </a>
            <a href="{{ route('admin.events.index') }}" class="flex items-center gap-2 px-4 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 hover:text-white rounded-xl font-medium transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Left Column: Event Image & Basic Info --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Event Image --}}
            <div class="bg-[#111111] border border-white/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Cover Image</h2>
                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" 
                         alt="{{ $event->title }}" 
                         class="w-full aspect-[16/9] object-cover rounded-xl">
                @else
                    <div class="w-full aspect-[16/9] bg-[#0A0A0A] rounded-xl flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Event Info --}}
            <div class="bg-[#111111] border border-white/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Informasi Event</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-500 block mb-1">Judul Event</label>
                        <p class="text-white font-semibold text-lg">{{ $event->title }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm text-gray-500 block mb-1">Tanggal</label>
                            <div class="flex items-center gap-2 text-white">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $event->date->format('d M Y') }}
                            </div>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500 block mb-1">Waktu</label>
                            <div class="flex items-center gap-2 text-white">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $event->time ?? 'Belum ditentukan' }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500 block mb-1">Lokasi</label>
                        <div class="flex items-center gap-2 text-white">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $event->location }}
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500 block mb-1">Deskripsi</label>
                        <div class="text-gray-300 leading-relaxed">
                            {!! nl2br(e($event->description ?? 'Tidak ada deskripsi')) !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ticket Categories --}}
            @if($event->has_ticket_categories && $event->ticketCategories->isNotEmpty())
            <div class="bg-[#111111] border border-white/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Kategori Tiket</h2>
                
                <div class="space-y-3">
                    @foreach($event->ticketCategories as $category)
                    <div class="bg-[#0A0A0A] border border-white/5 rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-white font-semibold">{{ $category->name }}</h3>
                            <span class="text-yellow-500 font-bold text-lg">Rp {{ number_format($category->price, 0, ',', '.') }}</span>
                        </div>
                        @if($category->description)
                        <p class="text-gray-400 text-sm mb-3">{{ $category->description }}</p>
                        @endif
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Kuota: <span class="text-white font-medium">{{ $category->quota }}</span></span>
                            <span class="text-gray-500">Terjual: <span class="text-green-400 font-medium">{{ $category->sold }}</span></span>
                            <span class="text-gray-500">Tersisa: <span class="text-blue-400 font-medium">{{ $category->quota - $category->sold }}</span></span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- Right Column: Status & Actions --}}
        <div class="space-y-6">
            
            {{-- Status Card --}}
            <div class="bg-[#111111] border border-white/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Status Event</h2>
                
                <div class="space-y-4">
                    {{-- Status Badge --}}
                    <div>
                        <label class="text-sm text-gray-500 block mb-2">Status Approval</label>
                        @if($event->status === 'approved')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-500/10 text-green-400 text-sm font-semibold rounded-lg border border-green-500/20">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Approved
                            </span>
                        @elseif($event->status === 'pending')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-500/10 text-yellow-400 text-sm font-semibold rounded-lg border border-yellow-500/20">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                Pending
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500/10 text-red-400 text-sm font-semibold rounded-lg border border-red-500/20">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                Rejected
                            </span>
                        @endif
                    </div>

                    {{-- Featured Status --}}
                    <div>
                        <label class="text-sm text-gray-500 block mb-2">Featured Event</label>
                        @if($event->is_featured)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-500/10 text-yellow-400 text-sm font-semibold rounded-lg border border-yellow-500/20">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Yes
                            </span>
                        @else
                            <span class="text-gray-500 text-sm">No</span>
                        @endif
                    </div>

                    {{-- Category --}}
                    @if($event->category)
                    <div>
                        <label class="text-sm text-gray-500 block mb-2">Kategori</label>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-500/10 text-blue-400 text-sm font-medium rounded-lg border border-blue-500/20">
                            {{ $event->category->name }}
                        </span>
                    </div>
                    @endif

                    {{-- Organizer --}}
                    @if($event->organizer)
                    <div>
                        <label class="text-sm text-gray-500 block mb-2">Organizer</label>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr($event->organizer->name, 0, 1)) }}
                            </div>
                            <span class="text-white text-sm">{{ $event->organizer->name }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Statistics Card --}}
            <div class="bg-[#111111] border border-white/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Statistik</h2>
                
                <div class="space-y-4">
                    @if(!$event->has_ticket_categories)
                    <div class="bg-[#0A0A0A] rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-500 text-sm">Harga Tiket</span>
                            <span class="text-yellow-500 font-bold text-lg">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">Kuota</span>
                            <span class="text-white font-semibold">{{ $event->quota }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="bg-[#0A0A0A] rounded-xl p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-500 text-sm">Tiket Terjual</span>
                            <span class="text-green-400 font-bold text-xl">{{ $event->sold_count }}</span>
                        </div>
                        <div class="w-full bg-[#1A1A1A] rounded-full h-2 mt-2">
                            @php
                                $totalQuota = $event->has_ticket_categories 
                                    ? $event->ticketCategories->sum('quota') 
                                    : $event->quota;
                                $percentage = $totalQuota > 0 ? ($event->sold_count / $totalQuota) * 100 : 0;
                            @endphp
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                        </div>
                    </div>

                    <div class="bg-[#0A0A0A] rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">Total Views</span>
                            <span class="text-blue-400 font-bold text-xl">{{ number_format($event->views) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Homepage Placement --}}
            <div class="bg-[#111111] border border-white/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Homepage Placement</h2>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 text-sm">Rekomendasi Event</span>
                        @if($event->show_in_recommended)
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 text-sm">Event Terdekat</span>
                        @if($event->show_in_nearest)
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 text-sm">Upcoming Event</span>
                        @if($event->show_in_upcoming)
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-400 text-sm">Popular Event</span>
                        @if($event->show_in_popular)
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Action Buttons (if pending) --}}
            @if($event->status === 'pending')
            <div class="bg-[#111111] border border-white/10 rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Quick Actions</h2>
                
                <div class="space-y-3">
                    <form action="{{ route('admin.events.approve', $event) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-500 hover:bg-green-600 text-white rounded-xl font-semibold transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Approve Event
                        </button>
                    </form>

                    <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-400 rounded-xl font-semibold transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reject Event
                    </button>
                </div>
            </div>
            @endif

        </div>

    </div>

</div>

{{-- Reject Modal --}}
@if($event->status === 'pending')
<div id="rejectModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-[#111111] border border-white/10 rounded-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-white mb-4">Reject Event</h3>
        <form action="{{ route('admin.events.reject', $event) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="text-sm text-gray-400 block mb-2">Alasan Penolakan (Opsional)</label>
                <textarea name="rejection_reason" rows="4" class="w-full bg-[#0A0A0A] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-red-500 focus:outline-none" placeholder="Jelaskan alasan penolakan..."></textarea>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="flex-1 px-4 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 rounded-xl font-medium transition-all">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold transition-all">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>
@endif

@endsection
