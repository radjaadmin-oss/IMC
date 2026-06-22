@extends('layouts.admin-master')

@section('title', 'Order Detail - ' . $order->order_code)

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('admin.orders.index') }}" class="p-2 hover:bg-[#111111] rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-white">Order Detail</h1>
            </div>
            <p class="text-slate-400 text-sm ml-11">Detail lengkap informasi order</p>
        </div>
        <div class="flex gap-3">
            <button class="px-4 py-2 bg-[#3B82F6] hover:bg-[#2563EB] text-white rounded-lg transition-colors duration-200 text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Invoice
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- LEFT COLUMN --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- ORDER SUMMARY --}}
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-white">Order Summary</h2>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $order->payment_status_color }}">
                        {{ $order->payment_status_label }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-[#242424]">
                        <span class="text-slate-400">Order Code</span>
                        <span class="font-mono font-bold text-white">{{ $order->order_code }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-[#242424]">
                        <span class="text-slate-400">Order Date</span>
                        <span class="text-white">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-[#242424]">
                        <span class="text-slate-400">Event</span>
                        <span class="text-white font-semibold">{{ $order->event->title }}</span>
                    </div>
                    @if($order->ticketCategory)
                    <div class="flex justify-between items-center py-3 border-b border-[#242424]">
                        <span class="text-slate-400">Ticket Type</span>
                        <span class="text-white">{{ $order->ticketCategory->name }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between items-center py-3 border-b border-[#242424]">
                        <span class="text-slate-400">Quantity</span>
                        <span class="text-white font-semibold">{{ $order->quantity }} ticket(s)</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-[#242424]">
                        <span class="text-slate-400">Price per Ticket</span>
                        <span class="text-white">Rp {{ number_format($order->total_price / $order->quantity, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-4 bg-[#0a0a0a] rounded-lg px-4 mt-2">
                        <span class="text-white font-bold text-lg">Total Amount</span>
                        <span class="text-[#22C55E] font-bold text-2xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- CUSTOMER INFORMATION --}}
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-6">Customer Information</h2>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Full Name</label>
                        <p class="text-white font-semibold">{{ $order->buyer_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Email Address</label>
                        <p class="text-white">{{ $order->buyer_email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Phone Number</label>
                        <p class="text-white">{{ $order->buyer_phone }}</p>
                    </div>
                    @if($order->user)
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">User Account</label>
                        <p class="text-white">{{ $order->user->email }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- EVENT INFORMATION --}}
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-6">Event Information</h2>
                
                <div class="flex gap-4">
                    @if($order->event->image)
                    <img src="{{ asset('storage/' . $order->event->image) }}" 
                         alt="{{ $order->event->title }}" 
                         class="w-32 h-32 rounded-xl object-cover border border-[#242424]">
                    @endif
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-3">{{ $order->event->title }}</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-slate-300">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($order->event->date)->format('d F Y') }}
                            </div>
                            <div class="flex items-center gap-2 text-slate-300">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $order->event->time ?? 'TBA' }}
                            </div>
                            <div class="flex items-center gap-2 text-slate-300">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $order->event->location }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="space-y-6">
            
            {{-- PAYMENT INFORMATION --}}
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-6">Payment Information</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Payment Status</label>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $order->payment_status_color }}">
                            {{ $order->payment_status_label }}
                        </span>
                    </div>
                    
                    @if($order->payment_method)
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Payment Method</label>
                        <p class="text-white capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    </div>
                    @endif

                    @if($order->paid_at)
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Paid At</label>
                        <p class="text-white">{{ $order->paid_at->format('d M Y, H:i') }}</p>
                    </div>
                    @endif

                    @if($order->payment_expired_at)
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Payment Expires At</label>
                        <p class="text-white">{{ $order->payment_expired_at->format('d M Y, H:i') }}</p>
                        @if($order->isPaymentExpired() && $order->payment_status === 'pending')
                        <p class="text-[#EF4444] text-xs mt-1">⚠️ Payment has expired</p>
                        @endif
                    </div>
                    @endif

                    @if($order->payment_proof)
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Payment Proof</label>
                        <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="block">
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" 
                                 alt="Payment Proof" 
                                 class="w-full rounded-lg border border-[#242424] hover:border-[#FFD700] transition-colors">
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            {{-- QUICK ACTIONS --}}
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Quick Actions</h2>
                
                <div class="space-y-3">
                    @if($order->payment_status !== 'paid')
                    <button 
                        @click="$dispatch('open-modal', 'update-status')" 
                        class="w-full px-4 py-3 bg-[#22C55E]/10 hover:bg-[#22C55E]/20 text-[#22C55E] rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Mark as Paid
                    </button>
                    @endif

                    @if($order->payment_status === 'paid')
                    <div class="px-4 py-3 bg-[#22C55E]/10 text-[#22C55E] rounded-lg font-medium text-center">
                        ✓ Order has been paid
                    </div>
                    @endif

                    @if($order->payment_status !== 'paid')
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Delete this order?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-3 bg-[#EF4444]/10 hover:bg-[#EF4444]/20 text-[#EF4444] rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Order
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            {{-- ORDER TIMELINE --}}
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
                <h2 class="text-lg font-bold text-white mb-4">Order Timeline</h2>
                
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-[#3B82F6]/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#3B82F6]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="w-0.5 h-full bg-[#242424] mt-2"></div>
                        </div>
                        <div class="flex-1 pb-4">
                            <p class="text-white font-medium">Order Created</p>
                            <p class="text-sm text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    @if($order->paid_at)
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-[#22C55E]/20 flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#22C55E]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="w-0.5 h-full bg-[#242424] mt-2"></div>
                        </div>
                        <div class="flex-1 pb-4">
                            <p class="text-white font-medium">Payment Confirmed</p>
                            <p class="text-sm text-slate-400">{{ $order->paid_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#242424] flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-slate-400">Ticket Ready</p>
                            <p class="text-sm text-slate-500">Waiting for payment</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- UPDATE STATUS MODAL --}}
<div x-data="{ open: false }" @open-modal.window="open = ($event.detail === 'update-status')" x-show="open" x-cloak style="display: none;">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" @click.self="open = false">
        <div class="bg-[#111111] border border-[#242424] rounded-2xl max-w-md w-full p-6" @click.stop>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">Update Payment Status</h3>
                <button @click="open = false" class="text-slate-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-3">Payment Status</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-3 p-3 bg-[#000000] border border-[#242424] rounded-lg cursor-pointer hover:border-[#22C55E] transition-colors">
                            <input type="radio" name="payment_status" value="paid" class="w-4 h-4 text-[#22C55E]" {{ $order->payment_status === 'paid' ? 'checked' : '' }}>
                            <span class="text-white">✓ Mark as Paid</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 bg-[#000000] border border-[#242424] rounded-lg cursor-pointer hover:border-[#F59E0B] transition-colors">
                            <input type="radio" name="payment_status" value="pending" class="w-4 h-4 text-[#F59E0B]" {{ $order->payment_status === 'pending' ? 'checked' : '' }}>
                            <span class="text-white">⏳ Mark as Pending</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 bg-[#000000] border border-[#242424] rounded-lg cursor-pointer hover:border-[#EF4444] transition-colors">
                            <input type="radio" name="payment_status" value="expired" class="w-4 h-4 text-[#EF4444]" {{ $order->payment_status === 'expired' ? 'checked' : '' }}>
                            <span class="text-white">✕ Mark as Expired</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 px-6 py-2.5 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg font-medium transition-colors duration-200">
                        Update Status
                    </button>
                    <button type="button" @click="open = false" class="px-6 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
