<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Mail\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()
            ->with(['event', 'ticketCategory'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create(Event $event)
    {
        // Load ticket categories jika ada
        $event->load('ticketCategories');
        
        // Jika event tidak punya kategori tiket, buat kategori default untuk fallback
        if (!$event->has_ticket_categories || $event->ticketCategories->isEmpty()) {
            $event->fallbackCategory = (object)[
                'id' => null,
                'name' => 'Tiket Regular',
                'price' => $event->price,
                'quota' => $event->quota,
                'sold' => $event->sold_count ?? 0,
                'remaining' => $event->remaining_quota
            ];
        }
        
        return view('orders.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'ticket_category_id' => 'nullable|exists:ticket_categories,id',
            'quantity' => 'required|integer|min:1|max:10',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        try {
            return DB::transaction(function() use ($request, $event, $validated) {
                
                // TICKET CATEGORY MODE
                if ($request->ticket_category_id) {
                    // ✅ Lock row untuk prevent race condition
                    $ticketCategory = $event->ticketCategories()
                        ->where('id', $request->ticket_category_id)
                        ->lockForUpdate()
                        ->firstOrFail();
                    
                    // Check quota dengan lock
                    $remainingQuota = $ticketCategory->quota - $ticketCategory->sold;
                    if ($request->quantity > $remainingQuota) {
                        throw new \Exception('Kuota kategori tiket tidak mencukupi. Tersisa: ' . $remainingQuota . ' tiket');
                    }
                    
                    $price = $ticketCategory->price;
                    $ticketCategoryId = $ticketCategory->id;
                    
                } else {
                    // SINGLE PRICE MODE
                    // ✅ Lock event row
                    $event = Event::where('id', $event->id)
                        ->lockForUpdate()
                        ->firstOrFail();
                    
                    $remainingQuota = $event->quota - $event->sold_count;
                    if ($request->quantity > $remainingQuota) {
                        throw new \Exception('Kuota tiket tidak mencukupi. Tersisa: ' . $remainingQuota . ' tiket');
                    }
                    
                    $price = $event->price;
                    $ticketCategoryId = null;
                }
                
                $totalPrice = $price * $request->quantity;
                
                // Create order
                $order = Order::create([
                    'order_code' => Order::generateOrderCode(),
                    'user_id' => Auth::id(),
                    'event_id' => $event->id,
                    'ticket_category_id' => $ticketCategoryId,
                    'quantity' => $request->quantity,
                    'total_price' => $totalPrice,
                    'attendee_name' => $request->name,
                    'attendee_email' => $request->email,
                    'attendee_phone' => $request->phone,
                    'status' => 'confirmed',
                    'payment_status' => 'pending',
                    'payment_expired_at' => now()->addHours(24), // ✅ Add 24h expiration
                ]);
                
                // ✅ DECREMENT QUOTA (CRITICAL FIX!)
                if ($ticketCategoryId) {
                    $ticketCategory->increment('sold', $request->quantity);
                } else {
                    $event->increment('sold_count', $request->quantity);
                }
                
                // ✅ Send email notification
                try {
                    Mail::to($order->attendee_email)->send(new OrderCreated($order));
                } catch (\Exception $e) {
                    // Log error but don't fail the order creation
                    \Log::warning('Failed to send OrderCreated email: ' . $e->getMessage());
                }
                
                return redirect()->route('orders.show', $order)
                    ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran dalam 24 jam.');
            });
            
        } catch (\Exception $e) {
            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function show(Order $order)
    {
        // Pastikan user hanya bisa melihat ordernya sendiri
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('event', 'ticketCategory');
        return view('orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // Pastikan user hanya bisa cancel ordernya sendiri
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek status order
        if ($order->payment_status === 'paid') {
            return back()->with('error', 'Order yang sudah dibayar tidak bisa dibatalkan');
        }
        
        if ($order->status === 'cancelled') {
            return back()->with('error', 'Order sudah dibatalkan sebelumnya');
        }

        try {
            DB::transaction(function() use ($order) {
                // ✅ RESTORE QUOTA (CRITICAL FIX!)
                if ($order->ticket_category_id) {
                    $order->ticketCategory->decrement('sold', $order->quantity);
                } else {
                    $order->event->decrement('sold_count', $order->quantity);
                }
                
                // Update order status
                $order->update([
                    'status' => 'cancelled',
                    'payment_status' => 'expired'
                ]);
            });
            
            return back()->with('success', 'Order berhasil dibatalkan. Kuota telah dikembalikan.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membatalkan order: ' . $e->getMessage());
        }
    }

    public function uploadPaymentProof(Request $request, Order $order)
    {
        // Pastikan user hanya bisa upload untuk ordernya sendiri
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek status order
        if ($order->payment_status === 'paid') {
            return back()->with('error', 'Order sudah dibayar, tidak perlu upload bukti pembayaran lagi');
        }

        if ($order->payment_status === 'expired') {
            return back()->with('error', 'Order sudah expired, tidak dapat upload bukti pembayaran');
        }

        // Validate file
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,jpg,png,pdf|max:2048', // Max 2MB
        ], [
            'payment_proof.required' => 'Bukti pembayaran wajib diupload',
            'payment_proof.image' => 'File harus berupa gambar',
            'payment_proof.mimes' => 'Format file harus: JPG, PNG, atau PDF',
            'payment_proof.max' => 'Ukuran file maksimal 2MB',
        ]);

        try {
            // Delete old payment proof if exists
            if ($order->payment_proof) {
                \Storage::delete('public/' . $order->payment_proof);
            }

            // Store new payment proof
            $path = $request->file('payment_proof')->store('payment-proofs', 'public');

            // Update order
            $order->update([
                'payment_proof' => $path,
            ]);

            return back()->with('success', 'Bukti pembayaran berhasil diupload! Admin akan segera memverifikasi pembayaran Anda.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal upload bukti pembayaran: ' . $e->getMessage());
        }
    }
}
