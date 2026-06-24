{{--
    RADJATIKET V2 - Invoice Card Component
    
    Displays invoice/payment information
    
    Usage:
    <x-invoice-card :order="$order" show-payment-proof="true" />
--}}

@props([
    'order',                    // Required: Order model
    'showPaymentProof' => false, // Show payment proof image
])

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    {{-- Invoice Header --}}
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Invoice</h3>
                <p class="text-sm text-gray-600">Order #{{ $order->order_code }}</p>
            </div>
            <div class="text-right">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                    @if($order->payment_status === 'paid') bg-green-100 text-green-800
                    @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>
    </div>
    
    {{-- Invoice Body --}}
    <div class="p-6 space-y-4">
        {{-- Event Info --}}
        <div>
            <p class="text-xs text-gray-500 mb-2">Event Details</p>
            <h4 class="font-bold text-gray-900 text-lg">{{ $order->event->title }}</h4>
            <p class="text-sm text-gray-600">{{ $order->event->location }}</p>
            <p class="text-sm text-gray-600">{{ $order->event->date->format('d M Y') }} • {{ $order->event->time }}</p>
        </div>
        
        {{-- Billing Info --}}
        <div class="border-t border-gray-200 pt-4">
            <p class="text-xs text-gray-500 mb-2">Billing To</p>
            <p class="font-semibold text-gray-900">{{ $order->attendee_name }}</p>
            <p class="text-sm text-gray-600">{{ $order->attendee_email }}</p>
            <p class="text-sm text-gray-600">{{ $order->attendee_phone }}</p>
        </div>
        
        {{-- Order Summary --}}
        <div class="border-t border-gray-200 pt-4">
            <p class="text-xs text-gray-500 mb-3">Order Summary</p>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">
                        @if($order->ticketCategory)
                            {{ $order->ticketCategory->name }}
                        @else
                            General Admission
                        @endif
                        ({{ $order->quantity }}x)
                    </span>
                    <span class="font-medium text-gray-900">
                        Rp {{ number_format($order->total_price / $order->quantity, 0, ',', '.') }}
                    </span>
                </div>
                <div class="border-t border-gray-200 pt-2 mt-2">
                    <div class="flex justify-between">
                        <span class="font-bold text-gray-900">Total</span>
                        <span class="font-bold text-primary-600 text-lg">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Payment Info --}}
        @if($order->payment_status === 'paid' && $order->paid_at)
            <div class="border-t border-gray-200 pt-4">
                <p class="text-xs text-gray-500 mb-2">Payment Information</p>
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-green-900">Payment Confirmed</span>
                    </div>
                    <p class="text-sm text-green-800">Paid on {{ $order->paid_at->format('d M Y, H:i') }}</p>
                    @if($order->payment_method)
                        <p class="text-sm text-green-800">Method: {{ ucfirst($order->payment_method) }}</p>
                    @endif
                </div>
            </div>
        @endif
        
        {{-- Payment Proof --}}
        @if($showPaymentProof && $order->payment_proof)
            <div class="border-t border-gray-200 pt-4">
                <p class="text-xs text-gray-500 mb-2">Payment Proof</p>
                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="block">
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                         alt="Payment Proof" 
                         class="rounded-lg border border-gray-200 max-w-full h-auto hover:opacity-90 transition-opacity cursor-pointer">
                </a>
            </div>
        @endif
        
        {{-- Organizer Info --}}
        @if($order->event->organizer)
            <div class="border-t border-gray-200 pt-4">
                <p class="text-xs text-gray-500 mb-2">Event Organizer</p>
                <x-organizer-badge :organizer="$order->event->organizer" size="md" show-company="true" />
            </div>
        @endif
    </div>
    
    {{-- Footer --}}
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <p class="text-xs text-gray-500 text-center">
            Thank you for your purchase! For questions, please contact our support team.
        </p>
    </div>
</div>
