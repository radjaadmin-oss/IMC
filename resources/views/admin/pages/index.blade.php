@extends('layouts.admin-master')

@section('title', 'Manage Pages')

@section('page-title', 'Manage Pages')

@section('content')

{{-- SUCCESS ALERT --}}
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
     class="mb-6 bg-green-500/10 border border-green-500/30 rounded-xl p-4 flex items-start gap-3">
    <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div class="flex-1">
        <p class="text-sm text-green-400 font-medium">{{ session('success') }}</p>
    </div>
    <button @click="show = false" class="text-green-400/60 hover:text-green-400">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>
</div>
@endif

{{-- HEADER --}}
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">📄 Static Pages</h1>
        <p class="text-sm text-[#A1A1AA]">Manage static pages (About, Privacy, Terms, etc.)</p>
    </div>
    <a href="{{ route('admin.pages.create') }}" 
       class="px-6 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold hover:from-[#D4A017] hover:to-[#F5C518] transition-all shadow-lg hover:shadow-xl hover:shadow-[#F5C518]/20 hover:scale-105">
        <i class="fas fa-plus mr-2"></i>Create New Page
    </a>
</div>

{{-- TABLE --}}
<div class="bg-[#111111] border border-[#242424] rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-[#242424]">
            <thead class="bg-black">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#F5C518] uppercase tracking-wider">#</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#F5C518] uppercase tracking-wider">Title</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#F5C518] uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#F5C518] uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#F5C518] uppercase tracking-wider">Updated</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-[#F5C518] uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#242424]">
                @forelse($pages as $page)
                    <tr class="hover:bg-black/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#A1A1AA]">
                            {{ $page->order }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-white">{{ $page->title }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('page.show', $page->slug) }}" 
                               target="_blank" 
                               class="text-sm text-blue-400 hover:text-blue-300 transition">
                                /page/{{ $page->slug }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($page->is_published)
                                <span class="px-2.5 py-1 inline-flex text-xs font-semibold rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">
                                    <i class="fas fa-check-circle mr-1"></i> Published
                                </span>
                            @else
                                <span class="px-2.5 py-1 inline-flex text-xs font-semibold rounded-lg bg-gray-500/10 text-gray-400 border border-gray-500/20">
                                    <i class="fas fa-circle mr-1"></i> Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#A1A1AA]">
                            {{ $page->updated_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.pages.edit', $page) }}" 
                               class="text-blue-400 hover:text-blue-300 mr-4 transition">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" 
                                  method="POST" 
                                  class="inline-block" 
                                  onsubmit="return confirm('Are you sure you want to delete this page?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-[#242424] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-[#A1A1AA] mb-4">No pages found</p>
                                <a href="{{ route('admin.pages.create') }}" 
                                   class="px-4 py-2 rounded-lg bg-[#F5C518] text-black font-semibold hover:bg-[#D4A017] transition">
                                    Create your first page
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- PAGINATION --}}
@if($pages->hasPages())
<div class="mt-6">
    {{ $pages->links() }}
</div>
@endif

@endsection
