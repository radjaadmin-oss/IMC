@extends('layouts.app')
@section('title', 'Jelajahi Event — Radjatiket')
@section('content')

<div class="max-w-[1280px] mx-auto px-6 py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">JELAJAHI EVENT</h1>
        <p class="text-gray-400 text-sm">Temukan event menarik untukmu</p>
    </div>

    {{-- EVENT GRID --}}
    @if($events->isEmpty())
        <div class="bg-[#0B1220] rounded-2xl p-20 text-center border border-white/10">
            <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <p class="text-gray-400 font-medium mb-1">Belum ada event</p>
            <p class="text-gray-600 text-sm">Event akan segera hadir. Pantau terus!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($events as $event)
                @include('partials.event-card', ['event' => $event])
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($events->hasPages())
            <div class="mt-10">
                {{ $events->links() }}
            </div>
        @endif
    @endif

</div>

@endsection
