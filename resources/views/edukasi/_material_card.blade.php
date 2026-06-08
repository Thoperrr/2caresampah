@php
    $isArticle = $material->type === 'article';
    $isVideo = $material->type === 'video';
@endphp

<article class="bg-white shadow-md rounded-lg overflow-hidden" data-searchable
    data-section="{{ $isArticle ? 'tips' : 'video' }}">

    {{-- Thumbnail Area --}}
    <div class="w-full h-64 flex items-center justify-center bg-gray-100">
        @if ($material->thumbnail)
            @if ($isVideo && $material->url)
                <a href="{{ $material->url }}" target="_blank" aria-label="Tonton video {{ $material->title }}">
                    <img src="{{ asset('storage/' . $material->thumbnail) }}" alt="{{ $material->title }}"
                        class="h-full w-auto object-contain" loading="lazy">
                </a>
            @else
                <img src="{{ asset('storage/' . $material->thumbnail) }}" alt="{{ $material->title }}"
                    class="h-full w-auto object-contain" loading="lazy">
            @endif
        @else
            <span class="text-gray-400 italic">No Image Available</span>
        @endif
    </div>

    {{-- Content Area --}}
    <div class="p-6">
        <h2 class="text-xl font-semibold mb-3 text-gray-900">{{ $material->title }}</h2>

        @if ($isArticle)
            <p class="mb-4 text-gray-700 text-justify">{!! nl2br(e($material->content)) !!}</p>
        @elseif ($isVideo)
            <p class="mb-4 text-gray-700 text-justify">
                {{ Str::limit(strip_tags($material->content), 500 , '...') }}
            </p>
        @endif

        {{-- Share Section --}}
        <div class="mt-4 flex items-center gap-3 flex-wrap">
            <span class="font-medium text-gray-800">Bagikan ke:</span>
            
            <a href="https://www.instagram.com/accounts/login/" target="_blank"
                class="text-pink-500 hover:text-pink-600 text-xl transition-colors duration-200" aria-label="Bagikan ke Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            
            <a href="https://www.tiktok.com/login" target="_blank"
                class="text-gray-800 hover:text-gray-600 text-xl transition-colors duration-200" aria-label="Bagikan ke TikTok">
                <i class="fab fa-tiktok"></i>
            </a>

            @if ($isVideo && $material->url)
                <button onclick="copyYoutubeUrl('{{ $material->url }}')"
                    class="text-red-600 hover:text-red-700 text-xl transition-colors duration-200 focus:outline-none"
                    title="Salin link YouTube" aria-label="Salin link YouTube">
                    <i class="fas fa-copy"></i>
                </button>
            @endif
        </div>
    </div>
</article>
