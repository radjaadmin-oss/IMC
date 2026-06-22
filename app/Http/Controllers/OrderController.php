<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // Cek jika menggunakan kategori tiket
        if ($request->ticket_category_id) {
            $ticketCategory = $event->ticketCategories()->findOrFail($request->ticket_category_id);
            $price = $ticketCategory->price;
            
            // Cek quota kategori
            $remainingQuota = $ticketCategory->quota - $ticketCategory->sold;
            if ($request->quantity > $remainingQuota) {
                return back()->with('error', 'Kuota kategori tiket tidak mencukupi');
            }
        } else {
            // Fallback ke single price mode
            $price = $event->price;
            $ticketCategory = null;
            
            // Cek quota event
            if ($request->quantity > $event->remaining_quota) {
                return back()->with('error', 'Kuota tiket tidak mencukupi');
            }
        }

        $totalPrice = $price * $request->quantity;

        $order = Order::create([
            'order_code' => Order::generateOrderCode(),
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_category_id' => $ticketCategory?->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'attendee_name' => $request->name,
            'attendee_email' => $request->email,
            'attendee_phone' => $request->phone,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
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

        // Hanya pending order yang bisa dicancel
        if ($order->status !== 'pending') {
            return back()->with('error', 'Hanya order dengan status pending yang bisa dibatalkan');
        }

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Order berhasil dibatalkan');
    }
}
