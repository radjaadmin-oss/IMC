@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900">
    
    {{-- Breadcrumb --}}
    <div class="bg-[#111111] border-b border-[#242424]">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-[#A1A1AA] hover:text-white transition">
                    <i class="fas fa-home"></i> Home
                </a>
                <span class="text-[#242424]">/</span>
                <span class="text-white font-medium">{{ $page->title }}</span>
            </nav>
        </div>
    </div>

    {{-- Page Content --}}
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            
            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    {{ $page->title }}
                </h1>
                <div class="flex items-center text-sm text-[#A1A1AA]">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>Last updated: {{ $page->updated_at->format('F d, Y') }}</span>
                </div>
            </div>

            {{-- Page Content --}}
            <div class="bg-[#111111] border border-[#242424] rounded-2xl p-8 md:p-12">
                <div class="prose prose-lg prose-invert max-w-none">
                    {!! $page->content !!}
                </div>
            </div>

            {{-- Back to Home Button --}}
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center text-[#F5C518] hover:text-[#D4A017] font-medium transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom prose styles for content formatting */
    .prose-invert {
        color: #e5e7eb;
        line-height: 1.75;
    }
    
    .prose-invert h1, 
    .prose-invert h2, 
    .prose-invert h3, 
    .prose-invert h4 {
        color: #ffffff;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .prose-invert h1 { font-size: 2.25rem; }
    .prose-invert h2 { font-size: 1.875rem; color: #F5C518; }
    .prose-invert h3 { font-size: 1.5rem; }
    .prose-invert h4 { font-size: 1.25rem; }
    
    .prose-invert p {
        margin-bottom: 1.25rem;
        color: #d1d5db;
    }
    
    .prose-invert a {
        color: #3b82f6;
        text-decoration: underline;
    }
    
    .prose-invert a:hover {
        color: #2563eb;
    }
    
    .prose-invert ul, 
    .prose-invert ol {
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    
    .prose-invert ul {
        list-style-type: disc;
    }
    
    .prose-invert ol {
        list-style-type: decimal;
    }
    
    .prose-invert li {
        margin-bottom: 0.5rem;
        color: #d1d5db;
    }
    
    .prose-invert strong {
        font-weight: 600;
        color: #ffffff;
    }
    
    .prose-invert em {
        font-style: italic;
    }
    
    .prose-invert blockquote {
        border-left: 4px solid #F5C518;
        padding-left: 1rem;
        margin-left: 0;
        font-style: italic;
        color: #9ca3af;
    }
    
    .prose-invert code {
        background-color: #1f2937;
        color: #F5C518;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        font-family: 'Courier New', monospace;
    }
    
    .prose-invert pre {
        background-color: #1f2937;
        color: #f9fafb;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin-bottom: 1.25rem;
    }
    
    .prose-invert pre code {
        background-color: transparent;
        padding: 0;
        color: inherit;
    }
    
    .prose-invert img {
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
    
    .prose-invert table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.25rem;
    }
    
    .prose-invert th, 
    .prose-invert td {
        border: 1px solid #374151;
        padding: 0.75rem;
        text-align: left;
    }
    
    .prose-invert th {
        background-color: #1f2937;
        font-weight: 600;
        color: #F5C518;
    }
    
    .prose-invert hr {
        border: none;
        border-top: 1px solid #374151;
        margin: 2rem 0;
    }
</style>
@endsection
