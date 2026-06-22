# 🧪 EVENT FORM TESTING GUIDE
**Status:** READY FOR TESTING  
**Date:** 2026-06-21  
**Forms:** Create Event & Edit Event

---

## 📋 CHECKLIST LENGKAP - HARUS DICEK

### ✅ **1. FORM TAMBAH EVENT** (`/admin/events/create`)

#### A. Layout & Tampilan
- [ ] Layout menggunakan `admin-master` (BUKAN `admin`)
- [ ] Background dark navy (#0B1220)
- [ ] Border gold pada focus input
- [ ] Tidak ada error/purple icon
- [ ] Form responsive di mobile

#### B. Field Basic (Required)
- [ ] **Nama Event** - bisa diisi
- [ ] **Lokasi** - bisa diisi
- [ ] **Tanggal** - date picker muncul
- [ ] **Waktu** - time picker muncul
- [ ] **Deskripsi** - textarea bisa diisi

#### C. Kategori Event (CRITICAL - BARU DITAMBAHKAN)
- [ ] **Dropdown Kategori** muncul
- [ ] Dropdown menampilkan kategori dari database
- [ ] Bisa dipilih salah satu kategori
- [ ] Required (form error jika tidak dipilih)

#### D. Toggle Kategori Tiket
- [ ] Toggle switch berfungsi
- [ ] Saat OFF: tampil field "Harga Tiket" & "Kuota Tiket"
- [ ] Saat ON: tampil section "Kategori Tiket"
- [ ] Button "Tambah Kategori" berfungsi
- [ ] Button hapus kategori berfungsi
- [ ] Bisa isi: nama, deskripsi, harga, kuota per kategori

#### E. Image Upload
- [ ] Info ukuran gambar muncul (800x400 px)
- [ ] Button "Choose File" berfungsi
- [ ] Preview gambar muncul setelah pilih file
- [ ] Hanya accept: JPEG, PNG, JPG, WEBP
- [ ] Max 2MB

#### F. Homepage Placement (CRITICAL - BARU DITAMBAHKAN)
- [ ] Section "Tampilkan di Homepage" muncul
- [ ] 4 checkbox muncul:
  - [ ] ⭐ Rekomendasi Event
  - [ ] 📍 Event Terdekat
  - [ ] 🔜 Upcoming Event
  - [ ] 🔥 Popular Event
- [ ] Checkbox bisa dicentang/uncheck
- [ ] Bisa pilih multiple checkbox

#### G. Submit & Validation
- [ ] Button "SIMPAN EVENT" terlihat jelas
- [ ] Button "Batal" berfungsi (redirect ke `/admin/events`)
- [ ] Submit form berhasil (tidak error)
- [ ] Redirect ke halaman event list setelah sukses
- [ ] Muncul notifikasi sukses
- [ ] Data tersimpan di database (cek di list event)

---

### ✅ **2. FORM EDIT EVENT** (`/admin/events/{id}/edit`)

#### A. Layout & Tampilan
- [ ] Layout menggunakan `admin-master` (BUKAN `admin`)
- [ ] Background dark navy (#0B1220)
- [ ] Border gold pada focus input
- [ ] Tidak ada error/purple icon
- [ ] Form responsive di mobile

#### B. Field Pre-filled (Data Existing)
- [ ] **Nama Event** - terisi dengan data event
- [ ] **Lokasi** - terisi dengan data event
- [ ] **Tanggal** - terisi dengan tanggal event
- [ ] **Waktu** - terisi dengan waktu event
- [ ] **Deskripsi** - terisi dengan deskripsi event

#### C. Kategori Event (CRITICAL - BARU DITAMBAHKAN)
- [ ] **Dropdown Kategori** muncul
- [ ] Kategori event saat ini **terpilih otomatis** (pre-selected)
- [ ] Bisa ganti kategori
- [ ] Required (form error jika tidak dipilih)

#### D. Toggle Kategori Tiket (Edit Mode)
- [ ] Jika event punya kategori tiket: toggle ON, list kategori muncul
- [ ] Jika event tanpa kategori: toggle OFF, field harga & kuota muncul
- [ ] Bisa ganti mode (ON/OFF)
- [ ] Data kategori tiket existing muncul dengan benar
- [ ] Bisa edit nama, deskripsi, harga, kuota kategori
- [ ] Bisa hapus kategori
- [ ] Bisa tambah kategori baru

#### E. Image Upload (Edit Mode)
- [ ] **Gambar existing ditampilkan** di preview
- [ ] Info: "Kosongkan jika tidak ingin mengubah gambar"
- [ ] Jika upload gambar baru: preview berubah
- [ ] Jika tidak upload: gambar lama tetap digunakan

#### F. Homepage Placement (CRITICAL - BARU DITAMBAHKAN)
- [ ] Section "Penempatan di Homepage" muncul
- [ ] 4 checkbox muncul dengan icon:
  - [ ] ⭐ Rekomendasi Event
  - [ ] 📍 Event Terdekat
  - [ ] 🔜 Upcoming Event
  - [ ] 🔥 Popular Event
- [ ] **Checkbox yang aktif di database SUDAH TERCENTANG** (pre-checked)
- [ ] Bisa ubah centang (add/remove)
- [ ] Bisa pilih multiple checkbox

#### G. Submit & Validation (Edit Mode)
- [ ] Button "UPDATE EVENT" terlihat jelas
- [ ] Button "Batal" berfungsi (redirect ke `/admin/events`)
- [ ] Submit form berhasil (tidak error)
- [ ] Redirect ke halaman event list setelah sukses
- [ ] Muncul notifikasi "Event berhasil diupdate"
- [ ] Data ter-update di database (cek di list event)
- [ ] Jika edit homepage placement: cek homepage apakah event muncul di section yang benar

---

## 🔍 **TEST KHUSUS: DATABASE**

Setelah submit form (baik create maupun edit), **CEK DATABASE** menggunakan tool database (TablePlus/phpMyAdmin):

### Table: `events`
```sql
SELECT 
    id, 
    title, 
    location, 
    date, 
    time, 
    category_id,           -- HARUS TERISI (BUKAN NULL)
    show_in_recommended,   -- TRUE/FALSE
    show_in_nearest,       -- TRUE/FALSE
    show_in_upcoming,      -- TRUE/FALSE
    show_in_popular,       -- TRUE/FALSE
    has_ticket_categories,
    price,
    quota,
    image
FROM events 
ORDER BY created_at DESC 
LIMIT 5;
```

**Yang Harus Dicek:**
- ✅ `category_id` **HARUS TERISI** (bukan NULL) - ini field baru
- ✅ `show_in_recommended`, `show_in_nearest`, `show_in_upcoming`, `show_in_popular` **sesuai dengan checkbox yang dicentang**
- ✅ Jika checkbox tidak dicentang: nilai harus `FALSE` atau `0`
- ✅ Jika checkbox dicentang: nilai harus `TRUE` atau `1`

### Table: `ticket_categories` (Jika pakai multiple kategori)
```sql
SELECT 
    id, 
    event_id, 
    name, 
    description, 
    price, 
    quota, 
    sold_count
FROM ticket_categories 
WHERE event_id = [ID_EVENT_YANG_BARU_DIBUAT]
ORDER BY id ASC;
```

---

## 🐛 **KEMUNGKINAN ERROR & SOLUSI**

### Error 1: "Category is required"
**Penyebab:** Dropdown kategori tidak dipilih  
**Solusi:** Pilih salah satu kategori dari dropdown

### Error 2: Checkbox homepage placement tidak tersimpan
**Penyebab:** Checkbox value tidak dikirim  
**Solusi:** Cek kembali kode form, pastikan `name="show_in_*"` dan `value="1"`

### Error 3: Edit form - checkbox tidak tercentang otomatis
**Penyebab:** Pre-selection tidak berfungsi  
**Solusi:** Cek `{{ old('show_in_*', $event->show_in_*) ? 'checked' : '' }}`

### Error 4: Gambar tidak terupload
**Penyebab:** Form tidak pakai `enctype="multipart/form-data"`  
**Status:** ✅ Sudah ada di kedua form

### Error 5: Data kategori tidak tersimpan
**Penyebab:** Controller tidak handle `category_id`  
**Status:** ✅ Controller sudah handle

---

## 📸 **SCREENSHOT YANG PERLU DICEK**

Mohon screenshot dan verifikasi:

1. **Form Tambah Event** - full page scroll
2. **Form Edit Event** - full page scroll  
3. **Database `events`** - 5 row terakhir setelah create/edit
4. **Homepage** - cek section (Rekomendasi, Terdekat, Upcoming, Popular)
5. **Event List Admin** - pastikan event muncul dengan kategori yang benar

---

## ✅ **HASIL TESTING**

### Form Tambah Event
- [ ] PASS - Semua field berfungsi
- [ ] PASS - Data tersimpan ke database
- [ ] PASS - Kategori event tersimpan
- [ ] PASS - Homepage placement tersimpan
- [ ] FAIL - [Sebutkan error yang ditemukan]

### Form Edit Event
- [ ] PASS - Semua field pre-filled dengan benar
- [ ] PASS - Data ter-update di database
- [ ] PASS - Kategori event ter-update
- [ ] PASS - Homepage placement ter-update
- [ ] FAIL - [Sebutkan error yang ditemukan]

---

## 📝 **CATATAN PENTING**

1. **Kedua form sudah FIX** dan siap ditest
2. **Field baru yang ditambahkan:**
   - Dropdown Kategori Event (setelah deskripsi)
   - 4 Checkbox Homepage Placement (sebelum image upload)
3. **Yang perlu diverifikasi:**
   - Apakah `category_id` tersimpan di database
   - Apakah homepage placement (4 checkbox) tersimpan di database
   - Apakah event muncul di homepage sesuai section yang dipilih

**SILAKAN TEST DAN LAPORKAN HASILNYA!** 🚀
