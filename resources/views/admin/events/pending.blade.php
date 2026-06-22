@extends('layouts.admin-master')

@section('title', 'Event Pending Approval')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Event Pending Approval</h1>
            <p class="text-[#94A3B8] mt-1">Event menunggu persetujuan untuk dipublish</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-[#F59E0B]/10 border border-[#F59E0B]/30 rounded-xl">
                <span class="text-[#F59E0B] font-semibold">{{ $events->total() }} Event Pending</span>
            </div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="bg-[#22C55E]/10 border border-[#22C55E]/30 rounded-xl p-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span class="text-[#22C55E]">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Search --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <form method="GET" action="{{ route('admin.events.pending') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama event atau lokasi..." class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>
            <button type="submit" class="px-6 py-3 bg-[#B22222] text-white rounded-xl font-semibold hover:bg-[#8B1A1A] transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari
            </button>
            @if(request('search'))
            <a href="{{ route('admin.events.pending') }}" class="px-6 py-3 bg-[#242424] text-white rounded-xl font-semibold hover:bg-[#333333] transition-all duration-300">
                Reset
            </a>
            @endif
        </form>
    </div>

    {{-- Events Grid --}}
    @if($events->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-[#111111] border border-[#242424] rounded-2xl overflow-hidden hover:border-[#F59E0B] transition-all duration-300">
            {{-- Event Image --}}
            <div class="relative h-48 bg-[#0A0A0A] overflow-hidden">
                @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-[#242424]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif
                
                {{-- Pending Badge --}}
                <div class="absolute top-3 left-3">
                    <span class="px-3 py-1 bg-[#F59E0B] text-black rounded-full text-xs font-bold flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pending
                    </span>
                </div>
            </div>

            {{-- Event Info --}}
            <div class="p-6 space-y-4">
                {{-- Title --}}
                <h3 class="text-lg font-bold text-white line-clamp-2">{{ $event->title }}</h3>

                {{-- Event Organizer --}}
                @if($event->organizer)
                <div class="flex items-center gap-2 text-sm text-[#94A3B8]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>{{ $event->organizer->name }}</span>
                </div>
                @endif

                {{-- Date & Location --}}
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-sm text-[#94A3B8]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $event->date->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-[#94A3B8]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="line-clamp-1">{{ $event->location }}</span>
                    </div>
                </div>

                {{-- Price --}}
                <div class="pt-4 border-t border-[#242424]">
                    @if($event->is_free)
                    <span class="text-[#22C55E] font-bold text-lg">GRATIS</span>
                    @else
                    <span class="text-[#FFD700] font-bold text-lg">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="grid grid-cols-2 gap-3 pt-4">
                    <form action="{{ route('admin.events.approve', $event) }}" method="POST" onsubmit="return confirm('Approve event ini?')">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2.5 bg-[#22C55E]/10 text-[#22C55E] rounded-xl font-semibold hover:bg-[#22C55E]/20 transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Approve
                        </button>
                    </form>

                    <button onclick="openRejectModal({{ $event->id }}, '{{ $event->title }}')" class="w-full px-4 py-2.5 bg-[#EF4444]/10 text-[#EF4444] rounded-xl font-semibold hover:bg-[#EF4444]/20 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reject
                    </button>
                </div>

                {{-- View Detail --}}
                <a href="{{ route('admin.events.show', $event) }}" class="block w-full px-4 py-2.5 bg-[#242424] text-white rounded-xl font-semibold hover:bg-[#333333] transition-all duration-300 text-center">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($events->hasPages())
    <div class="flex justify-center">
        {{ $events->links() }}
    </div>
    @endif

    @else
    {{-- Empty State --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-12">
        <div class="flex flex-col items-center gap-4 text-center">
            <div class="w-24 h-24 bg-[#0A0A0A] rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-[#242424]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white mb-2">Tidak Ada Event Pending</h3>
                <p class="text-[#64748B]">Semua event sudah diapprove atau tidak ada event baru</p>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Reject Modal --}}
<div id="rejectModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-[#111111] border border-[#242424] rounded-2xl max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Reject Event</h3>
            <button onclick="closeRejectModal()" class="text-[#94A3B8] hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="rejectForm" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Nama Event</label>
                <div class="px-4 py-3 bg-[#0A0A0A] border border-[#242424] rounded-xl text-white" id="reject_event_title"></div>
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Alasan Reject (Optional)</label>
                <textarea name="rejection_reason" rows="4" placeholder="Masukkan alasan kenapa event ini ditolak..." class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300"></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-[#EF4444] text-white rounded-xl font-semibold hover:bg-[#DC2626] transition-all duration-300">
                    Reject Event
                </button>
                <button type="button" onclick="closeRejectModal()" class="px-6 py-3 bg-[#242424] text-white rounded-xl font-semibold hover:bg-[#333333] transition-all duration-300">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(eventId, eventTitle) {
    document.getElementById('rejectForm').action = `/admin/events/${eventId}/reject`;
    document.getElementById('reject_event_title').textContent = eventTitle;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
@endsection
