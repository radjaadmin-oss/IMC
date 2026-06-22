<x-mail::message>
# Pesanan Tiket Berhasil Dibuat! 🎉

Hai **{{ $order->buyer_name }}**,

Terima kasih telah melakukan pemesanan di **RADJATIKET**!

Pesanan tiket Anda telah berhasil dibuat dengan detail sebagai berikut:

## Detail Pesanan

<x-mail::panel>
**Kode Pesanan:** {{ $order->order_code }}  
**Status:** {{ strtoupper($order->status) }}  
**Tanggal Pesanan:** {{ $order->created_at->format('d M Y, H:i') }} WIB
</x-mail::panel>

## Detail Event

**Nama Event:** {{ $event->title }}  
**Tanggal Event:** {{ $event->date->format('d M Y') }}  
**Lokasi:** {{ $event->location }}

## Detail Tiket

**Kategori Tiket:** {{ $ticketCategory->name ?? 'Regular' }}  
**Jumlah Tiket:** {{ $order->quantity }} tiket  
**Harga per Tiket:** Rp {{ number_format($order->total_price / $order->quantity, 0, ',', '.') }}

---

**Total Pembayaran:** **Rp {{ number_format($order->total_price, 0, ',', '.') }}**

## Cara Pembayaran

Silakan lakukan pembayaran sebelum:

<x-mail::panel>
⏰ **{{ $paymentExpiredAt->format('d M Y, H:i') }} WIB**
</x-mail::panel>

### Metode Pembayaran:

1. **Transfer Bank**
   - Bank BCA: 1234567890
   - Bank Mandiri: 9876543210
   - A.n. PT RADJATIKET INDONESIA

2. **Upload Bukti Pembayaran**
   Setelah transfer, silakan upload bukti pembayaran melalui halaman detail pesanan Anda

<x-mail::button :url="route('orders.show', $order->id)" color="success">
Lihat Detail Pesanan
</x-mail::button>

---

**⚠️ PENTING:**
- Pesanan akan otomatis dibatalkan jika pembayaran tidak diterima sebelum batas waktu
- Pastikan Anda melakukan transfer sesuai dengan nominal yang tertera
- Simpan kode pesanan Anda untuk referensi

Jika ada pertanyaan, silakan hubungi kami melalui:
- Email: support@radjatiket.com
- WhatsApp: +62 812-3456-7890

Terima kasih,  
**Tim RADJATIKET**

---

<small>Email ini dikirim otomatis. Mohon tidak membalas email ini.</small>
</x-mail::message>
