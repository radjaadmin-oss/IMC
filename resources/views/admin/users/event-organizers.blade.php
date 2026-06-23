@extends('layouts.admin-master')

@section('title', 'Manajemen Event Organizer')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-white">Manajemen Event Organizer</h1>
            <p class="text-[#94A3B8] mt-1">Kelola akun event organizer dan approval</p>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="bg-[#22C55E]/10 border border-[#22C55E]/30 rounded-xl p-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        <span class="text-[#22C55E]">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-[#111111] border border-[#242424] rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-[#22C55E]/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-1">{{ \App\Models\User::where('role', 'event_organizer')->where('status', 'active')->count() }}</div>
            <div class="text-[#94A3B8] text-sm">EO Aktif</div>
        </div>

        <div class="bg-[#111111] border border-[#242424] rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-[#F59E0B]/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-1">{{ \App\Models\User::where('role', 'event_organizer')->where('status', 'pending')->count() }}</div>
            <div class="text-[#94A3B8] text-sm">Menunggu Approval</div>
        </div>

        <div class="bg-[#111111] border border-[#242424] rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-[#EF4444]/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-1">{{ \App\Models\User::where('role', 'event_organizer')->where('status', 'suspended')->count() }}</div>
            <div class="text-[#94A3B8] text-sm">Suspended</div>
        </div>

        <div class="bg-[#111111] border border-[#242424] rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-[#64748B]/10 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#64748B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
            </div>
            <div class="text-xl font-bold text-white mb-1">{{ \App\Models\User::where('role', 'event_organizer')->where('status', 'rejected')->count() }}</div>
            <div class="text-[#94A3B8] text-sm">Rejected</div>
        </div>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-[#111111] border border-[#242424] rounded-xl p-4">
        <form method="GET" action="{{ route('admin.users.event-organizers') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Search --}}
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau nama perusahaan..." class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            {{-- Status Filter --}}
            <div>
                <select name="status" class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white focus:outline-none focus:border-[#B22222] transition-all duration-300">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <div class="md:col-span-3 flex gap-3">
                <button type="submit" class="px-6 py-3 bg-[#B22222] text-white rounded-xl font-semibold hover:bg-[#8B1A1A] transition-all duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </button>
                @if(request('search') || request('status'))
                <a href="{{ route('admin.users.event-organizers') }}" class="px-6 py-3 bg-[#242424] text-white rounded-xl font-semibold hover:bg-[#333333] transition-all duration-300">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#0A0A0A] border-b border-[#242424]">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Event Organizer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Nama Perusahaan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Total Event</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Total Revenue</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#242424]">
                    @forelse($eventOrganizers as $eo)
                    <tr class="hover:bg-[#0A0A0A] transition-all duration-300">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#B22222] to-[#FFD700] rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($eo->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-white font-semibold">{{ $eo->name }}</div>
                                    <div class="text-xs text-[#94A3B8]">{{ $eo->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-[#94A3B8]">{{ $eo->company_name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span class="text-white font-semibold">{{ $eo->events_count }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-white font-semibold">Rp {{ number_format($eo->total_revenue ?? 0, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($eo->status === 'active')
                            <span class="px-3 py-1 bg-[#22C55E]/10 text-[#22C55E] rounded-full text-xs font-semibold">Active</span>
                            @elseif($eo->status === 'pending')
                            <span class="px-3 py-1 bg-[#F59E0B]/10 text-[#F59E0B] rounded-full text-xs font-semibold">Pending</span>
                            @elseif($eo->status === 'suspended')
                            <span class="px-3 py-1 bg-[#EF4444]/10 text-[#EF4444] rounded-full text-xs font-semibold">Suspended</span>
                            @else
                            <span class="px-3 py-1 bg-[#64748B]/10 text-[#64748B] rounded-full text-xs font-semibold">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                @if($eo->status === 'pending')
                                <form action="{{ route('admin.users.event-organizers.approve', $eo) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-[#22C55E]/10 text-[#22C55E] rounded-lg hover:bg-[#22C55E]/20 transition-all duration-300 text-sm font-semibold" title="Approve">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.event-organizers.reject', $eo) }}" method="POST" onsubmit="return confirm('Yakin ingin reject EO ini?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-[#EF4444]/10 text-[#EF4444] rounded-lg hover:bg-[#EF4444]/20 transition-all duration-300 text-sm font-semibold" title="Reject">
                                        Reject
                                    </button>
                                </form>
                                @elseif($eo->status === 'active')
                                <form action="{{ route('admin.users.event-organizers.suspend', $eo) }}" method="POST" onsubmit="return confirm('Yakin ingin suspend EO ini?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-[#F59E0B]/10 text-[#F59E0B] rounded-lg hover:bg-[#F59E0B]/20 transition-all duration-300 text-sm font-semibold" title="Suspend">
                                        Suspend
                                    </button>
                                </form>
                                @elseif($eo->status === 'suspended')
                                <form action="{{ route('admin.users.event-organizers.approve', $eo) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-[#22C55E]/10 text-[#22C55E] rounded-lg hover:bg-[#22C55E]/20 transition-all duration-300 text-sm font-semibold" title="Activate">
                                        Activate
                                    </button>
                                </form>
                                @endif
                                
                                <button onclick="openDetailModal({{ json_encode($eo) }})" class="p-2 bg-[#3B82F6]/10 text-[#3B82F6] rounded-lg hover:bg-[#3B82F6]/20 transition-all duration-300" title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-[#64748B]">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-16 h-16 text-[#242424]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p>Tidak ada data event organizer</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($eventOrganizers->hasPages())
    <div class="flex justify-center">
        {{ $eventOrganizers->links() }}
    </div>
    @endif
</div>

{{-- Detail Modal --}}
<div id="detailModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-[#111111] border border-[#242424] rounded-2xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Detail Event Organizer</h3>
            <button onclick="closeDetailModal()" class="text-[#94A3B8] hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="space-y-6">
            {{-- Profile Info --}}
            <div class="flex items-center gap-4 pb-6 border-b border-[#242424]">
                <div class="w-16 h-16 bg-gradient-to-br from-[#B22222] to-[#FFD700] rounded-full flex items-center justify-center text-white text-2xl font-bold" id="detail_avatar"></div>
                <div>
                    <div class="text-xl font-bold text-white" id="detail_name"></div>
                    <div class="text-[#94A3B8]" id="detail_email"></div>
                    <div class="mt-2" id="detail_status_badge"></div>
                </div>
            </div>

            {{-- Company Info --}}
            <div>
                <h4 class="text-sm font-semibold text-[#94A3B8] mb-3">Informasi Perusahaan</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#0A0A0A] rounded-xl p-4">
                        <div class="text-xs text-[#64748B] mb-1">Nama Perusahaan</div>
                        <div class="text-white font-semibold" id="detail_company"></div>
                    </div>
                    <div class="bg-[#0A0A0A] rounded-xl p-4">
                        <div class="text-xs text-[#64748B] mb-1">Nomor Telepon</div>
                        <div class="text-white font-semibold" id="detail_phone"></div>
                    </div>
                </div>
            </div>

            {{-- Statistics --}}
            <div>
                <h4 class="text-sm font-semibold text-[#94A3B8] mb-3">Statistik</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#0A0A0A] rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span class="text-xs text-[#64748B]">Total Event</span>
                        </div>
                        <div class="text-xl font-bold text-white" id="detail_events_count"></div>
                    </div>
                    <div class="bg-[#0A0A0A] rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs text-[#64748B]">Total Revenue</span>
                        </div>
                        <div class="text-2xl font-bold text-[#22C55E]" id="detail_revenue"></div>
                    </div>
                </div>
            </div>

            {{-- Bank Account --}}
            <div>
                <h4 class="text-sm font-semibold text-[#94A3B8] mb-3">Informasi Rekening Bank</h4>
                <div class="bg-[#0A0A0A] rounded-xl p-4 space-y-3">
                    <div>
                        <div class="text-xs text-[#64748B] mb-1">Nama Bank</div>
                        <div class="text-white font-semibold" id="detail_bank_name"></div>
                    </div>
                    <div>
                        <div class="text-xs text-[#64748B] mb-1">Nomor Rekening</div>
                        <div class="text-white font-semibold font-mono" id="detail_bank_account"></div>
                    </div>
                    <div>
                        <div class="text-xs text-[#64748B] mb-1">Atas Nama</div>
                        <div class="text-white font-semibold" id="detail_bank_holder"></div>
                    </div>
                </div>
            </div>

            {{-- Registration Date --}}
            <div class="bg-[#0A0A0A] rounded-xl p-4">
                <div class="text-xs text-[#64748B] mb-1">Terdaftar Sejak</div>
                <div class="text-white font-semibold" id="detail_created_at"></div>
            </div>
        </div>
    </div>
</div>

<script>
function openDetailModal(eo) {
    document.getElementById('detail_avatar').textContent = eo.name.charAt(0).toUpperCase();
    document.getElementById('detail_name').textContent = eo.name;
    document.getElementById('detail_email').textContent = eo.email;
    document.getElementById('detail_company').textContent = eo.company_name || '-';
    document.getElementById('detail_phone').textContent = eo.phone || '-';
    document.getElementById('detail_events_count').textContent = eo.events_count || 0;
    document.getElementById('detail_revenue').textContent = 'Rp ' + (eo.total_revenue || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    document.getElementById('detail_bank_name').textContent = eo.bank_name || '-';
    document.getElementById('detail_bank_account').textContent = eo.bank_account || '-';
    document.getElementById('detail_bank_holder').textContent = eo.bank_holder_name || '-';
    document.getElementById('detail_created_at').textContent = new Date(eo.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    
    // Status badge
    let statusBadge = '';
    if (eo.status === 'active') {
        statusBadge = '<span class="px-3 py-1 bg-[#22C55E]/10 text-[#22C55E] rounded-full text-xs font-semibold">Active</span>';
    } else if (eo.status === 'pending') {
        statusBadge = '<span class="px-3 py-1 bg-[#F59E0B]/10 text-[#F59E0B] rounded-full text-xs font-semibold">Pending</span>';
    } else if (eo.status === 'suspended') {
        statusBadge = '<span class="px-3 py-1 bg-[#EF4444]/10 text-[#EF4444] rounded-full text-xs font-semibold">Suspended</span>';
    } else {
        statusBadge = '<span class="px-3 py-1 bg-[#64748B]/10 text-[#64748B] rounded-full text-xs font-semibold">Rejected</span>';
    }
    document.getElementById('detail_status_badge').innerHTML = statusBadge;
    
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}
</script>
@endsection
