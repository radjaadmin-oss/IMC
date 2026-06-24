{{--
    RADJATIKET V2 - Loading Skeleton Component
    
    Animated shimmer loading placeholders
    
    Usage:
    <x-loading-skeleton type="card" count="4" />
    <x-loading-skeleton type="table" rows="5" />
    <x-loading-skeleton type="stat" count="3" />
--}}

@props([
    'type' => 'card',   // card, table, stat, text, avatar
    'count' => 1,       // Number of skeletons
    'rows' => 5,        // For table type
])

@if($type === 'card')
    @for($i = 0; $i < $count; $i++)
        <div class="bg-white rounded-xl border border-gray-200 p-6 animate-pulse">
            <div class="h-48 bg-gray-200 rounded-lg mb-4"></div>
            <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2 mb-4"></div>
            <div class="flex items-center justify-between">
                <div class="h-8 bg-gray-200 rounded w-24"></div>
                <div class="h-8 bg-gray-200 rounded w-16"></div>
            </div>
        </div>
    @endfor

@elseif($type === 'stat')
    @for($i = 0; $i < $count; $i++)
        <div class="bg-white rounded-xl border border-gray-200 p-6 animate-pulse">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="h-4 bg-gray-200 rounded w-24 mb-2"></div>
                    <div class="h-8 bg-gray-200 rounded w-32"></div>
                </div>
                <div class="w-12 h-12 bg-gray-200 rounded-xl"></div>
            </div>
        </div>
    @endfor

@elseif($type === 'table')
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden animate-pulse">
        <div class="h-12 bg-gray-100 border-b border-gray-200"></div>
        @for($i = 0; $i < $rows; $i++)
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="h-4 bg-gray-200 rounded flex-1"></div>
                    <div class="h-4 bg-gray-200 rounded w-32"></div>
                    <div class="h-4 bg-gray-200 rounded w-24"></div>
                    <div class="h-4 bg-gray-200 rounded w-20"></div>
                </div>
            </div>
        @endfor
    </div>

@elseif($type === 'text')
    @for($i = 0; $i < $count; $i++)
        <div class="space-y-2 animate-pulse">
            <div class="h-4 bg-gray-200 rounded w-full"></div>
            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
            <div class="h-4 bg-gray-200 rounded w-4/6"></div>
        </div>
    @endfor

@elseif($type === 'avatar')
    <div class="flex items-center gap-3 animate-pulse">
        <div class="w-10 h-10 bg-gray-200 rounded-full"></div>
        <div class="flex-1">
            <div class="h-4 bg-gray-200 rounded w-32 mb-1"></div>
            <div class="h-3 bg-gray-200 rounded w-24"></div>
        </div>
    </div>

@else
    {{-- Default: Simple box --}}
    <div class="h-32 bg-gray-200 rounded-lg animate-pulse"></div>
@endif
