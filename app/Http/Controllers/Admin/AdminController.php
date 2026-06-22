<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use App\Models\HomeBanner;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     * Menampilkan statistik: total event, order, revenue, users
     */
    public function index()
    {
        $stats = [
            'total_events' => Event::count(),
            'total_orders' => Order::where('status', '!=', 'cancelled')->count(),
            'total_revenue' => Order::where('status', '!=', 'cancelled')->sum('total_price'),
            'total_users' => User::where('role', 'user')->count(),
            'active_banners' => HomeBanner::where('status', 'active')->count(),
        ];

        // Latest Orders
        $latestOrders = Order::with(['user', 'event'])
            ->latest()
            ->take(10)
            ->get();

        // Upcoming Events
        $upcomingEvents = Event::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        return view('admin.index', compact('stats', 'latestOrders', 'upcomingEvents'));
    }

    /**
     * Profile Admin
     */
    public function profile()
    {
        return view('admin.profile');
    }
}
