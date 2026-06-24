{{--
    RADJATIKET V2 - Image Upload Guide Component
    
    Displays upload guidelines and preview
    
    Usage:
    <x-image-upload-guide 
        size="1200 x 1600 px"
        ratio="3:4 (Portrait)"
        format="JPG, PNG"
        max-size="2 MB"
        tips="Use high-quality images, avoid pixelation"
        preview-id="event-image-preview"
    />
--}}

@props([
    'size' => '1200 x 1600 px',        // Recommended dimensions
    'ratio' => '3:4 (Portrait)',        // Aspect ratio
    'format' => 'JPG, PNG',             // Accepted formats
    'maxSize' => '2 MB',                // Maximum file size
    'tips' => null,                     // Optional tips
    'previewId' => 'image-preview',     // Preview element ID
])

<div {{ $attributes->merge(['class' => 'space-y-3']) }}>
    {{-- Upload Guidelines --}}
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="flex-1">
                <h4 class="text-sm font-semibold text-blue-900 mb-2">📷 Panduan Upload Gambar</h4>
                <ul class="text-xs text-blue-800 space-y-1">
                    <li class="flex items-start gap-2">
                        <span class="font-semibold min-w-[80px]">Ukuran:</span>
                        <span>{{ $size }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-semibold min-w-[80px]">Rasio:</span>
                        <span>{{ $ratio }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-semibold min-w-[80px]">Format:</span>
                        <span>{{ $format }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-semibold min-w-[80px]">Ukuran Max:</span>
                        <span>{{ $maxSize }}</span>
                    </li>
                </ul>
                @if($tips)
                    <p class="text-xs text-blue-700 mt-2">
                        💡 <strong>Tips:</strong> {{ $tips }}
                    </p>
                @endif
            </div>
        </div>
    </div>
    
    {{-- Image Preview --}}
    <div id="{{ $previewId }}-container" class="hidden">
        <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
        <div class="relative inline-block">
            <img id="{{ $previewId }}" 
                 src="" 
                 alt="Preview" 
                 class="rounded-lg border-2 border-gray-300 max-w-full h-auto max-h-64 object-contain">
            <button type="button" 
                    onclick="document.getElementById('{{ $previewId }}-container').classList.add('hidden'); document.getElementById('{{ $previewId }}').src = '';"
                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>

{{-- Preview JavaScript --}}
<script>
function previewImage(input, previewId = '{{ $previewId }}') {
    const file = input.files[0];
    const container = document.getElementById(previewId + '-container');
    const preview = document.getElementById(previewId);
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        container.classList.add('hidden');
    }
}
</script>
