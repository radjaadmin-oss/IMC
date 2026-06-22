# 🧪 RADJATIKET - TESTING GUIDE

**Created:** 2026-06-21  
**Purpose:** Step-by-step testing untuk semua fitur yang baru diimplementasi  
**Target:** Local Development Testing

---

## 📋 TABLE OF CONTENTS

1. [Environment Setup](#1-environment-setup)
2. [Guest Checkout Testing](#2-guest-checkout-testing)
3. [Email Notification Testing](#3-email-notification-testing)
4. [Payment Proof Upload Testing](#4-payment-proof-upload-testing)
5. [Quota Management Testing](#5-quota-management-testing)
6. [Order Expiration Testing](#6-order-expiration-testing)
7. [Form Validation Testing](#7-form-validation-testing)
8. [Accessibility Testing](#8-accessibility-testing)
9. [Troubleshooting](#9-troubleshooting)

---

## 1. ENVIRONMENT SETUP

### **A. Clone & Install**

```bash
# Clone repository (if not already cloned)
git clone https://github.com/radjaadmin-oss/IMC.git
cd IMC

# Install dependencies
composer install
npm install

# Copy .env
cp .env.example .env

# Generate app key
php artisan key:generate

# Create database (SQLite)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Create storage link
php artisan storage:link

# Set permissions
chmod -R 775 storage bootstrap/cache
```

---

### **B. Configure .env**

Edit `.env` file:

```env
APP_NAME=RADJATIKET
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite

# Email Configuration (Mailtrap untuk testing)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@radjatiket.com"
MAIL_FROM_NAME="RADJATIKET"

# Atau gunakan log driver (email tidak dikirim, hanya di-log)
# MAIL_MAILER=log

QUEUE_CONNECTION=sync
```

**📧 Setup Mailtrap (Recommended):**
1. Buat akun gratis di [mailtrap.io](https://mailtrap.io)
2. Buka Inbox → Copy SMTP credentials
3. Paste ke `.env` file

---

### **C. Seed Test Data**

```bash
# Buat seeder untuk test data (optional)
php artisan tinker
```

Di tinker, buat test user & event:

```php
// Create admin user
$admin = \App\Models\User::create([
    'name' => 'Admin Test',
    'email' => 'admin@test.com',
    'password' => bcrypt('password'),
    'role' => 'admin',
    'status' => 'active',
]);

// Create event organizer
$eo = \App\Models\User::create([
    'name' => 'Event Organizer',
    'email' => 'eo@test.com',
    'password' => bcrypt('password'),
    'role' => 'event_organizer',
    'status' => 'active',
]);

// Create category
$category = \App\Models\Category::create([
    'name' => 'Musik',
    'slug' => 'musik',
    'icon' => '🎵',
    'is_active' => true,
]);

// Create event
$event = \App\Models\Event::create([
    'title' => 'Test Concert 2026',
    'slug' => 'test-concert-2026',
    'description' => 'Test event untuk testing checkout',
    'category_id' => $category->id,
    'organizer_id' => $eo->id,
    'date' => now()->addDays(30),
    'start_time' => '19:00',
    'end_time' => '23:00',
    'location' => 'Jakarta Convention Center',
    'quota' => 100,
    'price' => 150000,
    'status' => 'published',
    'is_featured' => true,
]);

// Create ticket categories
$vip = \App\Models\TicketCategory::create([
    'event_id' => $event->id,
    'name' => 'VIP',
    'price' => 500000,
    'quota' => 20,
    'description' => 'VIP Section with premium access',
]);

$regular = \App\Models\TicketCategory::create([
    'event_id' => $event->id,
    'name' => 'Regular',
    'price' => 150000,
    'quota' => 80,
    'description' => 'Standard admission',
]);

echo "✅ Test data created successfully!\n";
echo "Event ID: " . $event->id . "\n";
echo "Admin: admin@test.com / password\n";
echo "EO: eo@test.com / password\n";
exit;
```

---

### **D. Start Server**

```bash
# Start Laravel development server
php artisan serve

# Open browser
# http://localhost:8000
```

---

## 2. GUEST CHECKOUT TESTING

### **Test Case 1: Guest User Checkout (NEW FEATURE!) ✨**

**Steps:**
1. **Jangan login** (pastikan logged out)
2. Buka homepage: `http://localhost:8000`
3. Klik salah satu event card
4. Klik button "Beli Tiket" atau "Pesan Sekarang"
5. Pilih kategori tiket (VIP atau Regular)
6. Isi jumlah tiket (contoh: 2)
7. Isi form informasi pemesan:
   - Nama: `Test Guest User`
   - Email: `guest@test.com` (gunakan email testing Anda)
   - No. WhatsApp: `081234567890`
8. Klik "LANJUTKAN PEMBAYARAN"

**Expected Result:**
- ✅ Order berhasil dibuat tanpa harus login
- ✅ Redirect ke halaman order detail (`/orders/{id}`)
- ✅ Success message: "Pesanan berhasil dibuat! Cek email Anda untuk detail pesanan"
- ✅ Email OrderCreated dikirim ke `guest@test.com`
- ✅ Order code tampil di halaman (contoh: `RDJ-A1B2C3-456`)
- ✅ Payment status: `Pending`
- ✅ Batas waktu pembayaran: 24 jam dari sekarang

**Check Database:**
```bash
php artisan tinker
```

```php
$order = \App\Models\Order::latest()->first();
echo "User ID: " . ($order->user_id ?? 'NULL (Guest)') . "\n";
echo "Order Code: " . $order->order_code . "\n";
echo "Email: " . $order->attendee_email . "\n";
echo "Status: " . $order->payment_status . "\n";
exit;
```

**Expected:** `user_id` should be `NULL` for guest orders.

---

### **Test Case 2: Logged-in User Checkout**

**Steps:**
1. Login dengan akun test: `admin@test.com` / `password`
2. Browse event dan checkout seperti biasa
3. Submit order

**Expected Result:**
- ✅ Order berhasil dibuat
- ✅ `user_id` di database = admin user ID (NOT NULL)
- ✅ User bisa lihat order di "Tiket Saya" menu

---

### **Test Case 3: Guest Access Order Detail via Email Link**

**Steps:**
1. Buka email yang dikirim ke guest user
2. Klik link "Lihat Detail Pesanan" di email
3. Atau manually buka URL: `http://localhost:8000/orders/{order_id}`

**Expected Result:**
- ✅ Order detail page terbuka (TANPA harus login!)
- ✅ Semua informasi order tampil
- ✅ Form upload payment proof visible
- ✅ Button "Batalkan Pesanan" visible

---

## 3. EMAIL NOTIFICATION TESTING

### **Test Case 4: OrderCreated Email**

**Setup Mailtrap:**
1. Login ke [mailtrap.io](https://mailtrap.io)
2. Buka Inbox → My Inbox
3. Pastikan credentials sudah di `.env`

**Steps:**
1. Create order (guest atau logged-in)
2. Buka Mailtrap inbox

**Expected Email Content:**
- ✅ Subject: `Pesanan Tiket Berhasil Dibuat - RDJ-XXXXXX-XXX`
- ✅ Greeting: `Hai **Test Guest User**`
- ✅ Order code displayed
- ✅ Event details (title, date, location)
- ✅ Ticket details (category, quantity, price)
- ✅ Total payment amount
- ✅ Payment deadline (24 hours)
- ✅ Bank account info (BCA, Mandiri)
- ✅ Button "Lihat Detail Pesanan" dengan link ke order page
- ✅ Email footer dengan contact info

**Check Logs (if using log driver):**
```bash
tail -f storage/logs/laravel.log
# Look for "OrderCreated mail sent"
```

---

### **Test Case 5: OrderPaid Email**

**Steps:**
1. Login sebagai admin: `http://localhost:8000/login`
   - Email: `admin@test.com`
   - Password: `password`
2. Buka Admin Dashboard → Orders
3. Klik order yang baru dibuat
4. Change Payment Status: `Pending` → `Paid`
5. Klik "Update Status"
6. Buka Mailtrap inbox

**Expected Email Content:**
- ✅ Subject: `Pembayaran Dikonfirmasi - Tiket Anda Siap! 🎉 RDJ-XXXXXX-XXX`
- ✅ Congratulations message
- ✅ Payment confirmed badge
- ✅ E-ticket with order code (large, bold, QR-ready)
- ✅ Event details
- ✅ Instructions untuk check-in
- ✅ Button "Lihat E-Ticket Saya"
- ✅ Contact support information

---

## 4. PAYMENT PROOF UPLOAD TESTING

### **Test Case 6: Guest Upload Payment Proof**

**Steps:**
1. Buka order detail page sebagai guest (via email link)
2. Scroll ke section "Upload Bukti Pembayaran"
3. Siapkan test image (JPG/PNG, max 2MB)
4. Klik "Choose File" dan pilih image
5. Klik "📤 Upload Bukti Pembayaran"

**Expected Result:**
- ✅ Success message: "Bukti pembayaran berhasil diupload!"
- ✅ Green badge: "✅ Bukti pembayaran telah diupload"
- ✅ Link "Lihat bukti pembayaran" muncul
- ✅ File tersimpan di `storage/app/public/payment-proofs/`
- ✅ Admin bisa lihat bukti pembayaran di admin panel

**Check Storage:**
```bash
ls -la storage/app/public/payment-proofs/
# Should see uploaded file
```

---

### **Test Case 7: Upload Validation**

**Test A: File terlalu besar (> 2MB)**
- Upload file > 2MB
- Expected: Error "Ukuran file maksimal 2MB"

**Test B: Invalid file type**
- Upload .txt atau .docx file
- Expected: Error "Format file harus: JPG, PNG, atau PDF"

**Test C: Upload tanpa file**
- Klik upload tanpa pilih file
- Expected: Error "Bukti pembayaran wajib diupload"

**Test D: Re-upload (Replace)**
- Upload file pertama
- Upload file kedua
- Expected: File lama terhapus, file baru tersimpan

---

## 5. QUOTA MANAGEMENT TESTING

### **Test Case 8: Normal Order - Quota Decrement**

**Setup:**
```bash
php artisan tinker
```

```php
$event = \App\Models\Event::first();
$initialQuota = $event->quota;
$initialSold = $event->sold_count;
echo "Initial Quota: $initialQuota\n";
echo "Initial Sold: $initialSold\n";
echo "Remaining: " . ($initialQuota - $initialSold) . "\n";
exit;
```

**Steps:**
1. Create order dengan quantity 2
2. Check database lagi

```php
$event = \App\Models\Event::first();
echo "Sold Count: " . $event->sold_count . "\n"; // Should be +2
exit;
```

**Expected:**
- ✅ `sold_count` bertambah sesuai quantity
- ✅ Remaining quota berkurang

---

### **Test Case 9: Order Cancellation - Quota Restore**

**Steps:**
1. Buka order detail page
2. Klik button "❌ Batalkan Pesanan"
3. Confirm cancellation
4. Check database

```php
$event = \App\Models\Event::first();
echo "Sold Count: " . $event->sold_count . "\n"; // Should be restored
exit;
```

**Expected:**
- ✅ Order status: `cancelled`
- ✅ Payment status: `expired`
- ✅ `sold_count` dikurangi (quota restored)

---

### **Test Case 10: Quota Limit - Prevent Overselling**

**Setup:**
```php
// Set event quota to 5
$event = \App\Models\Event::first();
$event->update(['quota' => 5, 'sold_count' => 0]);
```

**Steps:**
1. Create order dengan quantity 3 → Success
2. Create order lagi dengan quantity 3 → Should FAIL

**Expected Result:**
- ✅ First order: Success (sold_count = 3)
- ✅ Second order: Error "Kuota tiket tidak mencukupi. Tersisa: 2 tiket"
- ✅ Quota tidak oversell

---

### **Test Case 11: Race Condition Prevention (Advanced)**

**Requires:** Multiple browser tabs / Postman / curl

**Setup:**
```php
$event = \App\Models\Event::first();
$event->update(['quota' => 1, 'sold_count' => 0]);
// Only 1 ticket available
```

**Steps:**
1. Open checkout form di 2 browser tabs
2. Submit order simultaneously dari kedua tabs
3. Only ONE should succeed

**Expected:**
- ✅ Tab 1: Order created successfully
- ✅ Tab 2: Error "Kuota tidak mencukupi"
- ✅ Database `sold_count` = 1 (NOT 2!)

---

## 6. ORDER EXPIRATION TESTING

### **Test Case 12: Auto-Expire Orders Command**

**Setup:**
```php
// Create order dengan expired payment deadline
$order = \App\Models\Order::create([
    'order_code' => 'RDJ-TEST-999',
    'user_id' => null,
    'event_id' => 1,
    'quantity' => 2,
    'total_price' => 300000,
    'attendee_name' => 'Test Expired',
    'attendee_email' => 'expired@test.com',
    'attendee_phone' => '081234567890',
    'status' => 'confirmed',
    'payment_status' => 'pending',
    'payment_expired_at' => now()->subHours(2), // 2 jam yang lalu (sudah expired)
]);

$event = \App\Models\Event::first();
$event->increment('sold_count', 2);
echo "Order created with expired deadline\n";
echo "Event sold_count: " . $event->sold_count . "\n";
exit;
```

**Run Command:**
```bash
php artisan orders:expire
```

**Expected Output:**
```
Checking expired orders...
✅ Order RDJ-TEST-999 expired. Quota restored: 2 tickets
✅ Expired 1 order(s). Total quota restored: 2
```

**Check Database:**
```php
$order = \App\Models\Order::where('order_code', 'RDJ-TEST-999')->first();
echo "Payment Status: " . $order->payment_status . "\n"; // Should be 'expired'
echo "Status: " . $order->status . "\n"; // Should be 'cancelled'

$event = \App\Models\Event::first();
echo "Sold Count: " . $event->sold_count . "\n"; // Should be decreased by 2
exit;
```

---

### **Test Case 13: Schedule Cron (Production)**

**Add to crontab:**
```bash
crontab -e
```

Add:
```
* * * * * cd /path/to/IMC && php artisan schedule:run >> /dev/null 2>&1
```

**Manual test scheduler:**
```bash
php artisan schedule:run
# Should run orders:expire every minute
```

---

## 7. FORM VALIDATION TESTING

### **Test Case 14: Checkout Form Validation**

**Test A: Empty Form**
- Submit form tanpa isi apapun
- Expected: Red borders + error messages di bawah setiap field

**Test B: Invalid Email**
- Name: `Test`
- Email: `invalid-email` (tanpa @)
- Phone: `081234567890`
- Submit
- Expected: Red border di email field + "Email tidak valid"

**Test C: Invalid Quantity**
- Quantity: `0` atau `11` (di luar range 1-10)
- Expected: Error "Jumlah harus antara 1 dan 10"

**Test D: Old Input Preservation**
- Isi form dengan data valid tapi skip kategori tiket
- Submit → error
- Expected: Semua field tetap terisi (nama, email, phone preserved)

---

### **Test Case 15: Loading State**

**Steps:**
1. Isi form checkout
2. Klik "LANJUTKAN PEMBAYARAN"
3. Observe button state

**Expected:**
- ✅ Button text berubah jadi "Memproses..." dengan spinner
- ✅ Button disabled (tidak bisa di-click lagi)
- ✅ Prevent double submission

---

## 8. ACCESSIBILITY TESTING

### **Test Case 16: Keyboard Navigation**

**Steps:**
1. Buka homepage
2. Press `Tab` key repeatedly
3. Navigate through all interactive elements

**Expected:**
- ✅ Focus indicator visible (yellow outline)
- ✅ All buttons, links, inputs reachable via Tab
- ✅ Dapat navigate navbar tanpa mouse
- ✅ Dapat submit form tanpa mouse (Tab + Enter)

---

### **Test Case 17: Screen Reader (Optional)**

**Tools:**
- Windows: NVDA (free)
- Mac: VoiceOver (built-in)

**Steps:**
1. Enable screen reader
2. Navigate homepage
3. Navigate checkout form

**Expected:**
- ✅ Images have alt text announced
- ✅ Buttons announce their purpose
- ✅ Form labels properly associated
- ✅ Error messages announced

---

### **Test Case 18: Lighthouse Audit**

**Steps:**
1. Open Chrome DevTools (F12)
2. Go to "Lighthouse" tab
3. Select "Accessibility" only
4. Click "Generate report"

**Expected Score:**
- Target: 85+ / 100
- Check for issues and fix according to ACCESSIBILITY_IMPROVEMENTS.md

---

## 9. TROUBLESHOOTING

### **Problem: Email tidak terkirim**

**Solution:**
```bash
# Check mail config
php artisan config:clear
php artisan tinker
>>> config('mail')

# Test mail sending
>>> Mail::raw('Test', function($msg) { 
    $msg->to('test@example.com')->subject('Test'); 
});

# Check logs
tail -f storage/logs/laravel.log
```

---

### **Problem: Storage link tidak work**

**Solution:**
```bash
# Remove old link
rm public/storage

# Create new link
php artisan storage:link

# Set permissions
chmod -R 775 storage
```

---

### **Problem: Migration error**

**Solution:**
```bash
# Reset database (WARNING: deletes all data)
php artisan migrate:fresh

# Or rollback and re-run
php artisan migrate:rollback
php artisan migrate
```

---

### **Problem: 403 Forbidden saat upload file**

**Solution:**
```bash
# Check storage permissions
chmod -R 775 storage/app/public

# Check ownership (if on Linux)
sudo chown -R www-data:www-data storage
```

---

### **Problem: Queue not processing**

**Solution:**
```bash
# For development, use sync driver
# In .env:
QUEUE_CONNECTION=sync

# Or run queue worker manually
php artisan queue:work

# Restart queue after code changes
php artisan queue:restart
```

---

## ✅ TESTING CHECKLIST

### **Core Features:**
- [ ] Guest checkout tanpa login
- [ ] Logged-in user checkout
- [ ] Email OrderCreated dikirim
- [ ] Email OrderPaid dikirim
- [ ] Upload payment proof (guest)
- [ ] Upload payment proof (logged-in)
- [ ] Quota decrement saat order
- [ ] Quota restore saat cancel
- [ ] Quota limit enforcement
- [ ] Auto-expire orders command
- [ ] Form validation dengan error styling
- [ ] Loading state saat submit
- [ ] Old input preserved saat error

### **Edge Cases:**
- [ ] Upload file > 2MB (should fail)
- [ ] Upload invalid file type (should fail)
- [ ] Order dengan quota = 0 (should fail)
- [ ] Concurrent orders untuk last ticket
- [ ] Cancel order yang sudah paid (should fail)
- [ ] Upload payment untuk paid order (should fail)

### **User Experience:**
- [ ] Keyboard navigation works
- [ ] Focus indicators visible
- [ ] Success/error messages clear
- [ ] Mobile responsive
- [ ] Fast page load

---

## 🎯 EXPECTED TEST RESULTS

**All tests should pass:**
- ✅ 18 test cases
- ✅ 13 core features
- ✅ 6 edge cases
- ✅ 5 UX checks

**If any test fails:**
1. Check error message
2. Review logs: `storage/logs/laravel.log`
3. Check database state
4. Refer to troubleshooting section
5. Report issue with details

---

## 📞 NEED HELP?

**Documentation:**
- [DEPLOYMENT_CHECKLIST.md](./DEPLOYMENT_CHECKLIST.md)
- [ACCESSIBILITY_IMPROVEMENTS.md](./ACCESSIBILITY_IMPROVEMENTS.md)
- [IMPLEMENTATION_SUMMARY.md](./IMPLEMENTATION_SUMMARY.md)

**Common Issues:**
Most issues are covered in the Troubleshooting section above.

---

**Happy Testing! 🚀**

Testing adalah langkah penting untuk memastikan platform ready for production. Take your time dan test thoroughly!

---

**Document Created:** 2026-06-21  
**Version:** 1.0  
**Status:** Ready for Testing
