@extends('layouts.admin')

@section('page-title', 'Detail Order ' . $order->order_code)
@section('page-subtitle', 'Informasi lengkap pesanan')

@section('content')

<div class="max-w-5xl">
    
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Order
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- LEFT: Order Info --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Order Details --}}
            <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Informasi Order
                </h3>

                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-sm text-gray-400 mb-1">Order Code</div>
                            <div class="text-lg font-mono font-bold text-[#D4AF37]">{{ $order->order_code }}</div>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 rounded-full text-sm font-bold border {{ $order->status_color }}">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="h-px bg-white/10"></div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm text-gray-400 mb-1">Tanggal Order</div>
                            <div class="text-white">{{ $order->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400 mb-1">Terakhir Update</div>
                            <div class="text-white">{{ $order->updated_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Event Details --}}
            <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Detail Event
                </h3>

                <div class="flex gap-4">
                    @if($order->event->image)
                        <img src="{{ asset('storage/' . $order->event->image) }}" 
                             alt="{{ $order->event->title }}"
                             class="w-32 h-32 object-cover rounded-lg border border-white/10">
                    @else
                        <div class="w-32 h-32 bg-white/5 rounded-lg border border-white/10 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    <div class="flex-1">
                        <h4 class="text-white font-bold text-lg mb-2">{{ $order->event->title }}</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $order->event->date->format('d M Y') }}
                            </div>
                            <div class="flex items-center gap-2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $order->event->location }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ticket Details --}}
            <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    Detail Tiket
                </h3>

                <div class="space-y-3">
                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                        <span class="text-gray-400">Kategori Tiket</span>
                        <span class="text-white font-semibold">{{ $order->ticketCategory?->name ?? 'Regular' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                        <span class="text-gray-400">Harga per Tiket</span>
                        <span class="text-white font-semibold">Rp {{ number_format($order->total_price / $order->quantity, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-white/10">
                        <span class="text-gray-400">Jumlah Tiket</span>
                        <span class="text-white font-bold">{{ $order->quantity }} tiket</span>
                    </div>
                    <div class="flex justify-between items-center py-4 bg-gradient-to-r from-green-500/10 to-green-600/10 rounded-lg px-4">
                        <span class="text-white font-bold">Total Pembayaran</span>
                        <span class="text-green-400 font-bold text-xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT: Customer Info & Actions --}}
        <div class="space-y-6">
            
            {{-- Customer Info --}}
            <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informasi Customer
                </h3>

                <div class="space-y-3">
                    <div>
                        <div class="text-xs text-gray-400 mb-1">Nama Lengkap</div>
                        <div class="text-white font-medium">{{ $order->buyer_name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 mb-1">Email</div>
                        <div class="text-white text-sm">{{ $order->buyer_email }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 mb-1">No. Telepon</div>
                        <div class="text-white">{{ $order->buyer_phone }}</div>
                    </div>
                    @if($order->user)
                    <div class="pt-3 border-t border-white/10">
                        <div class="text-xs text-gray-400 mb-1">User ID</div>
                        <div class="text-white text-sm font-mono">#{{ $order->user->id }}</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Status Update --}}
            <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Ubah Status
                </h3>

                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <select name="status" 
                            class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-[#D4AF37] focus:outline-none mb-4">
                        <option value="pending" {{ $
                         <select name="status" 
                            class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white focus:border-[#D4AF37] focus:outline-none mb-4">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>

                    <button type="submit"
                            class="w-full px-4 py-3 rounded-xl bg-gradient-to-r from-[#D4AF37] to-[#FFD700] text-black font-bold hover:from-[#FFD700] hover:to-[#D4AF37] transition-all">
                        Update Status
                    </button>
                </form>
            </div>

            {{-- Delete Order --}}
            <div class="bg-[#0B1220] rounded-2xl border border-red-500/30 p-6">
                <h3 class="text-lg font-bold text-red-400 mb-2">Danger Zone</h3>
                <p class="text-sm text-gray-400 mb-4">Hapus order ini secara permanen dari database</p>

                <form action="{{ route('admin.orders.destroy', $order) }}" 
                      method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus order ini? Tindakan tidak dapat dibatalkan!')">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit"
                            class="w-full px-4 py-3 rounded-xl bg-red-500/20 border border-red-500/30 text-red-400 font-bold hover:bg-red-500/30 transition-colors">
                        🗑️ Hapus Order
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection
