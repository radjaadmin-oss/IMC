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
     * Admin Dashboard - MASTER ADMIN PANEL
     * Menampilkan statistik lengkap untuk master administrator
     */
    public function index()
    {
        // Statistics Cards
        $totalEvents = Event::count();
        $activeEvents = Event::where('date', '>=', now())->count();
        $totalTickets = Order::where('status', 'paid')->sum('quantity');
        $totalCustomers = User::where('role', 'user')->count();
        
        // Revenue Statistics
        $revenueToday = Order::where('status', 'paid')
            ->whereDate('created_at', today())
            ->sum('total_price');
            
        $revenueMonth = Order::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');
        
        // Pending & Waiting
        $pendingPayment = Order::where('status', 'pending')->count();
        $refundRequest = Order::where('status', 'refund_requested')->count();
        $withdrawalPending = 0; // TODO: Implement withdrawal model
        
        // Total Revenue
        $totalRevenue = Order::where('status', 'paid')->sum('total_price');

        // Latest Orders
        $latestOrders = Order::with(['user', 'event'])
            ->latest()
            ->take(10)
            ->get();

        // Top Events (by sold tickets)
        $topEvents = Event::withCount(['orders as total_sold' => function($query) {
                $query->where('status', 'paid');
            }])
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // Upcoming Events
        $upcomingEvents = Event::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        // Revenue Chart Data (Last 30 Days)
        $revenueChartLabels = [];
        $revenueChartData = [];
        
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenueChartLabels[] = $date->format('d M');
            
            $dailyRevenue = Order::where('status', 'paid')
                ->whereDate('created_at', $date->toDateString())
                ->sum('total_price');
            
            $revenueChartData[] = $dailyRevenue;
        }

        // Payment Status Statistics
        $paymentStats = [
            'paid' => Order::where('status', 'paid')->count(),
            'pending' => Order::where('status', 'pending')->count(),
            'expired' => Order::where('status', 'expired')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalEvents',
            'activeEvents',
            'totalTickets',
            'totalCustomers',
            'revenueToday',
            'revenueMonth',
            'pendingPayment',
            'refundRequest',
            'withdrawalPending',
            'totalRevenue',
            'latestOrders',
            'topEvents',
            'upcomingEvents',
            'revenueChartLabels',
            'revenueChartData',
            'paymentStats'
        ));
    }

    /**
     * Profile Admin
     */
    public function profile()
    {
        return view('admin.profile');
    }
}
