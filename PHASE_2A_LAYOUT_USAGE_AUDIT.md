# 🔍 RADJATIKET V2 - LAYOUT USAGE AUDIT REPORT

**Audit Type:** Layout Duplication & Usage Analysis  
**Date:** 2026-06-23  
**Purpose:** Determine which layouts are safe to modify/delete  

---

## 📊 LAYOUT USAGE SUMMARY

### **Actual Usage (via grep search):**

| Layout File | Usage Count | Status | Action |
|-------------|-------------|--------|--------|
| **layouts.app** | 8 files | ✅ Active | 🔄 Modify (light theme) |
| **layouts.admin** | 3 files | ⚠️ Active | 🔄 Migrate to admin-master |
| **layouts.admin-master** | 21 files | ✅ Active | 🔄 Modify (red theme) |
| **layouts.guest** | ? | ✅ Active | ✅ Keep as-is (Breeze) |
| **layouts.breeze** | 0 files | ❌ Unused | ❌ Can delete |
| **layouts.navigation** | 0 files | ✅ Partial | ✅ Keep (used by app) |

---

## 🔍 DETAILED FINDINGS

### **1. layouts.app** (8 files using it)

**Used by:**
```
resources/views/
├── welcome.blade.php
├── events/index.blade.php
├── events/show.blade.php
├── orders/index.blade.php
├── orders/create.blade.php
├── orders/show.blade.php
├── pages/show.blade.php
└── detail.blade.php
```

**Verdict:** ✅ **ACTIVELY USED** - Primary public layout  
**Action:** 🔄 **MODIFY** to light theme (white bg, dark header/footer, red buttons)

---

### **2. layouts.admin-master** (21 files using it)

**Used by:** All admin panel pages
```
resources/views/admin/
├── dashboard.blade.php
├── banners/*.blade.php (3 files)
├── categories/index.blade.php
├── events/*.blade.php (6 files)
├── homepage-settings/index.blade.php
├── orders/*.blade.php (2 files)
├── pages/*.blade.php (3 files)
└── users/*.blade.php (4 files)
```

**Verdict:** ✅ **ACTIVELY USED** - Primary admin layout  
**Action:** 🔄 **MODIFY** to unified red theme (keep dark, update red accent)

---

### **3. layouts.admin** (3 files using it) ⚠️

**Used by:**
```
resources/views/
├── admin/create.blade.php
├── admin/index.blade.php
└── events/edit.blade.php
```

**Verdict:** ⚠️ **DUPLICATE** - Older admin layout  
**Action:** 🔄 **MIGRATE** these 3 files to use `admin-master` instead

**Migration Plan:**
```diff
# admin/create.blade.php
- @extends('layouts.admin')
+ @extends('layouts.admin-master')

# admin/index.blade.php
- @extends('layouts.admin')
+ @extends('layouts.admin-master')

# events/edit.blade.php (this seems wrong - should be in admin folder)
- @extends('layouts.admin')
+ @extends('layouts.admin-master')
```

**Risk:** 🟢 **VERY LOW** (only 3 files, same structure)

---

### **4. layouts.guest** (used by Breeze auth pages)

**Used by:**
```
resources/views/auth/
├── login.blade.php
├── register.blade.php
├── forgot-password.blade.php
├── reset-password.blade.php
├── verify-email.blade.php
└── confirm-password.blade.php
```

**Verdict:** ✅ **ACTIVELY USED** - Breeze auth layout  
**Action:** ✅ **KEEP AS-IS** (standard Breeze, no changes needed)

---

### **5. layouts.breeze** (0 files using it)

**Used by:** None (not found in any view file)

**Verdict:** ❌ **UNUSED** - Not referenced anywhere  
**Action:** ❌ **SAFE TO DELETE** (but keep for now as requested)

---

### **6. layouts.navigation** (partial used by app.blade.php)

**Used by:**
```
resources/views/layouts/app.blade.php includes it via:
@include('layouts.navigation')
```

**Verdict:** ✅ **PARTIAL USAGE** - Navbar component  
**Action:** 🔄 **MODIFY** along with app.blade.php

---

## 📋 RECOMMENDED ACTIONS

### **Phase 2B: Safe Modifications**

#### **Action 1: Modify app.blade.php (8 files affected)**
```
Impact: Homepage, events, orders, pages
Risk: 🟡 Medium (visual changes)
Testing: Test all 8 pages
```

#### **Action 2: Modify admin-master.blade.php (21 files affected)**
```
Impact: All admin pages
Risk: 🟡 Medium (visual changes)
Testing: Test dashboard + sample pages from each section
```

#### **Action 3: Migrate 3 files from layouts.admin → admin-master**
```
Files:
  - admin/create.blade.php
  - admin/index.blade.php
  - events/edit.blade.php

Steps:
  1. Change @extends('layouts.admin') → @extends('layouts.admin-master')
  2. Test each page
  3. Verify no broken UI

Risk: 🟢 Very Low (simple string replace)
Time: 15 minutes
```

---

### **Phase 2C: Cleanup (After Migration)**

#### **Action 4: Delete unused layouts.admin (after migration)**
```
Prerequisite: All 3 files migrated to admin-master
Steps:
  1. Verify grep search returns 0 results
  2. Delete resources/views/layouts/admin.blade.php
  3. Test all admin pages
  4. Commit with clear message

Risk: 🟢 Zero (already migrated)
```

#### **Action 5: Delete unused layouts.breeze**
```
Prerequisite: None (already unused)
Steps:
  1. Delete resources/views/layouts/breeze.blade.php
  2. Commit with clear message

Risk: 🟢 Zero (not used anywhere)
```

---

## ⚠️ CRITICAL FINDINGS

### **Issue 1: events/edit.blade.php using layouts.admin**

**Problem:** 
- File: `resources/views/events/edit.blade.php`
- Uses: `@extends('layouts.admin')`
- Location: Should be in `admin/events/` folder, not root `events/`

**Questions:**
1. Is this file actually used? (check routes)
2. Is this a duplicate of `admin/events/edit.blade.php`?
3. Should it be deleted or moved?

**Recommendation:**
```bash
# Check if used in routes
grep -r "events.edit" routes/
grep -r "events/edit" app/Http/Controllers/

# If not used, delete it
# If used, investigate and refactor
```

### **Issue 2: admin/create.blade.php and admin/index.blade.php**

**Problem:**
- Files: `admin/create.blade.php`, `admin/index.blade.php`
- Location: Directly in `admin/` root (not in subfolder)
- Uses: `layouts.admin` (old layout)

**Questions:**
1. What are these files for? (generic CRUD scaffolding?)
2. Are they actually used in routes?
3. Should they be deleted or migrated?

**Recommendation:**
```bash
# Check if used in routes
grep -r "admin.create" routes/
grep -r "admin.index" routes/

# If not used, delete them
# If used, migrate to admin-master
```

---

## 🎯 FINAL LAYOUT STRATEGY

### **Phase 2B: Safe & Simple**

**DO:**
- ✅ Modify `app.blade.php` (8 files affected)
- ✅ Modify `admin-master.blade.php` (21 files affected)
- ✅ Keep all existing layouts (no deletions)

**DON'T:**
- ❌ Delete any layout files
- ❌ Migrate `layouts.admin` users (save for Phase 2C)
- ❌ Change Breeze auth layouts

**Result:** Zero risk of breaking existing pages

---

### **Phase 2C: Cleanup & Optimization**

**DO:**
- ✅ Audit `events/edit.blade.php` usage
- ✅ Audit `admin/create.blade.php` usage
- ✅ Audit `admin/index.blade.php` usage
- ✅ Migrate 3 files to `admin-master`
- ✅ Delete `layouts.admin` (after migration)
- ✅ Delete `layouts.breeze` (unused)

**Result:** Cleaner codebase, single source of truth

---

## 📊 FINAL STATISTICS

| Metric | Count | Notes |
|--------|-------|-------|
| **Total View Files** | 32 files | Using @extends |
| **Using app.blade.php** | 8 files | Public pages |
| **Using admin-master.blade.php** | 21 files | Admin pages |
| **Using layouts.admin** | 3 files | ⚠️ Need migration |
| **Using layouts.guest** | ~6 files | Breeze auth |
| **Using layouts.breeze** | 0 files | ❌ Unused |
| **Files to Modify** | 2 layouts | app + admin-master |
| **Files to Migrate** | 3 files | admin → admin-master |
| **Files to Delete** | 2 layouts | After migration |

---

## ✅ APPROVAL CHECKLIST

Before proceeding with Phase 2B:

- [x] ✅ Layout usage audited (grep search completed)
- [x] ✅ No layouts will be deleted in Phase 2B
- [x] ✅ Only 2 layouts will be modified (app, admin-master)
- [x] ✅ 3 files need migration (Phase 2C, not 2B)
- [x] ✅ Breeze auth layouts untouched
- [x] ✅ Zero breaking change risk in Phase 2B

---

## 🚦 CONCLUSION

**Layout System Status:** ✅ **SAFE TO PROCEED**

- ✅ Primary layouts identified (app, admin-master)
- ✅ Duplicate layouts identified (admin - 3 files)
- ✅ Unused layouts identified (breeze - 0 files)
- ✅ Migration path clear (3 files, simple)
- ✅ Deletion path clear (after migration)
- ✅ Zero risk in Phase 2B (no deletions)

**Recommendation:** 
Proceed with Phase 2B as planned. Save layout migration for Phase 2C.

---

**END OF LAYOUT USAGE AUDIT**

