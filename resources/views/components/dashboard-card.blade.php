{{--
    RADJATIKET V2 - Dashboard Card Component
    
    Container for dashboard widgets with:
    - Title
    - Optional action link
    - Content slot
    
    Usage:
    <x-dashboard-card title="Latest Orders" action-text="View All" action-url="/orders">
        <div>Content here</div>
    </x-dashboard-card>
--}}

@props([
    'title',                // Required: Card title
    'actionText' => null,   // Optional: Action button text
    'actionUrl' => null,    // Optional: Action button URL
    'icon' => null,         // Optional: Icon name
    'padding' => true,      // Apply default padding
])

@php
$iconMap = [
    'calendar' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'shopping-bag' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>',
    'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
    'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
];

$paddingClass = $padding ? 'p-6' : '';
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl border border-gray-200 shadow-sm']) }}>
    {{-- Header --}}
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <div class="flex items-center gap-3">
            @if($icon && isset($iconMap[$icon]))
                <div class="w-10 h-10 rounded-lg bg-primary-50 text-primary-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $iconMap[$icon] !!}
                    </svg>
                </div>
            @endif
            <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>
        </div>
        
        @if($actionText && $actionUrl)
            <a href="{{ $actionUrl }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                {{ $actionText }}
                <svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @endif
    </div>
    
    {{-- Content --}}
    <div class="{{ $paddingClass }}">
        {{ $slot }}
    </div>
</div>
