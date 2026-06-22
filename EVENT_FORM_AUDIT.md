# 🔍 EVENT FORM AUDIT - CREATE & EDIT

**Date:** 2026-06-21  
**Files Audited:**
- `resources/views/admin/events/create.blade.php`
- `resources/views/admin/events/edit.blade.php`

---

## 📊 AUDIT SUMMARY

| Component | Status | Issues |
|-----------|--------|--------|
| Basic Fields | ✅ COMPLETE | 0 |
| Price & Quota | ✅ COMPLETE | 0 |
| Ticket Categories | ✅ COMPLETE | 0 |
| Image Upload | ✅ COMPLETE | 0 |
| Category Dropdown | ❌ MISSING | 1 |
| Homepage Placement | ❌ MISSING | 1 |
| JavaScript | ✅ COMPLETE | 0 |

**Overall Status:** ⚠️ **85% COMPLETE** (2 fields missing)

---

## ✅ FIELDS YANG SUDAH ADA (WORKING)

### 1. Basic Information ✅
- ✅ **Nama Event** (title) - text input, required
- ✅ **Lokasi** (location) - text input, required
- ✅ **Tanggal** (date) - date picker, required
- ✅ **Waktu** (time) - time picker, optional
- ✅ **Deskripsi** (description) - textarea, optional

### 2. Pricing System ✅
**Two Modes (Toggle Switch):**

**Mode A: Single Price** (Default)
- ✅ **Harga Tiket** (price) - number input
- ✅ **Kuota Tiket** (quota) - number input

**Mode B: Multiple Ticket Categories** (Optional)
- ✅ **Toggle Switch** - Enable/disable ticket categories
- ✅ **Dynamic Add/Remove** - JavaScript functions working
- ✅ **Category Fields:**
  - Nama Kategori (name)
  - Deskripsi (description)
  - Harga (price)
  - Kuota (quota)

### 3. Image Upload ✅
- ✅ **File Input** - accept jpg, png, jpeg, webp
- ✅ **Live Preview** - JavaScript preview working
- ✅ **Validation** - max 2MB
- ✅ **Recommended Size Info** - 800x400px (2:1 ratio)
- ✅ **Aspect Ratio Preview** - 2:1 container

### 4. JavaScript Features ✅
- ✅ **Toggle Categories** - Show/hide sections
- ✅ **Add Category** - Dynamic add with unique index
- ✅ **Remove Category** - Delete specific category
- ✅ **Image Preview** - Live preview before upload

---

## ❌ MISSING FIELDS (CRITICAL)

### 1. **Event Category Dropdown** ❌

**Impact:** HIGH  
**Priority:** CRITICAL

**Problem:**
- No dropdown to select event category (Musik, Festival, Seminar, etc.)
- Database field `category_id` cannot be populated
- Events created without category
- Homepage filtering by category won't work

**Expected Field:**
```html
<select name="category_id">
    <option value="">-- Pilih Kategori --</option>
    <option value="1">Musik</option>
    <option value="2">Festival</option>
    <!-- etc -->
</select>
```

**Database Column:**
- Field: `category_id` (FK → event_categories table)
- Type: UNSIGNED BIGINT
- Required: Probably (depends on migration)

**Fix Required:**
- Add category dropdown in create.blade.php
- Add category dropdown in edit.blade.php
- Load categories from EventCategory model
- Show selected category in edit form

---

### 2. **Homepage Section Placement Checkboxes** ❌

**Impact:** MEDIUM-HIGH  
**Priority:** HIGH

**Problem:**
- No checkboxes to select homepage sections
- Database fields not populated:
  - `show_in_recommended`
  - `show_in_nearest`
  - `show_in_upcoming`
  - `show_in_popular`
- Events won't appear in homepage sections automatically
- Manual database update required

**Expected Fields:**
```html
<div class="homepage-placement">
    <label><input type="checkbox" name="show_in_recommended"> Rekomendasi Event</label>
    <label><input type="checkbox" name="show_in_nearest"> Event Terdekat</label>
    <label><input type="checkbox" name="show_in_upcoming"> Upcoming Event</label>
    <label><input type="checkbox" name="show_in_popular"> Popular Event</label>
</div>
```

**Database Columns:**
- `show_in_recommended` - BOOLEAN (default false)
- `show_in_nearest` - BOOLEAN (default false)
- `show_in_upcoming` - BOOLEAN (default false)
- `show_in_popular` - BOOLEAN (default false)

**Fix Required:**
- Add 4 checkboxes in create.blade.php
- Add 4 checkboxes in edit.blade.php (with selected state)
- Controller already handles these fields (checked in EventController)

---

## 🔧 CONTROLLER COMPATIBILITY CHECK

### EventController@store ✅
```php
// Already handles category_id (not present in view)
// Already handles homepage placement (not present in view)

$validated['show_in_recommended'] = $request->has('show_in_recommended');
$validated['show_in_nearest'] = $request->has('show_in_nearest');
$validated['show_in_upcoming'] = $request->has('show_in_upcoming');
$validated['show_in_popular'] = $request->has('show_in_popular');
```

**Status:** ✅ Controller ready, just need view fields

### EventController@update ✅
```php
// Same as store, already handles both fields
```

**Status:** ✅ Controller ready, just need view fields

---

## 📋 RECOMMENDED FIXES

### FIX 1: Add Category Dropdown

**Location:** After "Deskripsi Event" field

**Code to Add:**
```html
{{-- Event Category --}}
<div>
    <label class="block text-sm font-semibold text-gray-300 mb-2">
        Kategori Event <span class="text-red-400">*</span>
    </label>
    <select name="category_id" 
            class="w-full px-4 py-3 rounded-xl bg-white/5 border @error('category_id') border-red-500 @else border-white/10 @enderror 
                   text-white focus:outline-none focus:border-[#D4AF37] transition-colors"
            required>
        <option value="">-- Pilih Kategori --</option>
        @foreach(\App\Models\EventCategory::where('is_active', true)->orderBy('name')->get() as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="mt-1.5 text-sm text-red-400">{{ $message }}</p>
    @enderror
</div>
```

**For Edit Form:**
```html
{{ old('category_id', $event->category_id) == $cat->id ? 'selected' : '' }}
```

---

### FIX 2: Add Homepage Placement Checkboxes

**Location:** After "Image Upload" section, before "Submit Buttons"

**Code to Add:**
```html
{{-- Homepage Section Placement --}}
<div class="p-6 rounded-xl bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border border-blue-500/30">
    <h3 class="text-white font-semibold mb-3 flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
        </svg>
        Tampilkan di Homepage
    </h3>
    <p class="text-gray-400 text-sm mb-4">Pilih section homepage tempat event ini akan ditampilkan</p>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <label class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_recommended" 
                   value="1"
                   {{ old('show_in_recommended') ? 'checked' : '' }}
                   class="w-5 h-5 rounded border-gray-600 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
            <span class="text-white text-sm font-medium">⭐ Rekomendasi Event</span>
        </label>
        
        <label class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_nearest" 
                   value="1"
                   {{ old('show_in_nearest') ? 'checked' : '' }}
                   class="w-5 h-5 rounded border-gray-600 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
            <span class="text-white text-sm font-medium">📍 Event Terdekat</span>
        </label>
        
        <label class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_upcoming" 
                   value="1"
                   {{ old('show_in_upcoming') ? 'checked' : '' }}
                   class="w-5 h-5 rounded border-gray-600 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
            <span class="text-white text-sm font-medium">🔜 Upcoming Event</span>
        </label>
        
        <label class="flex items-center gap-3 p-3 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 cursor-pointer transition-colors">
            <input type="checkbox" 
                   name="show_in_popular" 
                   value="1"
                   {{ old('show_in_popular') ? 'checked' : '' }}
                   class="w-5 h-5 rounded border-gray-600 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
            <span class="text-white text-sm font-medium">🔥 Popular Event</span>
        </label>
    </div>
</div>
```

**For Edit Form:**
```html
{{ old('show_in_recommended', $event->show_in_recommended) ? 'checked' : '' }}
{{ old('show_in_nearest', $event->show_in_nearest) ? 'checked' : '' }}
{{ old('show_in_upcoming', $event->show_in_upcoming) ? 'checked' : '' }}
{{ old('show_in_popular', $event->show_in_popular) ? 'checked' : '' }}
```

---

## 🎯 IMPACT ANALYSIS

### Without Category Dropdown:
- ❌ Events created without category
- ❌ Cannot filter by category in homepage
- ❌ Category badge not shown in event card
- ❌ Category statistics incomplete

### Without Homepage Placement:
- ❌ Events not appearing in homepage sections
- ❌ Manual SQL update required
- ❌ Poor UX for admin
- ❌ Homepage sections show "Belum ada event"

---

## ✅ TESTING CHECKLIST (After Fix)

### Create Event:
- [ ] All fields visible
- [ ] Category dropdown has options
- [ ] Homepage checkboxes visible
- [ ] Ticket categories toggle works
- [ ] Image preview works
- [ ] Form submits successfully
- [ ] Event created with category
- [ ] Homepage placement saved

### Edit Event:
- [ ] All fields pre-filled
- [ ] Category dropdown shows selected
- [ ] Homepage checkboxes show current state
- [ ] Ticket categories loaded (if applicable)
- [ ] Current image shown in preview
- [ ] Form updates successfully
- [ ] Category updated
- [ ] Homepage placement updated

---

## 📝 RECOMMENDATION

**Priority:** 🔴 **HIGH - FIX IMMEDIATELY**

**Reason:**
1. Both fields are used by controller
2. Database columns exist
3. Homepage functionality depends on these fields
4. User cannot properly create/edit events without them

**Estimated Time:**
- Add Category Dropdown: 10 minutes
- Add Homepage Checkboxes: 15 minutes
- Testing: 10 minutes
- **Total: 35 minutes**

**Next Steps:**
1. Add category dropdown to create.blade.php & edit.blade.php
2. Add homepage placement checkboxes to both files
3. Test create new event
4. Test edit existing event
5. Verify database values saved correctly
6. Verify homepage sections show events correctly

---

## 📊 CONCLUSION

**Current Status:** ⚠️ **85% FUNCTIONAL**

**Missing:**
- Event Category dropdown (CRITICAL)
- Homepage placement checkboxes (HIGH)

**Recommendation:** ✅ **FIX BEFORE PRODUCTION**

Both fields are required for full functionality. Controller already supports them, just need to add the UI fields.
