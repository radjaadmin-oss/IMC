@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#050B14] py-16">
    <div class="max-w-5xl mx-auto px-6">
        
        {{-- Back Button --}}
        <div class="mb-8">
            <a href="{{ route('orders.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 hover:border-[#F5C518]/30 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Pesanan Saya
            </a>
        </div>

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Detail Pesanan</h1>
            <p class="text-gray-400">Informasi lengkap pesanan tiket Anda</p>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- LEFT COLUMN: Order Info --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Order Status Card --}}
                <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-white">Informasi Pesanan</h3>
                        <span class="px-4 py-2 rounded-full text-sm font-bold {{ $order->payment_status_color }} border">
                            {{ $order->payment_status_label }}
                        </span>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-start pb-4 border-b border-white/10">
                            <div>
                                <div class="text-sm text-gray-400 mb-1">Kode Pesanan</div>
                                <div class="text-2xl font-mono font-bold text-[#F5C518]">{{ $order->order_code }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-400 mb-1">Status Order</div>
                                <span class="px-3 py-1.5 rounded-full text-xs font-bold border {{ $order->status_color }}">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div>
                                <div class="text-sm text-gray-400 mb-1">Tanggal Order</div>
                                <div class="text-white font-medium">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            @if($order->payment_expired_at && $order->payment_status === 'pending')
                                <div>
                                    <div class="text-sm text-gray-400 mb-1">Batas Pembayaran</div>
                                    <div class="text-red-400 font-bold">{{ $order->payment_expired_at->format('d M Y, H:i') }}</div>
                                </div>
                            @endif
                            @if($order->paid_at)
                                <div>
                                    <div class="text-sm text-gray-400 mb-1">Tanggal Pembayaran</div>
                                    <div class="text-green-400 font-medium">{{ $order->paid_at->format('d M Y, H:i') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Event Details --}}
                <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Detail Event</h3>

                    <div class="flex gap-4">
                        @if($order->event->image)
                            <img src="{{ asset('storage/' . $order->event->image) }}" 
                                 alt="{{ $order->event->title }}"
                                 class="w-32 h-32 object-cover rounded-xl border border-white/10">
                        @else
                            <div class="w-32 h-32 bg-white/5 rounded-xl border border-white/10 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="flex-1">
                            <h4 class="text-white font-bold text-lg mb-3">{{ $order->event->title }}</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center gap-2 text-gray-400">
                                    <svg class="w-4 h-4 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-white">{{ $order->event->date->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-400">
                                    <svg class="w-4 h-4 text-[#F5C518]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span class="text-white">{{ $order->event->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ticket Details --}}
                <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Detail Tiket</h3>

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
                        <div class="flex justify-between items-center py-4 bg-gradient-to-r from-[#F5C518]/10 to-[#FFD700]/10 rounded-xl px-4 mt-4">
                            <span class="text-white font-bold text-lg">Total Pembayaran</span>
                            <span class="text-[#F5C518] font-bold text-2xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN: Payment & Actions --}}
            <div class="space-y-6">
                
                {{-- Payment Status & Actions --}}
                @if($order->payment_status === 'pending')
                    <div class="bg-gradient-to-br from-yellow-500/10 to-orange-500/10 rounded-2xl border border-yellow-500/30 p-6">
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">Menunggu Pembayaran</h3>
                            <p class="text-sm text-gray-400">Selesaikan pembayaran sebelum:</p>
                            <p class="text-yellow-400 font-bold mt-1">{{ $order->payment_expired_at->format('d M Y, H:i') }} WIB</p>
                        </div>

                        <div class="bg-[#0B1220]/50 rounded-xl p-4 mb-4">
                            <h4 class="text-white font-bold text-sm mb-3">Transfer ke:</h4>
                            <div class="space-y-2 text-sm">
                                <div>
                                    <div class="text-gray-400">Bank BCA</div>
                                    <div class="text-[#F5C518] font-mono font-bold">1234567890</div>
                                </div>
                                <div>
                                    <div class="text-gray-400">Bank Mandiri</div>
                                    <div class="text-[#F5C518] font-mono font-bold">9876543210</div>
                                </div>
                                <div class="text-gray-400 text-xs mt-2">A.n. PT RADJATIKET INDONESIA</div>
                            </div>
                        </div>

                        {{-- Upload Payment Proof Form --}}
                        <form action="{{ route('orders.upload-payment', $order) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                            @csrf
                            <label class="block text-white font-medium text-sm mb-2">Upload Bukti Pembayaran:</label>
                            <input type="file" 
                                   name="payment_proof" 
                                   accept="image/jpeg,image/jpg,image/png,application/pdf"
                                   class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#F5C518] file:text-black hover:file:bg-[#FFD700] transition-colors mb-3"
                                   required>
                            @error('payment_proof')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            
                            <button type="submit"
                                    class="w-full px-4 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#FFD700] text-black font-bold hover:from-[#FFD700] hover:to-[#F5C518] transition-all shadow-lg hover:shadow-[#F5C518]/20">
                                📤 Upload Bukti Pembayaran
                            </button>
                        </form>

                        {{-- Show uploaded payment proof --}}
                        @if($order->payment_proof)
                            <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-3 mb-4">
                                <div class="flex items-center gap-2 text-green-400 text-sm">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Bukti pembayaran telah diupload</span>
                                </div>
                                <a href="{{ asset('storage/' . $order->payment_proof) }}" 
                                   target="_blank"
                                   class="text-xs text-blue-400 hover:text-blue-300 underline mt-1 inline-block">
                                    Lihat bukti pembayaran
                                </a>
                            </div>
                        @endif

                        {{-- Cancel Order --}}
                        <form action="{{ route('orders.cancel', $order) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="w-full px-4 py-2.5 rounded-xl bg-red-500/20 border border-red-500/30 text-red-400 font-medium hover:bg-red-500/30 transition-colors text-sm">
                                ❌ Batalkan Pesanan
                            </button>
                        </form>
                    </div>

                @elseif($order->payment_status === 'paid')
                    <div class="bg-gradient-to-br from-green-500/10 to-emerald-500/10 rounded-2xl border border-green-500/30 p-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">Pembayaran Berhasil! 🎉</h3>
                            <p class="text-sm text-gray-400 mb-4">Tiket Anda sudah aktif dan siap digunakan</p>
                            
                            <div class="bg-[#0B1220]/50 rounded-xl p-4 mb-4">
                                <p class="text-xs text-gray-400 mb-2">Kode E-Ticket:</p>
                                <p class="text-2xl font-mono font-bold text-[#F5C518] mb-3">{{ $order->order_code }}</p>
                                <p class="text-xs text-gray-400">Tunjukkan kode ini saat masuk event</p>
                            </div>

                            <button onclick="window.print()"
                                    class="w-full px-4 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#FFD700] text-black font-bold hover:from-[#FFD700] hover:to-[#F5C518] transition-all shadow-lg">
                                🖨️ Print E-Ticket
                            </button>
                        </div>
                    </div>

                @else
                    {{-- Expired --}}
                    <div class="bg-gradient-to-br from-red-500/10 to-pink-500/10 rounded-2xl border border-red-500/30 p-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">Pesanan Expired</h3>
                            <p class="text-sm text-gray-400">Batas waktu pembayaran telah habis</p>
                        </div>
                    </div>
                @endif

                {{-- Customer Info --}}
                <div class="bg-[#0B1220] rounded-2xl border border-white/10 p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Informasi Pemesan</h3>

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
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
