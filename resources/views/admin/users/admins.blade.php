@extends('layouts.admin-master')

@section('title', 'Manajemen Admin')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Manajemen Admin</h1>
            <p class="text-[#94A3B8] mt-1">Kelola akun administrator sistem</p>
        </div>
        <button onclick="openCreateModal()" class="px-6 py-3 bg-[#B22222] text-white rounded-xl font-semibold hover:bg-[#8B1A1A] transition-all duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Admin
        </button>
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

    @if(session('error'))
    <div class="bg-[#EF4444]/10 border border-[#EF4444]/30 rounded-xl p-4 flex items-center gap-3">
        <svg class="w-5 h-5 text-[#EF4444]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="text-[#EF4444]">{{ session('error') }}</span>
    </div>
    @endif

    {{-- Search & Filter --}}
    <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
        <form method="GET" action="{{ route('admin.users.admins') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Search --}}
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email admin..." class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            {{-- Status Filter --}}
            <div>
                <select name="status" class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white focus:outline-none focus:border-[#B22222] transition-all duration-300">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
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
                <a href="{{ route('admin.users.admins') }}" class="px-6 py-3 bg-[#242424] text-white rounded-xl font-semibold hover:bg-[#333333] transition-all duration-300">
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
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Terdaftar</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#242424]">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-[#0A0A0A] transition-all duration-300">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-[#B22222] rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-white font-semibold">{{ $admin->name }}</div>
                                    @if($admin->id === auth()->id())
                                    <span class="text-xs text-[#FFD700]">(Anda)</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-[#94A3B8]">{{ $admin->email }}</td>
                        <td class="px-6 py-4">
                            @if($admin->status === 'active')
                            <span class="px-3 py-1 bg-[#22C55E]/10 text-[#22C55E] rounded-full text-xs font-semibold">Active</span>
                            @else
                            <span class="px-3 py-1 bg-[#EF4444]/10 text-[#EF4444] rounded-full text-xs font-semibold">Suspended</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-[#94A3B8]">{{ $admin->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openEditModal({{ $admin->id }}, '{{ $admin->name }}', '{{ $admin->email }}', '{{ $admin->status }}')" class="p-2 bg-[#F59E0B]/10 text-[#F59E0B] rounded-lg hover:bg-[#F59E0B]/20 transition-all duration-300" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                @if($admin->id !== auth()->id())
                                <form action="{{ route('admin.users.admins.destroy', $admin) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-[#EF4444]/10 text-[#EF4444] rounded-lg hover:bg-[#EF4444]/20 transition-all duration-300" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <td colspan="5" class="px-6 py-12 text-center text-[#64748B]">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-16 h-16 text-[#242424]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                <p>Tidak ada data admin</p>
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
    <div class="bg-[#111111] border border-[#242424] rounded-2xl max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Tambah Admin Baru</h3>
            <button onclick="closeCreateModal()" class="text-[#94A3B8] hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.users.admins.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Status</label>
                <select name="status" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white focus:outline-none focus:border-[#B22222] transition-all duration-300">
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-[#B22222] text-white rounded-xl font-semibold hover:bg-[#8B1A1A] transition-all duration-300">
                    Simpan
                </button>
                <button type="button" onclick="closeCreateModal()" class="px-6 py-3 bg-[#242424] text-white rounded-xl font-semibold hover:bg-[#333333] transition-all duration-300">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-[#111111] border border-[#242424] rounded-2xl max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Edit Admin</h3>
            <button onclick="closeEditModal()" class="text-[#94A3B8] hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="edit_name" name="name" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Email</label>
                <input type="email" id="edit_email" name="email" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Password Baru (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white placeholder-[#64748B] focus:outline-none focus:border-[#B22222] transition-all duration-300">
            </div>

            <div>
                <label class="block text-[#94A3B8] text-sm font-semibold mb-2">Status</label>
                <select id="edit_status" name="status" required class="w-full px-4 py-3 bg-[#000000] border border-[#242424] rounded-xl text-white focus:outline-none focus:border-[#B22222] transition-all duration-300">
                    <option value="active">Active</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-[#B22222] text-white rounded-xl font-semibold hover:bg-[#8B1A1A] transition-all duration-300">
                    Update
                </button>
                <button type="button" onclick="closeEditModal()" class="px-6 py-3 bg-[#242424] text-white rounded-xl font-semibold hover:bg-[#333333] transition-all duration-300">
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
