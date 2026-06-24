<a href="{{ route('events.show', $event) }}"
   class="card-dark rounded-2xl overflow-hidden hover:border-[#D4AF37]/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-[#D4AF37]/5 group block">

    {{-- Image --}}
    <div class="relative aspect-video overflow-hidden">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}"
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
        @else
            <div class="w-full h-full bg-white/5 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
        @endif

        {{-- Sold Out Overlay --}}
        @if($event->is_sold_out)
            <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                <span class="text-xs font-bold tracking-widest px-4 py-2 rounded-full
                             bg-red-500/20 border border-red-500/40 text-red-400">
                    TIKET HABIS
                </span>
            </div>
        @endif

        {{-- Badge Category --}}
        <div class="absolute top-3 left-3">
            <span class="text-xs px-3 py-1 rounded-full bg-black/60 text-gray-300 backdrop-blur-sm border border-white/10">
                {{ $event->date->format('d M') }}
            </span>
        </div>

        {{-- Badge Early Bird (optional) --}}
        @if($event->price > 0)
        <div class="absolute bottom-3 right-3">
            <span class="text-xs px-2.5 py-1 rounded-md bg-yellow-500 text-black font-bold">
                EARLY BIRD
            </span>
        </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-4">
        <h3 class="text-white font-bold text-base mb-1 line-clamp-1 group-hover:text-[#D4AF37] transition-colors">
            {{ $event->title }}
        </h3>
        <p class="text-gray-500 text-xs mb-3 flex items-center gap-1.5">
            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{ Str::limit($event->location, 20) }}
        </p>

        {{-- Organizer Badge --}}
        @if($event->organizer)
        <div class="mb-3">
            <x-organizer-badge :organizer="$event->organizer" size="sm" theme="dark" />
        </div>
        @endif

        <div class="flex items-center justify-between">
            @if($event->price == 0)
                <span class="text-green-400 font-bold text-sm">GRATIS</span>
            @else
                <span class="text-[#D4AF37] font-bold text-sm">
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                </span>
            @endif

            <div class="flex items-center gap-1 text-xs text-gray-500">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
                <span>{{ $event->remaining_quota }}</span>
            </div>
        </div>
    </div>
</a>
