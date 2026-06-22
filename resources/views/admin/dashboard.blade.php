@extends('layouts.admin-master')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang di RADJATIKET Master Admin Panel')

@section('content')

{{-- Statistics Cards Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    {{-- Total Event --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:shadow-lg hover:shadow-[#B22222]/10 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-[#B22222]/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-[#B22222]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-[#22C55E] bg-[#22C55E]/10 px-2 py-1 rounded-full">+12%</span>
        </div>
        <p class="text-[#A1A1AA] text-sm mb-1">Total Event</p>
        <p class="text-white text-3xl font-bold">{{ $totalEvents ?? 0 }}</p>
    </div>

    {{-- Event Aktif --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:shadow-lg hover:shadow-[#B22222]/10 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-[#22C55E]/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-[#22C55E]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-[#22C55E] bg-[#22C55E]/10 px-2 py-1 rounded-full">Active</span>
        </div>
        <p class="text-[#A1A1AA] text-sm mb-1">Event Aktif</p>
        <p class="text-white text-3xl font-bold">{{ $activeEvents ?? 0 }}</p>
    </div>

    {{-- Total Tiket Terjual --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:shadow-lg hover:shadow-[#B22222]/10 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-[#FFD700]/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-[#22C55E] bg-[#22C55E]/10 px-2 py-1 rounded-full">+24%</span>
        </div>
        <p class="text-[#A1A1AA] text-sm mb-1">Tiket Terjual</p>
        <p class="text-white text-3xl font-bold">{{ $totalTickets ?? 0 }}</p>
    </div>

    {{-- Total Customer --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:shadow-lg hover:shadow-[#B22222]/10 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-[#22C55E] bg-[#22C55E]/10 px-2 py-1 rounded-full">+8%</span>
        </div>
        <p class="text-[#A1A1AA] text-sm mb-1">Total Customer</p>
        <p class="text-white text-3xl font-bold">{{ $totalCustomers ?? 0 }}</p>
    </div>

</div>



{{-- Revenue Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    
    {{-- Revenue Hari Ini --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:shadow-lg hover:shadow-[#FFD700]/10 transition-all">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#FFD700] to-[#FFA500] flex items-center justify-center">
                <svg class="w-7 h-7 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-[#A1A1AA] text-sm mb-1">Revenue Hari Ini</p>
                <p class="text-white text-2xl font-bold">Rp {{ number_format($revenueToday ?? 0, 0, ',', '.') }}</p>
                <p class="text-xs text-[#22C55E] mt-1">+15% dari kemarin</p>
            </div>
        </div>
    </div>

    {{-- Revenue Bulan Ini --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:shadow-lg hover:shadow-[#FFD700]/10 transition-all">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#B22222] to-[#8B0000] flex items-center justify-center">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-[#A1A1AA] text-sm mb-1">Revenue Bulan Ini</p>
                <p class="text-white text-2xl font-bold">Rp {{ number_format($revenueMonth ?? 0, 0, ',', '.') }}</p>
                <p class="text-xs text-[#22C55E] mt-1">+32% dari bulan lalu</p>
            </div>
        </div>
    </div>

    {{-- Pending Payment --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6 hover:shadow-lg hover:shadow-[#F59E0B]/10 transition-all">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-xl bg-[#F59E0B]/10 flex items-center justify-center">
                <svg class="w-7 h-7 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-[#A1A1AA] text-sm mb-1">Pending Payment</p>
                <p class="text-white text-2xl font-bold">{{ $pendingPayment ?? 0 }}</p>
                <p class="text-xs text-[#F59E0B] mt-1">Menunggu konfirmasi</p>
            </div>
        </div>
    </div>

</div>

{{-- Charts Section --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    
    {{-- Revenue Chart 30 Days --}}
    <div class="lg:col-span-2 bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold text-white">Revenue Trend</h3>
                <p class="text-sm text-[#A1A1AA]">30 hari terakhir</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-[#A1A1AA]">Total:</span>
                <span class="text-lg font-bold text-[#FFD700]">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
        <canvas id="revenueChart" height="80"></canvas>
    </div>

    {{-- Payment Status Pie Chart --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <h3 class="text-lg font-bold text-white mb-6">Payment Status</h3>
        <canvas id="paymentStatusChart" height="200"></canvas>
        <div class="mt-6 space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#22C55E]"></div>
                    <span class="text-sm text-[#A1A1AA]">Paid</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $paymentStats['paid'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#F59E0B]"></div>
                    <span class="text-sm text-[#A1A1AA]">Pending</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $paymentStats['pending'] ?? 0 }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#EF4444]"></div>
                    <span class="text-sm text-[#A1A1AA]">Expired</span>
                </div>
                <span class="text-sm font-semibold text-white">{{ $paymentStats['expired'] ?? 0 }}</span>
            </div>
        </div>
    </div>

</div>

{{-- Top Events & Recent Transactions --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    
    {{-- Top Events --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-white">Top Events</h3>
            <a href="{{ route('admin.events.index') }}" class="text-sm text-[#B22222] hover:text-[#FFD700] transition-colors">View All →</a>
        </div>
        <div class="space-y-4">
            @forelse($topEvents ?? [] as $event)
                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-[#080808] transition-colors">
                    <div class="w-12 h-12 rounded-lg bg-[#242424] flex-shrink-0 overflow-hidden">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#A1A1AA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ $event->title }}</p>
                        <p class="text-xs text-[#A1A1AA]">{{ $event->date->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-[#FFD700]">{{ $event->total_sold ?? 0 }}</p>
                        <p class="text-xs text-[#A1A1AA]">sold</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-[#A1A1AA] mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-sm text-[#A1A1AA]">Belum ada event</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-white">Recent Transactions</h3>
            <a href="#" class="text-sm text-[#B22222] hover:text-[#FFD700] transition-colors">View All →</a>
        </div>
        <div class="space-y-4">
            @forelse($latestOrders ?? [] as $order)
                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-[#080808] transition-colors">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#B22222] to-[#8B0000] flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xs">{{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ $order->user->name ?? 'Guest' }}</p>
                        <p class="text-xs text-[#A1A1AA] truncate">{{ $order->event->title ?? 'N/A' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        @if($order->status === 'paid')
                            <span class="text-xs text-[#22C55E]">Paid</span>
                        @elseif($order->status === 'pending')
                            <span class="text-xs text-[#F59E0B]">Pending</span>
                        @else
                            <span class="text-xs text-[#EF4444]">{{ ucfirst($order->status) }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-[#A1A1AA] mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-sm text-[#A1A1AA]">Belum ada transaksi</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection

@push('scripts')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
// Revenue Chart 30 Days
const revenueCtx = document.getElementById('revenueChart');
if (revenueCtx) {
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: @json($revenueChartLabels ?? []),
            datasets: [{
                label: 'Revenue (Rp)',
                data: @json($revenueChartData ?? []),
                borderColor: '#B22222',
                backgroundColor: 'rgba(178, 34, 34, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#B22222',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#111111',
                    titleColor: '#fff',
                    bodyColor: '#A1A1AA',
                    borderColor: '#242424',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#242424',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#A1A1AA',
                        callback: function(value) {
                            return 'Rp ' + (value / 1000) + 'k';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#A1A1AA'
                    }
                }
            }
        }
    });
}

// Payment Status Pie Chart
const paymentCtx = document.getElementById('paymentStatusChart');
if (paymentCtx) {
    new Chart(paymentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Pending', 'Expired'],
            datasets: [{
                data: @json(array_values($paymentStats ?? ['paid' => 0, 'pending' => 0, 'expired' => 0])),
                backgroundColor: ['#22C55E', '#F59E0B', '#EF4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#111111',
                    titleColor: '#fff',
                    bodyColor: '#A1A1AA',
                    borderColor: '#242424',
                    borderWidth: 1,
                    padding: 12
                }
            }
        }
    });
}
</script>
@endpush
