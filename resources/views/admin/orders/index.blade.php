@extends('layouts.admin-master')

@section('title', 'Orders Management')

@section('content')
<div class="space-y-6">
    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Orders Management</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola semua transaksi dan pembayaran</p>
        </div>
        <div class="flex gap-3">
            <button class="px-4 py-2 bg-[#22C55E] hover:bg-[#16A34A] text-white rounded-lg transition-colors duration-200 text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export Excel
            </button>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
        {{-- Total Orders --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#3B82F6] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#3B82F6]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Total Orders</p>
                <p class="text-3xl font-bold text-white">{{ $stats['total'] }}</p>
            </div>
        </div>

        {{-- Paid Orders --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#22C55E] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#22C55E]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Paid</p>
                <p class="text-3xl font-bold text-white">{{ $stats['paid'] }}</p>
            </div>
        </div>

        {{-- Pending Payment --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#F59E0B] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#F59E0B]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Pending</p>
                <p class="text-3xl font-bold text-white">{{ $stats['pending'] }}</p>
            </div>
        </div>

        {{-- Expired Orders --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#EF4444] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#EF4444]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Expired</p>
                <p class="text-3xl font-bold text-white">{{ $stats['expired'] }}</p>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="bg-gradient-to-br from-[#111111] to-[#0a0a0a] border border-[#242424] rounded-2xl p-6 hover:border-[#FFD700] transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[#FFD700]/10 rounded-xl">
                    <svg class="w-6 h-6 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-slate-400 text-sm mb-1">Total Revenue</p>
                <p class="text-2xl font-bold text-white">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- SEARCH & FILTER --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Search --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-300 mb-2">Cari Order</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Order code, customer name, email..." 
                        class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                </div>

                {{-- Payment Status --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Payment Status</label>
                    <select 
                        name="payment_status" 
                        class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                        <option value="">All Status</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="expired" {{ request('payment_status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                </div>

                {{-- Event Filter --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Event</label>
                    <select 
                        name="event_id" 
                        class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                        <option value="">All Events</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Date From --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Date From</label>
                    <input 
                        type="date" 
                        name="date_from" 
                        value="{{ request('date_from') }}"
                        class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                </div>

                {{-- Date To --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Date To</label>
                    <input 
                        type="date" 
                        name="date_to" 
                        value="{{ request('date_to') }}"
                        class="w-full px-4 py-2.5 bg-[#000000] border border-[#242424] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#FFD700] focus:border-transparent transition-all duration-200"
                    >
                </div>

                {{-- Buttons --}}
                <div class="md:col-span-2 flex items-end gap-3">
                    <button type="submit" class="px-6 py-2.5 bg-[#B22222] hover:bg-[#8B0000] text-white rounded-lg font-medium transition-colors duration-200">
                        🔍 Cari
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="px-6 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition-colors duration-200">
                        Reset Filter
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- ORDERS TABLE --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl overflow-hidden">
        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#0a0a0a] border-b border-[#242424]">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Order Code</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Event</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Qty</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Payment</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#242424]">
                        @foreach($orders as $order)
                        <tr class="hover:bg-[#0a0a0a] transition-colors duration-150">
                            {{-- Order Code --}}
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-white">{{ $order->order_code }}</p>
                                    <p class="text-xs text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </td>

                            {{-- Customer --}}
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $order->buyer_name }}</p>
                                    <p class="text-xs text-slate-400">{{ $order->buyer_email }}</p>
                                </div>
                            </td>

                            {{-- Event --}}
                            <td class="px-6 py-4">
                                <p class="text-sm text-white">{{ $order->event->title }}</p>
                                @if($order->ticketCategory)
                                    <p class="text-xs text-slate-400">{{ $order->ticketCategory->name }}</p>
                                @endif
                            </td>

                            {{-- Quantity --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-white">{{ $order->quantity }}x</p>
                            </td>

                            {{-- Total --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-[#22C55E]">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </td>

                            {{-- Payment Status --}}
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $order->payment_status_color }}">
                                    {{ $order->payment_status_label }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- View Details --}}
                                    <a href="{{ route('admin.orders.show', $order) }}" class="p-2 bg-[#3B82F6]/10 hover:bg-[#3B82F6]/20 text-[#3B82F6] rounded-lg transition-colors duration-200" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>

                                    {{-- Update Status --}}
                                    @if($order->payment_status !== 'paid')
                                    <button 
                                        @click="$dispatch('open-modal', 'update-status-{{ $order->id }}')" 
                                        class="p-2 bg-[#F59E0B]/10 hover:bg-[#F59E0B]/20 text-[#F59E0B] rounded-lg transition-colors duration-200" 
                                        title="Update Status"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </button>
                                    @endif

                                    {{-- Delete --}}
                                    @if($order->payment_status !== 'paid')
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus order ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-[#EF4444]/10 hover:bg-[#EF4444]/20 text-[#EF4444] rounded-lg transition-colors duration-200" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        {{-- UPDATE STATUS MODAL --}}
                        <tr x-data="{ open: false }" @open-modal.window="open = ($event.detail === 'update-status-{{ $order->id }}')" x-show="open" x-cloak style="display: none;">
                            <td colspan="7" class="p-0">
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="px-6 py-4 border-t border-[#242424]">
                {{ $orders->links() }}
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#3B82F6]/10 rounded-full mb-4">
                    <svg class="w-8 h-8 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Belum Ada Order</h3>
                <p class="text-slate-400">Order akan muncul di sini setelah customer melakukan pembelian</p>
            </div>
        @endif
    </div>
</div>
@endsection
