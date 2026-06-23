<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ═══════════════════════════════════════════════════════════════
    // ADMIN MANAGEMENT
    // ═══════════════════════════════════════════════════════════════
    
    /**
     * Display list of admin users
     */
    public function admins(Request $request)
    {
        $query = User::where('role', 'admin');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $admins = $query->latest()->paginate(15);

        return view('admin.users.admins', compact('admins'));
    }

    /**
     * Store new admin
     */
    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,suspended',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'status' => $validated['status'] ?? 'active',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.admins')
            ->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Update admin
     */
    public function updateAdmin(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:active,suspended',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $validated['status'],
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        return redirect()->route('admin.users.admins')
            ->with('success', 'Admin berhasil diupdate!');
    }

    /**
     * Delete admin
     */
    public function destroyAdmin(User $user)
    {
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('admin.users.admins')
            ->with('success', 'Admin berhasil dihapus!');
    }

    // ═══════════════════════════════════════════════════════════════
    // EVENT ORGANIZER MANAGEMENT
    // ═══════════════════════════════════════════════════════════════
    
    /**
     * Display list of event organizers
     */
    public function eventOrganizers(Request $request)
    {
        $query = User::where('role', 'event_organizer')
            ->withCount(['events'])
            ->withSum(['orders as total_revenue' => function($query) {
                $query->where('status', 'paid');
            }], 'total_price');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $eventOrganizers = $query->latest()->paginate(15);

        return view('admin.users.event-organizers', compact('eventOrganizers'));
    }

    /**
     * Approve Event Organizer
     */
    public function approveEO(User $user)
    {
        $user->update(['status' => 'active']);

        return back()->with('success', 'Event Organizer berhasil diapprove!');
    }

    /**
     * Suspend Event Organizer
     */
    public function suspendEO(User $user)
    {
        $user->update(['status' => 'suspended']);

        return back()->with('success', 'Event Organizer berhasil disuspend!');
    }

     /**
     * Reject Event Organizer
     */
    public function rejectEO(User $user)
    {
        $user->update(['status' => 'rejected']);

        return back()->with('success', 'Event Organizer berhasil direject!');
    }

    /**
     * Show edit form for Event Organizer
     */
    public function editEO(User $user)
    {
        // Make sure user is event organizer
        if ($user->role !== 'event_organizer') {
            abort(404);
        }

        return view('admin.users.event-organizer-edit', compact('user'));
    }

    /**
     * Update Event Organizer (including avatar upload)
     */
    public function updateEO(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'company_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|in:active,pending,suspended,rejected',
        ]);

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
                \Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar in storage/app/public/avatars/
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Update user
        $user->update($validated);

        return redirect()->route('admin.users.event-organizers')
            ->with('success', '✓ Event Organizer berhasil diupdate!');
    }

    // ═══════════════════════════════════════════════════════════════
    // CUSTOMER MANAGEMENT
    // ══════════════════════════════════════════════════════════════════════════════════════════════════════
    
    /**
     * Display list of customers
     */
    public function customers(Request $request)
    {
        $query = User::where('role', 'user')
            ->withCount(['orders'])
            ->withSum(['orders as total_spent' => function($query) {
                $query->where('status', 'paid');
            }], 'total_price')
            ->with(['orders' => function($query) {
                $query->where('status', 'paid')
                      ->latest()
                      ->limit(1);
            }]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $customers = $query->latest()->paginate(15);

        return view('admin.users.customers', compact('customers'));
    }

    /**
     * Show customer detail
     */
    public function showCustomer(User $user)
    {
        $user->load(['orders' => function($query) {
            $query->with('event')->latest();
        }]);

        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->where('status', 'paid')->sum('total_price');
        $lastPurchase = $user->orders()->where('status', 'paid')->latest()->first();

        return view('admin.users.customer-detail', compact('user', 'totalOrders', 'totalSpent', 'lastPurchase'));
    }

    /**
     * Suspend Customer
     */
    public function suspendCustomer(User $user)
    {
        $user->update(['status' => 'suspended']);

        return back()->with('success', 'Customer berhasil disuspend!');
    }

    /**
     * Activate Customer
     */
    public function activateCustomer(User $user)
    {
        $user->update(['status' => 'active']);

        return back()->with('success', 'Customer berhasil diaktifkan!');
    }
}
