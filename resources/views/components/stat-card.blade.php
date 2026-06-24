{{--
    RADJATIKET V2 - Stat Card Component
    
    Displays statistics with:
    - Icon
    - Title
    - Value
    - Optional trend indicator
    
    Usage:
    <x-stat-card 
        title="Total Events"
        value="1,234"
        icon="calendar"
        trend="+12%"
        trend-type="up"
    />
--}}

@props([
    'title',                // Required: Card title
    'value',                // Required: Main stat value
    'icon' => null,         // Optional: Icon name (heroicons)
    'trend' => null,        // Optional: Trend indicator (e.g., "+12%")
    'trendType' => 'neutral', // up, down, neutral
    'color' => 'blue',      // blue, green, red, yellow, purple
    'href' => null,         // Optional: Make clickable
])

@php
$iconMap = [
    'calendar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'ticket' => '<path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"/>',
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
    'dollar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
];

$colorClasses = [
    'blue' => 'bg-blue-500/10 text-blue-600',
    'green' => 'bg-green-500/10 text-green-600',
    'red' => 'bg-red-500/10 text-red-600',
    'yellow' => 'bg-yellow-500/10 text-yellow-600',
    'purple' => 'bg-purple-500/10 text-purple-600',
];

$trendClasses = [
    'up' => 'text-green-600 bg-green-50',
    'down' => 'text-red-600 bg-red-50',
    'neutral' => 'text-gray-600 bg-gray-50',
];

$cardClass = $href ? 'hover:shadow-lg cursor-pointer' : '';
@endphp

<div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm transition-all duration-200 {{ $cardClass }}">
    @if($href)
        <a href="{{ $href }}" class="block">
    @endif
    
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-600 mb-1">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900">{{ $value }}</p>
            
            @if($trend)
                <div class="flex items-center gap-1 mt-2">
                    <span class="inline-flex items-center gap-1 text-xs font-medium px-2 py-1 rounded-full {{ $trendClasses[$trendType] ?? $trendClasses['neutral'] }}">
                        @if($trendType === 'up')
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @elseif($trendType === 'down')
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @endif
                        {{ $trend }}
                    </span>
                </div>
            @endif
        </div>
        
        @if($icon && isset($iconMap[$icon]))
            <div class="w-12 h-12 rounded-xl {{ $colorClasses[$color] ?? $colorClasses['blue'] }} flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $iconMap[$icon] !!}
                </svg>
            </div>
        @endif
    </div>
    
    @if($href)
        </a>
    @endif
</div>
