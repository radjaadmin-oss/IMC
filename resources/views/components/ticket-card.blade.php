{{--
    RADJATIKET V2 - Ticket Card Component
    
    Displays e-ticket information
    
    Usage:
    <x-ticket-card :order="$order" show-print="true" />
--}}

@props([
    'order',                // Required: Order model
    'showPrint' => true,    // Show print button
])

<div class="bg-white rounded-xl border-2 border-gray-200 overflow-hidden shadow-lg">
    {{-- Ticket Header --}}
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-4 text-white">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-xl font-bold mb-1">{{ $order->event->title }}</h3>
                <p class="text-sm text-primary-100">{{ $order->event->location }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-primary-100">Order Code</p>
                <p class="text-lg font-bold">{{ $order->order_code }}</p>
            </div>
        </div>
    </div>
    
    {{-- Ticket Body --}}
    <div class="p-6 space-y-4">
        {{-- Event Details --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-gray-500 mb-1">Date & Time</p>
                <p class="font-semibold text-gray-900">{{ $order->event->date->format('d M Y') }}</p>
                <p class="text-sm text-gray-600">{{ $order->event->time }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 mb-1">Ticket Type</p>
                <p class="font-semibold text-gray-900">
                    @if($order->ticketCategory)
                        {{ $order->ticketCategory->name }}
                    @else
                        General Admission
                    @endif
                </p>
                <p class="text-sm text-gray-600">{{ $order->quantity }}x Ticket</p>
            </div>
        </div>
        
        {{-- Attendee Info --}}
        <div class="border-t border-gray-200 pt-4">
            <p class="text-xs text-gray-500 mb-2">Attendee Information</p>
            <div class="space-y-1">
                <p class="font-semibold text-gray-900">{{ $order->attendee_name }}</p>
                <p class="text-sm text-gray-600">{{ $order->attendee_email }}</p>
                <p class="text-sm text-gray-600">{{ $order->attendee_phone }}</p>
            </div>
        </div>
        
        {{-- Organizer Badge --}}
        @if($order->event->organizer)
            <div class="border-t border-gray-200 pt-4">
                <p class="text-xs text-gray-500 mb-2">Event Organizer</p>
                <x-organizer-badge :organizer="$order->event->organizer" size="md" show-company="true" />
            </div>
        @endif
        
        {{-- QR Code Placeholder (for future) --}}
        <div class="border-t border-gray-200 pt-4 text-center">
            <div class="inline-block p-4 bg-gray-100 rounded-lg">
                <div class="w-32 h-32 bg-gray-200 rounded flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">Scan this QR code at the event entrance</p>
        </div>
    </div>
    
    {{-- Print Button --}}
    @if($showPrint)
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <button onclick="window.print()" class="w-full bg-gray-800 text-white px-4 py-2.5 rounded-xl font-medium hover:bg-gray-900 transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print Ticket
            </button>
        </div>
    @endif
</div>
