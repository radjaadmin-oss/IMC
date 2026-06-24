{{-- ═══════════════════════════════════════════════════════════════════════════
    EVENT CARD COMPONENT - LOKET.COM INSPIRED LAYOUT (DARK THEME)
    Hybrid: Loket.com clean layout + RADJATIKET dark navy + gold premium
    WITH EVENT ORGANIZER INFO (Avatar + Company Name)
═══════════════════════════════════════════════════════════════════════════ --}}

<a href="{{ route('events.show', $event) }}"
   class="group block bg-white rounded-xl overflow-hidden border border-gray-200 hover:border-primary-400 transition-all duration-300 hover:shadow-lg relative">

    {{-- Favorite Button (Visual Only) --}}
    <button onclick="event.preventDefault(); event.stopPropagation(); this.classList.toggle('active');" 
            class="absolute top-3 right-3 z-10 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center border border-gray-200 hover:bg-white hover:border-primary-600 transition-all group/fav">
        <svg class="w-5 h-5 text-gray-400 group-hover/fav:text-primary-600 group-[.active]/fav:text-primary-600 group-[.active]/fav:fill-current transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
    </button>

    {{-- Event Image --}}
    <div class="relative aspect-[16/9] overflow-hidden bg-gray-100">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}"
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        {{-- Badges Overlay --}}
        <div class="absolute inset-0 pointer-events-none">
            {{-- Featured Badge --}}
            @if($event->is_featured)
                <div class="absolute top-2 left-2 pointer-events-auto">
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-primary-600 text-white shadow-lg">
                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        FEATURED
                    </span>
                </div>
            @endif

            {{-- Sold Out Overlay --}}
            @if($event->is_sold_out)
                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                    <span class="text-xs font-bold px-4 py-1.5 rounded-lg bg-red-500/90 text-white">
                        SOLD OUT
                    </span>
                </div>
            @endif
        </div>
    </div>

    {{-- Event Info - Loket.com Style Layout --}}
    <div class="p-3">

        {{-- Title --}}
        <h3 class="text-gray-900 font-bold text-sm leading-snug line-clamp-2 mb-2 group-hover:text-primary-600 transition-colors min-h-[2.5rem]">
            {{ $event->title }}
        </h3>

        {{-- Date with Icon (Loket style) --}}
        <div class="flex items-center gap-1.5 text-gray-600 text-xs mb-1.5">
            <svg class="w-3.5 h-3.5 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>{{ $event->date->format('d M Y') }}</span>
            @if($event->time)
                <span class="text-gray-400">•</span>
                <span>{{ $event->time }}</span>
            @endif
        </div>

        {{-- Location with Icon (Loket style) --}}
        <div class="flex items-center gap-1.5 text-gray-600 text-xs mb-2.5">
            <svg class="w-3.5 h-3.5 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="truncate">{{ $event->location }}</span>
        </div>

        {{-- Price (Loket style) --}}
<div class="mb-2.5">
    @if($event->is_free || $event->lowest_price == 0)
        <p class="text-green-600 font-bold text-sm">GRATIS</p>
    @else
        <p class="text-primary-600 font-bold text-sm">
            Rp{{ number_format($event->lowest_price, 0, ',', '.') }}
        </p>
    @endif
</div>

        {{-- Organizer Info (Artatix style - with organizer badge component) --}}
        @if($event->organizer)
        <div class="pt-2.5 mt-2.5 border-t border-gray-200 mb-3">
            <x-organizer-badge :organizer="$event->organizer" size="sm" theme="light" />
        </div>
        @endif
        
        {{-- RED CTA Button --}}
        <button onclick="event.preventDefault(); window.location.href='{{ route('events.show', $event) }}';" 
                class="w-full py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-all flex items-center justify-center gap-2 group/btn">
            <span>Beli Tiket</span>
            <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

    </div>

</a>

{{-- CSS for scrolling text animation --}}
<style>
@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.animate-scroll {
    animation: scroll 10s linear infinite;
    padding-right: 20px;
}

.animate-scroll span {
    display: inline-block;
    padding-right: 50px;
}

.animation-paused {
    animation-play-state: paused;
}
</style>
