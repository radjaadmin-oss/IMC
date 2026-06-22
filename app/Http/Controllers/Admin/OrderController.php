<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Event;
use App\Mail\OrderPaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'event', 'ticketCategory']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhere('attendee_name', 'like', "%{$search}%")
                  ->orWhere('attendee_email', 'like', "%{$search}%");
            });
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by order status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        $events = Event::orderBy('title')->get();

        // Statistics
        $stats = [
            'total' => Order::count(),
            'paid' => Order::where('payment_status', 'paid')->count(),
            'pending' => Order::where('payment_status', 'pending')->count(),
            'expired' => Order::where('payment_status', 'expired')->count(),
            'revenue' => Order::where('payment_status', 'paid')->sum('total_price'),
        ];

        return view('admin.orders.index', compact('orders', 'events', 'stats'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'event', 'ticketCategory']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:paid,pending,expired',
        ]);

        $data = ['payment_status' => $request->payment_status];

        // If marking as paid, set paid_at timestamp
        if ($request->payment_status === 'paid' && $order->payment_status !== 'paid') {
            $data['paid_at'] = now();
            $data['status'] = 'confirmed';
            
            // ✅ Send payment confirmation email
            try {
                Mail::to($order->attendee_email)->send(new OrderPaid($order));
            } catch (\Exception $e) {
                // Log error but don't fail the status update
                \Log::warning('Failed to send OrderPaid email: ' . $e->getMessage());
            }
        }

        // If marking as expired or cancelled, restore quota
        if ($request->payment_status === 'expired' && $order->payment_status !== 'expired') {
            $data['status'] = 'cancelled';
            
            // Restore quota to ticket category and event
            $order->ticketCategory->decrement('sold', $order->quantity);
            $order->event->decrement('sold_count', $order->quantity);
        }

        $order->update($data);

        return back()->with('success', 'Payment status berhasil diupdate!');
    }

    public function destroy(Order $order)
    {
        // Tidak bisa hapus order yang sudah paid
        if ($order->payment_status === 'paid') {
            return back()->with('error', 'Tidak dapat menghapus order yang sudah dibayar!');
        }

        // Restore quota if order was confirmed (pending paid)
        if ($order->payment_status === 'pending') {
            $order->ticketCategory->decrement('sold', $order->quantity);
            $order->event->decrement('sold_count', $order->quantity);
        }

        $order->delete();

        return back()->with('success', 'Order berhasil dihapus!');
    }
}
