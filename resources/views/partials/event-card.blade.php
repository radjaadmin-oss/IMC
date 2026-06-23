{{-- ═══════════════════════════════════════════════════════════════════════════
    EVENT CARD COMPONENT - COMPACT VERSION
    Support: Ticket Categories, Early Bird, Featured Badge, Sold Out, Free Event
    Dark Navy (#050B14) + Gold Premium (#F5C518)
═══════════════════════════════════════════════════════════════════════════ --}}

<a href="{{ route('events.show', $event) }}"
   class="group block bg-gradient-to-br from-[#0B1220] to-[#050B14] rounded-2xl overflow-hidden border border-white/5 hover:border-[#F5C518]/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-[#F5C518]/20">
    {{-- Event Image --}}
    <div class="relative aspect-video overflow-hidden bg-[#050B14]">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}"
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"/>
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        {{-- Overlay Badges Container --}}
        <div class="absolute inset-0 pointer-events-none">
            
            {{-- Top Left: Featured Badge --}}
            @if($event->is_featured)
                <div class="absolute top-2 left-2 pointer-events-auto">
                    <span class="inline-flex items-center gap-1 text-[10px] font-bold tracking-wider px-2 py-1 rounded-full bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black shadow-lg">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        FEATURED
                    </span>
                </div>
            @endif

            {{-- Top Right: Date Badge --}}
            <div class="absolute top-2 right-2 pointer-events-auto">
                <div class="bg-black/70 backdrop-blur-sm rounded-lg px-2 py-1.5 text-center border border-white/10">
                    <p class="text-white font-bold text-base leading-none">{{ $event->date->format('d') }}</p>
                    <p class="text-gray-300 text-[10px] uppercase mt-0.5">{{ $event->date->format('M') }}</p>
                </div>
            </div>

            {{-- Center Overlay: Sold Out / Early Bird --}}
            @if($event->is_sold_out)
                <div class="absolute inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center">
                    <span class="text-xs font-bold tracking-widest px-4 py-2 rounded-xl bg-red-500/20 border-2 border-red-500/40 text-red-400">
                        SOLD OUT
                    </span>
                </div>
            @elseif($event->is_early_bird)
                <div class="absolute bottom-2 left-2 right-2 pointer-events-auto">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-2 py-1 rounded-lg text-[10px] font-bold text-center flex items-center justify-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        EARLY BIRD SALE
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Event Info --}}
    <div class="p-3.5 space-y-2">
        
        {{-- Category Badge --}}
        @if($event->category)
            <div class="flex items-center gap-1.5">
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-[#F5C518]/10 text-[#F5C518] border border-[#F5C518]/20 font-semibold">
                    {{ $event->category->name }}
                </span>
                @if($event->is_free)
                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 font-semibold">
                        GRATIS
                    </span>
                @endif
            </div>
        @endif
        
        {{-- Title --}}
        <h3 class="text-white font-bold text-sm leading-tight line-clamp-2 group-hover:text-[#F5C518] transition-colors duration-300 min-h-[2.5rem]">
            {{ $event->title }}
        </h3>

        {{-- Location --}}
        <div class="flex items-center gap-1.5 text-gray-400 text-xs">
            <svg class="w-3.5 h-3.5 text-[#F5C518] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="truncate">{{ $event->location }}</span>
        </div>

        {{-- Date & Time --}}
        <div class="flex items-center gap-1.5 text-gray-400 text-xs">
            <svg class="w-3.5 h-3.5 text-[#F5C518] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>{{ $event->date->format('d M Y') }}</span>
            @if($event->time)
                <span class="text-gray-600">•</span>
                <span>{{ $event->time }}</span>
            @endif
        </div>

        {{-- Divider --}}
        <div class="border-t border-white/5 pt-2"></div>

        {{-- Price & Quota --}}
        <div class="flex items-center justify-between">
            
            {{-- Price --}}
            <div>
                @if($event->is_free)
                    <p class="text-green-400 font-bold text-sm">GRATIS</p>
                @else
                    <p class="text-[#F5C518] font-bold text-sm">
                        Rp {{ number_format($event->lowest_price, 0, ',', '.') }}
                    </p>
                    @if($event->ticketCategories->count() > 1)
                        <p class="text-[9px] text-gray-500">Mulai dari</p>
                    @endif
                @endif
            </div>

            {{-- Quota Info --}}
            <div class="text-right">
                @if($event->is_sold_out)
                    <p class="text-[10px] text-red-400 font-semibold">Sold Out</p>
                @else
                    <p class="text-[9px] text-gray-500">Tersisa</p>
                    <p class="text-white font-semibold text-xs">
                        {{ number_format($event->remaining_quota) }} tiket
                    </p>
                    
                    {{-- Low Stock Warning --}}
                    @if($event->remaining_quota <= 10 && $event->remaining_quota > 0)
                        <p class="text-[9px] text-yellow-400 font-semibold mt-0.5">Segera habis!</p>
                    @endif
                @endif
            </div>

        </div>

        {{-- Sold Count & Views (Optional Stats) --}}
        @if($event->sold_count > 0 || $event->views > 0)
            <div class="flex items-center gap-2.5 text-[9px] text-gray-600 pt-1.5 border-t border-white/5">
                @if($event->sold_count > 0)
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        <span>{{ number_format($event->sold_count) }}</span>
                    </div>
                @endif
                @if($event->views > 0)
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ number_format($event->views) }}</span>
                    </div>
                @endif
            </div>
        @endif

    </div>

</a>
