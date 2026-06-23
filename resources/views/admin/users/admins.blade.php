@extends('layouts.admin-master')

@section('title', 'Manajemen Admin')

@section('content')
<div class="space-y-4">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-white">Manajemen Admin</h1>
            <p class="text-[#94A3B8] text-sm mt-0.5">Kelola akun administrator sistem</p>
        </div>
        <button onclick="openCreateModal()" class="px-4 py-2 bg-[#F5C518] text-black rounded-xl text-xs font-bold hover:bg-[#F5C518]/90 transition-all duration-300 flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Admin
        </button>
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

    @if(session('error'))
    <div class="bg-[#EF4444]/10 border border-[#EF4444]/30 rounded-xl p-3 flex items-center gap-2">
        <svg class="w-4 h-4 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="text-[#EF4444] text-xs">{{ session('error') }}</span>
    </div>
    @endif

    {{-- Search & Filter --}}
    <div class="bg-[#0B1220] border border-white/5 rounded-xl p-4">
        <form method="GET" action="{{ route('admin.users.admins') }}" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            {{-- Search --}}
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email admin..." class="w-full px-3 py-2 text-xs bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
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
                <a href="{{ route('admin.users.admins') }}" class="px-4 py-2 bg-white/5 text-white rounded-lg text-xs font-semibold hover:bg-white/10 transition-all duration-300">
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
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Terdaftar</th>
                        <th class="px-4 py-3 text-center text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-[#050B14] transition-all duration-300">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-[#F5C518] rounded-full flex items-center justify-center text-black text-xs font-bold">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-white font-semibold text-xs">{{ $admin->name }}</div>
                                    @if($admin->id === auth()->id())
                                    <span class="text-[10px] text-[#F5C518]">(Anda)</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-[#94A3B8] text-xs">{{ $admin->email }}</td>
                        <td class="px-4 py-3">
                            @if($admin->status === 'active')
                            <span class="px-2 py-0.5 bg-[#22C55E]/10 text-[#22C55E] rounded-full text-[10px] font-semibold">Active</span>
                            @else
                            <span class="px-2 py-0.5 bg-[#EF4444]/10 text-[#EF4444] rounded-full text-[10px] font-semibold">Suspended</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-[#94A3B8] text-xs">{{ $admin->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1.5">
                                <button onclick="openEditModal({{ $admin->id }}, '{{ $admin->name }}', '{{ $admin->email }}', '{{ $admin->status }}')" class="p-1.5 bg-[#F59E0B]/10 text-[#F59E0B] rounded-lg hover:bg-[#F59E0B]/20 transition-all duration-300" title="Edit">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                @if($admin->id !== auth()->id())
                                <form action="{{ route('admin.users.admins.destroy', $admin) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-[#EF4444]/10 text-[#EF4444] rounded-lg hover:bg-[#EF4444]/20 transition-all duration-300" title="Hapus">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-[#64748B]">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p class="text-xs">Tidak ada data admin</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($admins->hasPages())
    <div class="flex justify-center">
        {{ $admins->links() }}
    </div>
    @endif
</div>

{{-- Create Modal --}}
<div id="createModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-[#0B1220] border border-white/5 rounded-xl max-w-md w-full p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-white">Tambah Admin Baru</h3>
            <button onclick="closeCreateModal()" class="text-[#94A3B8] hover:text-white transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.users.admins.store') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Status</label>
                <select name="status" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white focus:outline-none focus:border-[#F5C518] transition-all duration-300">
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <div class="flex gap-2 pt-3">
                <button type="submit" class="flex-1 px-4 py-2 bg-[#F5C518] text-black text-xs rounded-lg font-bold hover:bg-[#F5C518]/90 transition-all duration-300">
                    Simpan
                </button>
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 bg-white/5 text-white text-xs rounded-lg font-semibold hover:bg-white/10 transition-all duration-300">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-[#0B1220] border border-white/5 rounded-xl max-w-md w-full p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-white">Edit Admin</h3>
            <button onclick="closeEditModal()" class="text-[#94A3B8] hover:text-white transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-3">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" id="edit_name" name="name" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Email</label>
                <input type="email" id="edit_email" name="email" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Password Baru (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white placeholder-[#64748B] focus:outline-none focus:border-[#F5C518] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-[10px] font-semibold mb-1.5 uppercase tracking-wider">Status</label>
                <select id="edit_status" name="status" required class="w-full px-3 py-2 text-sm bg-[#050B14] border border-white/5 rounded-lg text-white focus:outline-none focus:border-[#F5C518] transition-all duration-300">
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <div class="flex gap-2 pt-3">
                <button type="submit" class="flex-1 px-4 py-2 bg-[#F5C518] text-black text-xs rounded-lg font-bold hover:bg-[#F5C518]/90 transition-all duration-300">
                    Update
                </button>
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-white/5 text-white text-xs rounded-lg font-semibold hover:bg-white/10 transition-all duration-300">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
}

function openEditModal(id, name, email, status) {
    document.getElementById('editForm').action = `/admin/users/admins/${id}`;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_status').value = status;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection
