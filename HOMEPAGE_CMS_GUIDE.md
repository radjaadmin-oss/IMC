# 🏠 HOMEPAGE CMS - IMPLEMENTATION GUIDE

## ✅ FILES CREATED

### 1. **Migration**
```
database/migrations/2026_06_22_000000_create_homepage_settings_table.php
```

### 2. **Model**
```
app/Models/HomepageSetting.php
```

### 3. **Controller**
```
app/Http/Controllers/Admin/HomepageSettingController.php
```

### 4. **View**
```
resources/views/admin/homepage-settings/index.blade.php
```

### 5. **Routes** (updated)
```
routes/web.php
```

### 6. **HomeController** (updated)
```
app/Http/Controllers/HomeController.php
```

---

## 🚀 INSTALLATION STEPS

### 1. Run Migration
```bash
php artisan migrate
```

### 2. Clear Cache
```bash
php artisan optimize:clear
```

### 3. Access Admin Page
```
http://127.0.0.1:8000/admin/homepage-settings
```

---

## 📋 FEATURES

✅ **Show/Hide Sections:**
- Rekomendasi Event
- Event Terdekat
- Upcoming Event
- Popular Event
- Kategori Event
- Temukan Event di Kotamu

✅ **Customize Per Section:**
- Edit Title
- Edit Subtitle (optional)
- Toggle Show/Hide with switch

✅ **Simple UI:**
- Single page form
- Toggle switches untuk show/hide
- Premium dark theme
- Auto-save all settings in one click

---

## 🎨 HOW TO USE

1. **Open Admin Panel:** `/admin/homepage-settings`
2. **Configure Each Section:**
   - Toggle switch untuk show/hide
   - Edit title jika perlu
   - Tambah subtitle (optional)
3. **Click "Save Settings"**
4. **View Homepage** - changes applied instantly!

---

## 🔧 NEXT: UPDATE HOMEPAGE VIEW

Setelah migration & files ter-copy, kita perlu update `welcome.blade.php` untuk:
- Check `$settings->show_recommended_events` before showing section
- Use `$settings->recommended_events_title` untuk title
- Use `$settings->recommended_events_subtitle` untuk subtitle

**Ini akan saya lakukan di step berikutnya!**

---

## 📊 DATABASE STRUCTURE

Table: `homepage_settings` (single row)

| Field | Type | Default |
|-------|------|---------|
| show_recommended_events | boolean | true |
| recommended_events_title | string | "Rekomendasi Event" |
| recommended_events_subtitle | string | null |
| show_nearest_events | boolean | true |
| nearest_events_title | string | "Event Terdekat" |
| ... | ... | ... |

(Same pattern untuk semua sections)

---

## ✅ BENEFITS

1. **Simple & Easy** - single page management
2. **No Coding Required** - admin bisa edit sendiri
3. **Instant Apply** - langsung keliatan di homepage
4. **Flexible** - bisa hide section yang tidak dipakai
5. **SEO Friendly** - custom title per section

---

**Ready to implement? Run migration dan test!** 🚀
