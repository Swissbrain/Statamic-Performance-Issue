@props([
    'swiper_id' => null,
    'loop' => false,
    'autoplay' => 5000,
    'spaceBetween' => 0,
    'speed' => 300,
    'centeredSlides' => false,
    'allowTouchMove' => false,
    'effect' => 'fade',
    'maxItems' => 5,
    'navigation' => false,
    'pagination' => false,
    'paginationOverlapping' => false,
])

@php
    $id = \Illuminate\Support\Str::random(4);
@endphp

<div
    @if($swiper_id)
        id="{{ $swiper_id }}"
    @endif
    {{ $attributes->merge(['class' => 'group w-full']) }}>
    <div class="swiper slider-{{ $id }} w-full">
        <div class="swiper-wrapper h-full overflow-visible">
            {{ $slot }}
        </div>

        @if($navigation)
            <x-swiperjs.nav-link class="swiper-next-{{ $id }} top-1/2 right-3 "/>
            <x-swiperjs.nav-link class="swiper-prev-{{ $id }} top-1/2 left-3" direction="left"/>
        @endif

        @if($pagination)
            @if($paginationOverlapping)
                <div class="absolute !bottom-4 left-0 right-0 z-20 flex justify-center swiper-pagination-{{ $id }}"></div>
            @else
                <div class="flex justify-center my-3 swiper-pagination-{{ $id }}"></div>
            @endif
        @endif
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('load', function () {
            const slider_{{ $id }} = new Swiper(".slider-{{ $id }}", {
                loop: {{ $loop ? 'true' : 'false' }},
                {{ $autoplay ? "autoplay: { delay: $autoplay, disableOnInteraction: false }," : '' }}
                centeredSlides: {{ $centeredSlides ? 'true' : 'false' }},
                spaceBetween: {{ $spaceBetween }},
                speed: {{ $speed }},
                allowTouchMove: {{ $allowTouchMove ? 'true' : 'false' }},
                effect: '{{ $effect }}',
                slidesPerView: Math.max({{ $maxItems }} - 4, 1),
                @if($maxItems)
                    breakpoints: {
                        640: {
                            slidesPerView: Math.max({{ $maxItems }} - 3, 1),
                        },
                        768: {
                            slidesPerView: Math.max({{ $maxItems }} - 2, 1),
                        },
                        1024: {
                            slidesPerView: Math.max({{ $maxItems }} - 1, 1),
                        },
                        1200: {
                            slidesPerView: {{ $maxItems }},
                        },
                    },
                @endif
                @if($navigation)
                    navigation: {
                        nextEl: ".swiper-next-{{ $id }}",
                        prevEl: ".swiper-prev-{{ $id }}",
                    },
                @endif
                @if($pagination)
                    pagination: {
                        el: ".swiper-pagination-{{ $id }}",
                        type: 'bullets',
                        clickable: true,
                    },
                @endif
            });
        });
    </script>
@endpush
