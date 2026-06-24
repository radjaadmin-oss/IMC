{{--
    RADJATIKET V2 - Organizer Badge Component
    
    Displays event organizer identity with:
    - Avatar/logo
    - Organizer name
    - Verified badge (if active)
    
    Usage:
    <x-organizer-badge :organizer="$event->organizer" size="md" />
--}}

@props([
    'organizer',           // Required: User model instance
    'size' => 'md',        // sm, md, lg
    'theme' => 'light',    // light or dark
    'showCompany' => false, // Show company name instead of user name
    'showEmail' => false,   // Show email (admin only)
    'showLink' => false,    // Make clickable (link to organizer profile)
])

@php
if (!$organizer) return;

$sizeClasses = [
    'sm' => [
        'avatar' => 'w-6 h-6',
        'text' => 'text-xs',
        'badge' => 'w-3 h-3',
    ],
    'md' => [
        'avatar' => 'w-8 h-8',
        'text' => 'text-sm',
        'badge' => 'w-3.5 h-3.5',
    ],
    'lg' => [
        'avatar' => 'w-10 h-10',
        'text' => 'text-base',
        'badge' => 'w-4 h-4',
    ],
];

$size = $sizeClasses[$size] ?? $sizeClasses['md'];
$displayName = $showCompany && $organizer->company_name ? $organizer->company_name : $organizer->name;
$avatarUrl = $organizer->avatar ? asset('storage/' . $organizer->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($displayName) . '&background=DC2626&color=fff';
$isVerified = $organizer->status === 'active';

// Theme-aware colors
$textColor = $theme === 'dark' ? 'text-gray-300' : 'text-gray-900';
$verifiedTextColor = $theme === 'dark' ? 'text-gray-500' : 'text-gray-500';
$borderColor = $theme === 'dark' ? 'border-gray-700' : 'border-gray-200';
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    {{-- Avatar --}}
    <img src="{{ $avatarUrl }}"
         alt="{{ $displayName }}"
         class="{{ $size['avatar'] }} rounded-full object-cover {{ $borderColor }} border-2 flex-shrink-0"
         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=DC2626&color=fff'">
    
    {{-- Name + Verified Badge --}}
    <div class="flex-1 min-w-0">
        @if($showLink && isset($organizer->id))
            <a href="#" class="hover:underline">
                <span class="{{ $size['text'] }} font-medium {{ $textColor }} truncate block">
                    {{ $displayName }}
                </span>
            </a>
        @else
            <span class="{{ $size['text'] }} font-medium {{ $textColor }} truncate block">
                {{ $displayName }}
            </span>
        @endif
        
        @if($isVerified)
            <div class="flex items-center gap-1 mt-0.5">
                <svg class="{{ $size['badge'] }} text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-xs {{ $verifiedTextColor }}">Verified</span>
            </div>
        @endif
        
        @if($showEmail)
            <p class="text-xs {{ $verifiedTextColor }} truncate mt-0.5">{{ $organizer->email }}</p>
        @endif
    </div>
</div>
