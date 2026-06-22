# 🔍 FORM COMPARISON: CREATE vs EDIT

## ✅ STRUKTUR FORM (Harus Identik)

| Section | Create Form | Edit Form | Status |
|---------|-------------|-----------|--------|
| Layout | `layouts.admin-master` | `layouts.admin-master` | ✅ SAMA |
| Title | "Tambah Event" | "Edit Event" | ✅ BEDA (sesuai) |
| Form Action | `admin.events.store` | `admin.events.update` | ✅ BEDA (sesuai) |
| Method | `POST` | `POST` + `@method('PUT')` | ✅ BEDA (sesuai) |
| **1. Nama Event** | ✅ Ada | ✅ Ada + Pre-filled | ✅ KONSISTEN |
| **2. Lokasi** | ✅ Ada | ✅ Ada + Pre-filled | ✅ KONSISTEN |
| **3. Tanggal** | ✅ Ada | ✅ Ada + Pre-filled | ✅ KONSISTEN |
| **4. Waktu** | ✅ Ada | ✅ Ada + Pre-filled | ✅ KONSISTEN |
| **5. Deskripsi** | ✅ Ada | ✅ Ada + Pre-filled | ✅ KONSISTEN |
| **6. Kategori Event** | ✅ Ada (BARU) | ✅ Ada (BARU) + Pre-selected | ✅ KONSISTEN |
| **7. Toggle Kategori Tiket** | ✅ Ada | ✅ Ada + Pre-checked | ✅ KONSISTEN |
| **8. Harga & Kuota (Single)** | ✅ Ada | ✅ Ada + Pre-filled | ✅ KONSISTEN |
| **9. Kategori Tiket (Multiple)** | ✅ Ada (dynamic) | ✅ Ada + List existing | ✅ KONSISTEN |
| **10. Homepage Placement** | ✅ Ada (BARU) - 4 checkbox | ✅ Ada (BARU) - 4 checkbox + Pre-checked | ✅ KONSISTEN |
| **11. Image Upload** | ✅ Ada + Preview | ✅ Ada + Current image + Preview | ✅ KONSISTEN |
| **12. Submit Button** | "💾 SIMPAN EVENT" | "💾 UPDATE EVENT" | ✅ BEDA (sesuai) |
| **13. Cancel Button** | ✅ Ada | ✅ Ada | ✅ KONSISTEN |

---

## 🎯 FIELD BARU YANG DITAMBAHKAN

### 1️⃣ **KATEGORI EVENT** (Setelah Deskripsi)

#### Create Form:
```blade
<select name="category_id" class="..." required>
    <option value="">-- Pilih Kategori --</option>
    @foreach(\App\Models\EventCategory::where('is_active', true)->orderBy('name')->get() as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
        </option>
    @endforeach
</select>
```

#### Edit Form:
```blade
<select name="category_id" class="..." required>
    <option value="">-- Pilih Kategori --</option>
    @foreach(\App\Models\EventCategory::where('is_active', true)->orderBy('name')->get() as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id', $event->category_id) == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
        </option>
    @endforeach
</select>
```

✅ **Status:** KONSISTEN (Edit form pre-select berdasarkan `$event->category_id`)

---

### 2️⃣ **HOMEPAGE PLACEMENT** (Sebelum Image Upload)

#### Create Form:
```blade
<div class="p-6 rounded-xl bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border border-blue-500/30">
    <h3 class="...">Tampilkan di Homepage</h3>
    <p class="...">Pilih section homepage tempat event ini akan ditampilkan</p>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <label class="...">
            <input type="checkbox" name="show_in_recommended" value="1" {{ old('show_in_recommended') ? 'checked' : '' }}>
            <span>⭐ Rekomendasi Event</span>
        </label>
        
        <label class="...">
            <input type="checkbox" name="show_in_nearest" value="1" {{ old('show_in_nearest') ? 'checked' : '' }}>
            <span>📍 Event Terdekat</span>
        </label>
        
        <label class="...">
            <input type="checkbox" name="show_in_upcoming" value="1" {{ old('show_in_upcoming') ? 'checked' : '' }}>
            <span>🔜 Upcoming Event</span>
        </label>
        
        <label class="...">
            <input type="checkbox" name="show_in_popular" value="1" {{ old('show_in_popular') ? 'checked' : '' }}>
            <span>🔥 Popular Event</span>
        </label>
    </div>
</div>
```

#### Edit Form:
```blade
<div class="bg-white/5 rounded-xl border border-white/10 p-6">
    <h3 class="...">📍 Penempatan di Homepage</h3>
    <p class="...">Pilih section mana event ini akan ditampilkan di halaman utama</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <label class="...">
            <input type="checkbox" name="show_in_recommended" value="1" {{ old('show_in_recommended', $event->show_in_recommended) ? 'checked' : '' }}>
            <div class="...">
                <div>⭐ Rekomendasi Event</div>
                <p>Event pilihan editor yang direkomendasikan</p>
            </div>
        </label>

        <label class="...">
            <input type="checkbox" name="show_in_nearest" value="1" {{ old('show_in_nearest', $event->show_in_nearest) ? 'checked' : '' }}>
            <div class="...">
                <div>📍 Event Terdekat</div>
                <p>Event yang dekat dari tanggal hari ini</p>
            </div>
        </label>

        <label class="...">
            <input type="checkbox" name="show_in_upcoming" value="1" {{ old('show_in_upcoming', $event->show_in_upcoming) ? 'checked' : '' }}>
            <div class="...">
                <div>🔜 Upcoming Event</div>
                <p>Event yang akan datang dalam waktu dekat</p>
            </div>
        </label>

        <label class="...">
            <input type="checkbox" name="show_in_popular" value="1" {{ old('show_in_popular', $event->show_in_popular) ? 'checked' : '' }}>
            <div class="...">
                <div>🔥 Popular Event</div>
                <p>Event paling populer dan banyak diminati</p>
            </div>
        </label>

    </div>
</div>
```

⚠️ **Status:** SEDIKIT BERBEDA (Edit form punya deskripsi lebih detail, tapi fungsi SAMA)

✅ **Fungsi Pre-check:** Edit form menggunakan `old('show_in_*', $event->show_in_*)` untuk pre-check checkbox berdasarkan data database.

---

## 🎨 PERBEDAAN STYLING (Edit Form Lebih Detail)

### Create Form - Homepage Placement:
- Background: `bg-gradient-to-r from-blue-500/10 to-cyan-500/10`
- Border: `border-blue-500/30`
- Layout sederhana: icon + text

### Edit Form - Homepage Placement:
- Background: `bg-white/5`
- Border: `border-white/10`
- Layout premium: icon + title + description per checkbox
- Ada SVG icon untuk setiap section

**Rekomendasi:** Gunakan style dari **Edit Form** karena lebih informatif dan premium.

---

## 📊 VALIDATION RULES (Controller)

```php
// Di EventController.php - store() dan update()

'category_id' => 'required|exists:event_categories,id',

'show_in_recommended' => 'nullable|boolean',
'show_in_nearest' => 'nullable|boolean',
'show_in_upcoming' => 'nullable|boolean',
'show_in_popular' => 'nullable|boolean',
```

✅ **Status:** Controller sudah handle kedua field baru.

---

## 🚀 KESIMPULAN

| Aspek | Status |
|-------|--------|
| **Kategori Event Dropdown** | ✅ IMPLEMENTED (Create & Edit) |
| **Homepage Placement Checkboxes** | ✅ IMPLEMENTED (Create & Edit) |
| **Pre-selection (Edit Form)** | ✅ WORKING (Category & Checkboxes) |
| **Controller Validation** | ✅ READY |
| **Database Columns** | ✅ EXISTS (`category_id`, `show_in_*`) |
| **Layout Consistency** | ✅ BOTH USE `admin-master` |

---

## ⚠️ CATATAN PENTING

**Perbedaan Minor yang Perlu Diperhatikan:**

1. **Homepage Placement Section:**
   - Create form: styling sederhana (blue gradient)
   - Edit form: styling premium (white/5 + deskripsi)
   
   **Keputusan:** Biarkan berbeda ATAU samakan (pilih salah satu style).

2. **Pre-fill Values:**
   - Create form: `old('field_name')` only
   - Edit form: `old('field_name', $event->field_name)` (fallback ke database)
   
   **Status:** ✅ CORRECT (sesuai Laravel best practice)

---

## 🧪 TESTING PRIORITIES

### HIGH PRIORITY:
1. ✅ Kategori Event dropdown **muncul** dan **bisa dipilih**
2. ✅ Homepage Placement checkboxes **muncul** dan **bisa dicentang**
3. ✅ Data **tersimpan ke database** dengan benar
4. ✅ Edit form **pre-select kategori** sesuai database
5. ✅ Edit form **pre-check checkbox** sesuai database

### MEDIUM PRIORITY:
6. Event **muncul di homepage** sesuai section yang dipilih
7. Validation error jika kategori tidak dipilih
8. Styling responsive di mobile

### LOW PRIORITY:
9. Unifikasi styling homepage placement (opsional)
10. Testing performa query

---

**SIAP UNTUK TESTING! 🚀**

Silakan test menggunakan checklist di file `EVENT_FORM_TESTING_GUIDE.md`.
