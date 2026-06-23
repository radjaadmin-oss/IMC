{{-- ═══════════════════════════════════════════════════════════════════════════
    EVENT CARD COMPONENT - LOKET.COM INSPIRED LAYOUT (DARK THEME)
    Hybrid: Loket.com clean layout + RADJATIKET dark navy + gold premium
═══════════════════════════════════════════════════════════════════════════ --}}

<a href="{{ route('events.show', $event) }}"
   class="group block bg-[#0B1220] rounded-xl overflow-hidden border border-white/5 hover:border-[#F5C518]/30 transition-all duration-300 hover:shadow-lg hover:shadow-black/50">
    
    {{-- Event Image --}}
    <div class="relative aspect-[16/9] overflow-hidden bg-[#050B14]">
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
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded bg-[#F5C518] text-black">
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
        <h3 class="text-white font-bold text-sm leading-snug line-clamp-2 mb-2 group-hover:text-[#F5C518] transition-colors min-h-[2.5rem]">
            {{ $event->title }}
        </h3>

        {{-- Date with Icon (Loket style) --}}
        <div class="flex items-center gap-1.5 text-gray-400 text-xs mb-1.5">
            <svg class="w-3.5 h-3.5 text-[#F5C518] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>{{ $event->date->format('d M Y') }}</span>
            @if($event->time)
                <span class="text-gray-600">•</span>
                <span>{{ $event->time }}</span>
            @endif
        </div>

        {{-- Location with Icon (Loket style) --}}
        <div class="flex items-center gap-1.5 text-gray-400 text-xs mb-2.5">
            <svg class="w-3.5 h-3.5 text-[#F5C518] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="truncate">{{ $event->location }}</span>
        </div>

        {{-- Price (Loket style) --}}
        <div class="mb-2.5">
            @if($event->is_free)
                <p class="text-green-400 font-bold text-sm">GRATIS</p>
            @else
                <p class="text-[#F5C518] font-bold text-sm">
                    Rp{{ number_format($event->lowest_price, 0, ',', '.') }}
                </p>
            @endif
        </div>

        {{-- Organizer/Category Info (Loket style - at bottom) --}}
        <div class="flex items-center justify-between pt-2 border-t border-white/5">
            {{-- Category/Organizer --}}
            @if($event->category)
                <div class="flex items-center gap-1.5">
                    <div class="w-5 h-5 rounded-full bg-[#F5C518]/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-[#F5C518]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-[10px] text-gray-400 truncate">{{ $event->category->name }}</span>
                </div>
            @endif

            {{-- Quota Badge --}}
            @if(!$event->is_sold_out)
                <div class="text-right">
                    @if($event->remaining_quota <= 10 && $event->remaining_quota > 0)
                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-yellow-500/10 text-yellow-400 font-semibold">
                            {{ $event->remaining_quota }} tersisa
                        </span>
                    @else
                        <span class="text-[10px] text-gray-500">
                            {{ number_format($event->remaining_quota) }} tiket
                        </span>
                    @endif
                </div>
            @endif
        </div>

    </div>

</a>
