<x-mail::message>
# 🎉 Pembayaran Berhasil Dikonfirmasi!

Selamat **{{ $order->buyer_name }}**,

Pembayaran Anda telah **BERHASIL DIKONFIRMASI**! 🎊

Tiket Anda sudah aktif dan siap digunakan untuk menghadiri event.

## Detail Pesanan

<x-mail::panel>
**Kode Pesanan:** {{ $order->order_code }}  
**Status Pembayaran:** ✅ **PAID**  
**Tanggal Pembayaran:** {{ $paidAt->format('d M Y, H:i') }} WIB  
**Total Dibayar:** **Rp {{ number_format($order->total_price, 0, ',', '.') }}**
</x-mail::panel>

## Detail Event

**Nama Event:** {{ $event->title }}  
**Tanggal Event:** {{ $event->date->format('d M Y') }}  
**Waktu:** {{ $event->start_time }} - {{ $event->end_time }} WIB  
**Lokasi:** {{ $event->location }}

## Detail Tiket

**Kategori Tiket:** {{ $ticketCategory->name ?? 'Regular' }}  
**Jumlah Tiket:** {{ $order->quantity }} tiket  
**Nama Peserta:** {{ $order->buyer_name }}  
**Email:** {{ $order->buyer_email }}  
**No. HP:** {{ $order->buyer_phone }}

---

## 🎫 Cara Menggunakan Tiket

1. **Simpan Email Ini** - Email ini adalah bukti pembelian tiket Anda
2. **Download/Screenshot** kode pesanan Anda: **{{ $order->order_code }}**
3. **Tunjukkan di Lokasi Event** - Petugas akan memverifikasi menggunakan kode pesanan
4. **Datang Tepat Waktu** - Minimal 30 menit sebelum event dimulai

<x-mail::button :url="route('orders.show', $order->id)" color="success">
Lihat E-Ticket Saya
</x-mail::button>

---

## ⚠️ Informasi Penting

- **Kode pesanan bersifat UNIK** dan hanya berlaku untuk 1 kali scan
- Jangan bagikan kode pesanan kepada orang lain
- Simpan email ini sebagai bukti valid pembelian tiket
- Tiket tidak dapat direfund atau ditukar dengan event lain
- Untuk event indoor, harap datang sesuai waktu yang tertera di tiket

---

## 📞 Butuh Bantuan?

Jika Anda memiliki pertanyaan atau kendala, hubungi kami:

- **Email:** support@radjatiket.com
- **WhatsApp:** +62 812-3456-7890
- **Jam Operasional:** Senin - Jumat, 09:00 - 18:00 WIB

---

Terima kasih telah mempercayai **RADJATIKET** sebagai partner ticketing Anda!

Selamat menikmati event! 🎉

Salam hangat,  
**Tim RADJATIKET**

---

<small>Email ini dikirim otomatis. Mohon tidak membalas email ini.</small>
</x-mail::message>
