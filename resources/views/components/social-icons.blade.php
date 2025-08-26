@php
    $activeLinks = get_active_social_links();
@endphp

@if(!empty($activeLinks))
    <div class="{{ $containerClass }}">
        @foreach($activeLinks as $platform => $link)
            <a href="{{ $link['url'] }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="text-decoration-none {{ $size }} {{ $platform }}" 
               title="{{ $link['label'] }}" 
               aria-label="{{ $link['label'] }}">
                <i class="bi {{ $link['icon'] }}"></i>
                @if($showLabels)
                    <span class="ms-1">{{ $link['label'] }}</span>
                @endif
            </a>
        @endforeach
    </div>
@else
    <!-- Default Social Icons if no settings found -->
    <div class="{{ $containerClass }}">
        <a href="#" class="text-decoration-none {{ $size }} facebook" title="فيسبوك" aria-label="فيسبوك">
            <i class="bi bi-facebook"></i>
        </a>
        <a href="#" class="text-decoration-none {{ $size }} twitter" title="تويتر" aria-label="تويتر">
            <i class="bi bi-twitter-x"></i>
        </a>
        <a href="#" class="text-decoration-none {{ $size }} instagram" title="انستغرام" aria-label="انستغرام">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="#" class="text-decoration-none {{ $size }} youtube" title="يوتيوب" aria-label="يوتيوب">
            <i class="bi bi-youtube"></i>
        </a>
        <a href="#" class="text-decoration-none {{ $size }} whatsapp" title="واتساب" aria-label="واتساب">
            <i class="bi bi-whatsapp"></i>
        </a>
        <a href="#" class="text-decoration-none {{ $size }} telegram" title="تليجرام" aria-label="تليجرام">
            <i class="bi bi-telegram"></i>
        </a>
    </div>
@endif