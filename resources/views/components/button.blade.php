{{-- 
    RADJATIKET V2 - Unified Button Component
    
    Variants:
    - primary: Red background (main CTA)
    - secondary: Gray background
    - danger: Red background (destructive actions)
    - ghost: Transparent with border
    
    Sizes:
    - sm: Small button
    - md: Default size
    - lg: Large button
    
    Usage:
    <x-button variant="primary" size="md">Click Me</x-button>
--}}

@props([
    'variant' => 'primary',  // primary, secondary, danger, ghost
    'size' => 'md',          // sm, md, lg
    'type' => 'button',      // button, submit, reset
    'href' => null,          // If provided, renders as <a> instead of <button>
    'disabled' => false,
])

@php
$baseClasses = 'inline-flex items-center justify-center gap-2 font-medium transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-offset-2';

$variantClasses = [
    'primary' => 'bg-primary-600 text-white hover:bg-primary-700 shadow-sm hover:shadow-md focus:ring-primary-500',
    'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 shadow-sm hover:shadow-md focus:ring-gray-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md focus:ring-red-500',
    'ghost' => 'bg-transparent border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:ring-gray-400',
];

$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-sm rounded-lg',
    'md' => 'px-4 py-2.5 text-base rounded-xl',
    'lg' => 'px-6 py-3 text-lg rounded-xl',
];

$classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} @if($disabled) disabled @endif>
        {{ $slot }}
    </button>
@endif
