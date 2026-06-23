@extends('layouts.admin-master')

@section('title', 'Manajemen Customer')

@section('content')
<div class="space-y-4">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-white">Manajemen Customer</h1>
            <p class="text-[#94A3B8] text-sm mt-0.5">Kelola data customer dan riwayat pembelian</p>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="bg-[#22C55E]/10 border border-[#22C55E]/30 rounded-xl p-3 flex items-center gap-2">
        <svg class="w-4 h-4 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span class="text-[#22C55E] text-xs">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#3B82F6]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\User::where('role', 'user')->count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Total Customer</div>
        </div>

        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#22C55E]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\User::where('role', 'user')->where('status', 'active')->count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Customer Aktif</div>
        </div>

        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#FFD700]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\Order::where('status', 'paid')->count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Total Pembelian</div>
        </div>

        <div class="bg-[#0B1220] border border-white/5 rounded-xl p-3.5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-8 h-8 bg-[#EF4444]/10 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-0.5">{{ \App\Models\User::where('role', 'user')->where('status', 'suspended')->count() }}</div>
            <div class="text-[#94A3B8] text-[10px]">Suspended</div>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-[#0B1220] border border-white/5 rounded-xl p-4">
        <form method="GET" action="{{ route('admin.users.customers') }}" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            {{-- Search --}}
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau nomor telepon..." class="w-full px-3 py-2 text-xs bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            {{-- Status Filter --}}
            <div>
                <select name="status" class="w-full px-3 py-2 text-xs bg-[#050B14] border border-white/5 rounded-lg text-white focus:outline-none focus:border-[#F5C518] transition-all duration-300">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <div class="md:col-span-3 flex gap-2">
                <button type="submit" class="px-4 py-2 bg-[#F5C518] text-black rounded-lg text-xs font-bold hover:bg-[#F5C518]/90 transition-all duration-300 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                @if(request('search') || request('status'))
                <a href="{{ route('admin.users.customers') }}" class="px-4 py-2 bg-white/5 text-white rounded-lg text-xs font-semibold hover:bg-white/10 transition-all duration-300">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-[#0B1220] border border-white/5 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#050B14] border-b border-white/5">
                    <tr>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Customer</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Nomor Telepon</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Total Order</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Total Spending</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Pembelian Terakhir</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-center text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-[#050B14] transition-all duration-300">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-gradient-to-br from-[#3B82F6] to-[#8B5CF6] rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-white font-semibold text-xs">{{ $customer->name }}</div>
                                    <div class="text-[10px] text-[#94A3B8]">{{ $customer->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-[#94A3B8] text-xs">{{ $customer->phone ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <span class="text-white font-semibold text-xs">{{ $customer->orders_count }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-[#22C55E] font-semibold text-xs">Rp {{ number_format($customer->total_spent ?? 0, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-4 py-3 text-[#94A3B8] text-xs">
                            @if($customer->orders->first())
                                {{ $customer->orders->first()->created_at->format('d M Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($customer->status === 'active')
                            <span class="px-2 py-0.5 bg-[#22C55E]/10 text-[#22C55E] rounded-full text-[10px] font-semibold">Active</span>
                            @else
                            <span class="px-2 py-0.5 bg-[#EF4444]/10 text-[#EF4444] rounded-full text-[10px] font-semibold">Suspended</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1.5">
                                <button onclick="openDetailModal({{ json_encode($customer) }})" class="p-1.5 bg-[#3B82F6]/10 text-[#3B82F6] rounded-lg hover:bg-[#3B82F6]/20 transition-all duration-300" title="Detail">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                
                                @if($customer->status === 'active')
                                <form action="{{ route('admin.users.customers.suspend', $customer) }}" method="POST" onsubmit="return confirm('Yakin ingin suspend customer ini?')">
                                    @csrf
                                    <button type="submit" class="p-1.5 bg-[#EF4444]/10 text-[#EF4444] rounded-lg hover:bg-[#EF4444]/20 transition-all duration-300" title="Suspend">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.users.customers.activate', $customer) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-1.5 bg-[#22C55E]/10 text-[#22C55E] rounded-lg hover:bg-[#22C55E]/20 transition-all duration-300" title="Activate">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-[#64748B]">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p class="text-xs">Tidak ada data customer</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($customers->hasPages())
    <div class="flex justify-center">
        {{ $customers->links() }}
    </div>
    @endif
</div>

{{-- Detail Modal --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-[#0B1220] border border-white/5 rounded-xl max-w-3xl w-full p-5 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-white">Detail Customer</h3>
            <button onclick="closeDetailModal()" class="text-[#94A3B8] hover:text-white transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="space-y-4">
            {{-- Profile Info --}}
            <div class="flex items-center gap-3 pb-4 border-b border-white/5">
                <div class="w-12 h-12 bg-gradient-to-br from-[#3B82F6] to-[#8B5CF6] rounded-full flex items-center justify-center text-white text-lg font-bold" id="detail_avatar"></div>
                <div>
                    <div class="text-base font-bold text-white" id="detail_name"></div>
                    <div class="text-[#94A3B8] text-xs" id="detail_email"></div>
                    <div class="text-[#64748B] text-[10px] mt-0.5" id="detail_phone"></div>
                    <div class="mt-1.5" id="detail_status_badge"></div>
                </div>
            </div>

            {{-- Statistics --}}
            <div>
                <h4 class="text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Statistik Pembelian</h4>
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-[#050B14] rounded-lg p-3">
                        <div class="flex items-center gap-1.5 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span class="text-[10px] text-[#64748B]">Total Order</span>
                        </div>
                        <div class="text-base font-bold text-white" id="detail_orders_count"></div>
                    </div>
                    <div class="bg-[#050B14] rounded-lg p-3">
                        <div class="flex items-center gap-1.5 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-[10px] text-[#64748B]">Total Spending</span>
                        </div>
                        <div class="text-xs font-bold text-[#22C55E]" id="detail_total_spent"></div>
                    </div>
                    <div class="bg-[#050B14] rounded-lg p-3">
                        <div class="flex items-center gap-1.5 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-[#3B82F6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-[10px] text-[#64748B]">Terakhir</span>
                        </div>
                        <div class="text-[10px] font-bold text-white" id="detail_last_purchase"></div>
                    </div>
                </div>
            </div>

            {{-- Order History --}}
            <div>
                <h4 class="text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider mb-2">Riwayat Pembelian</h4>
                <div class="bg-[#050B14] rounded-lg overflow-hidden">
                    <div id="order_history" class="divide-y divide-white/5">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            {{-- Registration Date --}}
            <div class="bg-[#050B14] rounded-lg p-3">
                <div class="text-[10px] text-[#64748B] mb-0.5">Terdaftar Sejak</div>
                <div class="text-white font-semibold text-xs" id="detail_created_at"></div>
            </div>
        </div>
    </div>
</div>

<script>
function openDetailModal(customer) {
    document.getElementById('detail_avatar').textContent = customer.name.charAt(0).toUpperCase();
    document.getElementById('detail_name').textContent = customer.name;
    document.getElementById('detail_email').textContent = customer.email;
    document.getElementById('detail_phone').textContent = customer.phone || '-';
    document.getElementById('detail_orders_count').textContent = customer.orders_count || 0;
    document.getElementById('detail_total_spent').textContent = 'Rp ' + (customer.total_spent || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
    // Last purchase date
    if (customer.orders && customer.orders.length > 0) {
        const lastOrder = customer.orders[0];
        document.getElementById('detail_last_purchase').textContent = new Date(lastOrder.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    } else {
        document.getElementById('detail_last_purchase').textContent = '-';
    }
    
    document.getElementById('detail_created_at').textContent = new Date(customer.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    
    // Status badge
    let statusBadge = '';
    if (customer.status === 'active') {
        statusBadge = '<span class="px-2 py-0.5 bg-[#22C55E]/10 text-[#22C55E] rounded-full text-[10px] font-semibold">Active</span>';
    } else {
        statusBadge = '<span class="px-2 py-0.5 bg-[#EF4444]/10 text-[#EF4444] rounded-full text-[10px] font-semibold">Suspended</span>';
    }
    document.getElementById('detail_status_badge').innerHTML = statusBadge;
    
    // Order history
    let orderHistoryHTML = '';
    if (customer.orders && customer.orders.length > 0) {
        customer.orders.slice(0, 5).forEach(order => {
            let statusColor = '';
            let statusText = '';
            if (order.status === 'paid') {
                statusColor = '#22C55E';
                statusText = 'Paid';
            } else if (order.status === 'pending') {
                statusColor = '#F59E0B';
                statusText = 'Pending';
            } else {
                statusColor = '#EF4444';
                statusText = 'Expired';
            }
            
            orderHistoryHTML += `
                <div class="p-3 hover:bg-[#0B1220] transition-all duration-300">
                    <div class="flex items-center justify-between mb-1.5">
                        <div class="font-semibold text-white text-xs">${order.event ? order.event.name : 'Event'}</div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold" style="background-color: ${statusColor}20; color: ${statusColor}">${statusText}</span>
                    </div>
                    <div class="flex items-center justify-between text-[10px]">
                        <span class="text-[#64748B]">${new Date(order.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</span>
                        <span class="text-[#22C55E] font-semibold">Rp ${(order.total_price || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</span>
                    </div>
                </div>
            `;
        });
    } else {
        orderHistoryHTML = '<div class="p-6 text-center text-[#64748B] text-xs">Belum ada riwayat pembelian</div>';
    }
    document.getElementById('order_history').innerHTML = orderHistoryHTML;
    
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}
</script>
@endsection
