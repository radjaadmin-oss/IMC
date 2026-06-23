@extends('layouts.admin-master')

@section('title', 'Edit Page')

@section('page-title', 'Edit Page: ' . $page->title)

@section('content')

{{-- HEADER --}}
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-white mb-1">✏️ Edit Page: {{ $page->title }}</h1>
        <p class="text-sm text-[#A1A1AA]">Update page content and settings</p>
    </div>
    <a href="{{ route('admin.pages.index') }}" 
       class="px-6 py-3 rounded-xl bg-[#111111] border border-[#242424] text-white font-semibold hover:bg-black transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>Back to Pages
    </a>
</div>

{{-- FORM --}}
<form action="{{ route('admin.pages.update', $page) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="space-y-4">

        {{-- BASIC INFO SECTION --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-white mb-1">▪ Basic Information</h3>
                <p class="text-sm text-[#A1A1AA]">Page title and URL slug</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Title --}}
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Page Title *</label>
                    <input type="text" 
                           name="title" 
                           id="title"
                           value="{{ old('title', $page->title) }}" 
                           required 
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518] @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Slug --}}
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">URL Slug *</label>
                    <input type="text" 
                           name="slug" 
                           id="slug"
                           value="{{ old('slug', $page->slug) }}" 
                           required
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518] @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-blue-400 mt-1">
                        Current URL: <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="underline hover:text-blue-300">{{ url('/page/' . $page->slug) }}</a>
                    </p>
                </div>
            </div>

            {{-- Slug Change Warning --}}
            <div class="mt-4 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <p class="text-sm text-yellow-400 font-medium">⚠️ Important Note:</p>
                        <p class="text-xs text-yellow-400/80 mt-1">
                            Changing the slug will change the page URL. Make sure to update any links that reference this page.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT SECTION --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-white mb-1">📝 Page Content</h3>
                <p class="text-sm text-[#A1A1AA]">Main content of your page (HTML supported)</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Content *</label>
                <textarea name="content" 
                          rows="12" 
                          required 
                          class="w-full bg-black border border-[#242424] rounded-xl px-4 py-3 text-sm text-white font-mono focus:outline-none focus:border-[#F5C518] @error('content') border-red-500 @enderror">{{ old('content', $page->content) }}</textarea>
                @error('content')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-[#71717A] mt-2">
                    💡 You can use HTML tags: <h2>, <h3>, &lt;p>, &lt;ul>, &lt;li>, &lt;strong>, &lt;a>, etc.
                </p>
            </div>
        </div>

        {{-- SEO & SETTINGS SECTION --}}
        <div class="bg-[#111111] border border-[#242424] rounded-2xl p-6">
            <div class="mb-6">
                <h3 class="text-lg font-bold text-white mb-1">🎯 SEO & Settings</h3>
                <p class="text-sm text-[#A1A1AA]">Meta description and display options</p>
            </div>
            
            <div class="space-y-4">
                {{-- Meta Description --}}
                <div>
                    <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Meta Description</label>
                    <input type="text" 
                           name="meta_description" 
                           value="{{ old('meta_description', $page->meta_description) }}" 
                           class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white placeholder-[#71717A] focus:outline-none focus:border-[#F5C518]"
                           placeholder="Brief description for SEO (recommended 150-160 characters)"
                           maxlength="255">
                    <p class="text-xs text-[#71717A] mt-1">This appears in search engine results</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Display Order --}}
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">
                            Display Order <span class="text-xs text-[#71717A]">(lower numbers appear first)</span>
                        </label>
                        <input type="number" 
                               name="order" 
                               value="{{ old('order', $page->order) }}" 
                               min="0"
                               class="w-full bg-black border border-[#242424] rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#F5C518]">
                    </div>

                    {{-- Publish Status --}}
                    <div>
                        <label class="block text-sm font-medium text-[#A1A1AA] mb-2">Status</label>
                        <label class="relative inline-flex items-center cursor-pointer mt-2">
                            <input type="checkbox" 
                                   name="is_published" 
                                   value="1"
                                   {{ old('is_published', $page->is_published) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="w-14 h-7 bg-[#242424] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#F5C518]"></div>
                            <span class="ms-3 text-sm font-medium text-white">Publish this page</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- SAVE BUTTON --}}
        <div class="flex items-center justify-end gap-3 sticky bottom-4 z-10">
            <a href="{{ route('admin.pages.index') }}" 
               class="px-6 py-3 rounded-xl bg-[#111111] border border-[#242424] text-white font-semibold hover:bg-black transition-colors">
                Cancel
            </a>
            <button type="submit" 
                    class="px-8 py-3 rounded-xl bg-gradient-to-r from-[#F5C518] to-[#D4A017] text-black font-bold hover:from-[#D4A017] hover:to-[#F5C518] transition-all shadow-lg hover:shadow-xl hover:shadow-[#F5C518]/20 hover:scale-105">
                <i class="fas fa-save mr-2"></i>Update Page
            </button>
        </div>

    </div>

</form>

@endsection
