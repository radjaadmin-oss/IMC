@extends('layouts.app')
@section('title', 'Pesan Tiket — ' . $event->title)
@section('content')

<div class="max-w-5xl mx-auto px-4 py-8">

    {{-- Back Button --}}
    <a href="{{ route('events.show', $event) }}" 
       class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-white mb-6 transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <h1 class="text-2xl font-bold text-white mb-6">Pesan Tiket</h1>

    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('orders.store', $event) }}" method="POST" id="orderForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-6">

            {{-- LEFT: Form --}}
            <div class="space-y-5">

                {{-- Pilih Kategori Tiket --}}
                <div class="card-dark rounded-xl p-5">
                    <h2 class="text-sm font-bold text-white mb-4">Pilih Kategori Tiket</h2>

                    @if($event->has_ticket_categories && $event->ticketCategories->isEmpty())
                        <p class="text-gray-500 text-sm">Belum ada kategori tiket tersedia.</p>
                    @elseif(!$event->has_ticket_categories)
                        {{-- Event without categories - use event price directly --}}
                        <div class="p-4 rounded-lg border-2 border-[#D4AF37] bg-[#D4AF37]/10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-bold text-white text-sm">Tiket Reguler</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $event->title }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-[#D4AF37] text-sm">
                                        Rp {{ number_format($event->price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-[10px] text-gray-500 mt-0.5">
                                        {{ $event->quota - $event->sold_count }} tersisa
                                    </p>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="ticket_category_id" value="">
                        <input type="hidden" id="eventPrice" value="{{ $event->price }}">
                        <input type="hidden" id="eventQuota" value="{{ $event->quota - $event->sold_count }}">
                        <input type="hidden" id="eventName" value="Tiket Reguler">
                    @else
                        <div class="space-y-3">
                            @foreach($event->ticketCategories as $category)
                                <label class="block relative">
                                    <input type="radio" 
                                           name="ticket_category_id" 
                                           value="{{ $category->id }}"
                                           data-price="{{ $category->price }}"
                                           data-quota="{{ $category->remaining_quota }}"
                                           class="peer sr-only ticket-radio"
                                           required
                                           {{ $category->is_sold_out ? 'disabled' : '' }}
                                           {{ old('ticket_category_id') == $category->id ? 'checked' : '' }}>
                                    
                                    <div class="p-4 rounded-lg border-2 cursor-pointer transition-all
                                                {{ $category->is_sold_out ? 'bg-white/5 border-white/10 cursor-not-allowed opacity-50' : 'border-white/10 hover:border-[#D4AF37]/50 peer-checked:border-[#D4AF37] peer-checked:bg-[#D4AF37]/10' }}">
                                        
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="font-bold text-white text-sm">{{ $category->name }}</p>
                                                @if($category->description)
                                                    <p class="text-xs text-gray-500 mt-0.5">{{ $category->description }}</p>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-[#D4AF37] text-sm">
                                                    Rp {{ number_format($category->price, 0, ',', '.') }}
                                                </p>
                                                <p class="text-[10px] text-gray-500 mt-0.5">
                                                    {{ $category->remaining_quota }} tersisa
                                                </p>
                                            </div>
                                        </div>

                                        @if($category->is_sold_out)
                                            <div class="mt-2 text-center">
                                                <span class="inline-block text-[10px] font-bold tracking-wider px-2 py-1 rounded bg-red-500/10 border border-red-500/30 text-red-400">
                                                    SOLD OUT
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('ticket_category_id')
                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                {{-- Jumlah Tiket --}}
                <div class="card-dark rounded-xl p-5">
                    <label class="block text-sm font-semibold text-white mb-3">Jumlah Tiket *</label>
                    <input type="number" 
                           name="quantity" 
                           id="quantity"
                           value="{{ old('quantity', 1) }}" 
                           min="1"
                           max="10"
                           required
                           class="w-full px-4 py-3 rounded-lg bg-black border text-white focus:outline-none @error('quantity') border-red-500 focus:border-red-500 @else border-white/10 focus:border-[#D4AF37] @enderror">
                    @error('quantity')
                        <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                    @else
                        <p class="text-xs text-gray-500 mt-2" id="maxInfo">Maksimal 10 tiket per transaksi</p>
                    @enderror
                </div>

                {{-- Informasi Pemesan --}}
                <div class="card-dark rounded-xl p-5">
                    <h2 class="text-sm font-bold text-white mb-4">Informasi Pemesan</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs text-gray-400 mb-2">Nama Lengkap *</label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name', auth()->user()->name ?? '') }}"
                                   required
                                   class="w-full px-4 py-2.5 rounded-lg bg-black border text-white text-sm focus:outline-none @error('name') border-red-500 focus:border-red-500 @else border-white/10 focus:border-[#D4AF37] @enderror">
                            @error('name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 mb-2">Email *</label>
                            <input type="email" 
                                   name="email" 
                                   value="{{ old('email', auth()->user()->email ?? '') }}"
                                   required
                                   class="w-full px-4 py-2.5 rounded-lg bg-black border text-white text-sm focus:outline-none @error('email') border-red-500 focus:border-red-500 @else border-white/10 focus:border-[#D4AF37] @enderror">
                            @error('email')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs text-gray-400 mb-2">No. WhatsApp *</label>
                            <input type="text" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   placeholder="08xxxxxxxxxx"
                                   required
                                   class="w-full px-4 py-2.5 rounded-lg bg-black border text-white text-sm focus:outline-none @error('phone') border-red-500 focus:border-red-500 @else border-white/10 focus:border-[#D4AF37] @enderror">
                            @error('phone')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

                        {{-- RIGHT: Ringkasan --}}
            <div class="lg:sticky lg:top-20 h-fit">
                <div class="card-dark rounded-xl p-5 space-y-4">
                    <h3 class="text-sm font-bold text-white">Ringkasan Pesanan</h3>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Event</span>
                            <span class="text-white font-semibold text-right">{{ $event->title }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Tanggal</span>
                            <span class="text-white">{{ $event->date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Kategori</span>
                            <span class="text-white" id="categoryName">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Harga/tiket</span>
                            <span class="text-white" id="pricePerTicket">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Jumlah</span>
                            <span class="text-white" id="ticketQty">1</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-white/10 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="text-white" id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">PPN 11%</span>
                            <span class="text-white" id="ppn">Rp 0</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-white/10">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-400">Total</span>
                            <span class="text-2xl font-bold text-[#D4AF37]" id="totalPrice">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit"
                            id="submitBtn"
                            class="w-full py-3 rounded-xl text-center text-sm font-bold tracking-wider
                                   transition-all hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed"
                            style="background: linear-gradient(135deg, #D4AF37, #F4C542); color: #000;">
                        <span id="btnText">LANJUTKAN PEMBAYARAN</span>
                        <span id="btnLoading" class="hidden">
                            <svg class="animate-spin inline-block w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memproses...
                        </span>
                    </button>

                    <p class="text-center text-xs text-gray-500 mt-3">
                        ✅ Checkout tanpa registrasi<br>
                        Detail pesanan akan dikirim ke email Anda
                    </p>
                </div>
            </div>

        </div>
    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('.ticket-radio');
    const quantityInput = document.getElementById('quantity');
    const categoryNameEl = document.getElementById('categoryName');
    const pricePerTicketEl = document.getElementById('pricePerTicket');
    const ticketQtyEl = document.getElementById('ticketQty');
    const subtotalEl = document.getElementById('subtotal');
    const ppnEl = document.getElementById('ppn');
    const totalPriceEl = document.getElementById('totalPrice');
    const maxInfoEl = document.getElementById('maxInfo');
    const form = document.getElementById('orderForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnLoading = document.getElementById('btnLoading');

    // Check if event has ticket categories
    const eventPriceInput = document.getElementById('eventPrice');
    const eventQuotaInput = document.getElementById('eventQuota');
    const eventNameInput = document.getElementById('eventName');
    
    let selectedPrice = 0;
    let selectedCategoryName = '';
    let maxQuota = 10;

    // If event doesn't have ticket categories, use event price directly
    if (eventPriceInput) {
        selectedPrice = parseFloat(eventPriceInput.value) || 0;
        selectedCategoryName = eventNameInput.value || 'Tiket Reguler';
        maxQuota = parseInt(eventQuotaInput.value) || 10;
        quantityInput.max = Math.min(maxQuota, 10);
        if (maxInfoEl) {
            maxInfoEl.textContent = `Maksimal ${quantityInput.max} tiket`;
        }
        updateSummary(); // Initial calculation
    }

    function updateSummary() {
        const qty = parseInt(quantityInput.value) || 1;
        ticketQtyEl.textContent = qty;

        if (selectedPrice > 0) {
            categoryNameEl.textContent = selectedCategoryName;
            pricePerTicketEl.textContent = 'Rp ' + selectedPrice.toLocaleString('id-ID');
            
            const subtotal = selectedPrice * qty;
            const ppn = subtotal * 0.11;
            const total = subtotal + ppn;

            subtotalEl.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            ppnEl.textContent = 'Rp ' + Math.round(ppn).toLocaleString('id-ID');
            totalPriceEl.textContent = 'Rp ' + Math.round(total).toLocaleString('id-ID');
        } else {
            categoryNameEl.textContent = '-';
            pricePerTicketEl.textContent = '-';
            subtotalEl.textContent = 'Rp 0';
            ppnEl.textContent = 'Rp 0';
            totalPriceEl.textContent = 'Rp 0';
        }
    }

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            selectedPrice = parseFloat(this.dataset.price);
            selectedCategoryName = this.closest('label').querySelector('.font-bold').textContent;
            maxQuota = parseInt(this.dataset.quota);

            quantityInput.max = Math.min(maxQuota, 10);
            if (maxInfoEl) {
                maxInfoEl.textContent = `Maksimal ${quantityInput.max} tiket`;
            }

            if (parseInt(quantityInput.value) > quantityInput.max) {
                quantityInput.value = quantityInput.max;
            }

            updateSummary();
        });
    });

    quantityInput.addEventListener('input', updateSummary);

    // Form submit loading state
    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoading.classList.remove('hidden');
    });

    // Initialize summary if category is pre-selected (from validation error)
    const checkedRadio = document.querySelector('.ticket-radio:checked');
    if (checkedRadio) {
        checkedRadio.dispatchEvent(new Event('change'));
    }
});
</script>

@endsection