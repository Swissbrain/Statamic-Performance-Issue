@props([
    'href' => null,
    'target' => null,
    'src' => null,
    'aspectRatio' => null,
    'aspectRatioWidth' => 1,
    'aspectRatioHeight' => 1,
    'width' => null,
    'title' => null,
    'subtitle' => null,
    'altText' => null,
    'overlayColor' => null,
    'overlayOpacity' => 0,
    'variant' => 'simple',
    'textAlignment' => 'center',
    'textPosition' => 'top-left',
])

@php
    $ratio = getAspectRatio($aspectRatio, $aspectRatioWidth, $aspectRatioHeight);
    $imageWidth = $width;
    $imageHeight = $imageWidth * (1/$ratio);

    if ($overlayColor) {
        if ($overlayOpacity <= 0) {
            $overlayColor = null;
        } else {
            $overlayColor = hexColorWithAlpha($overlayColor, $overlayOpacity);
        }
    }

@endphp

<x-div-or-link
        :as-link="(bool) $href"
        :href="$href"
        :target="$target"
        class="relative block"
>
    <x-image :aspect-ratio="$aspectRatio" :src="$src" :aspect-ratio-width="$aspectRatioWidth" :aspect-ratio-height="$aspectRatioHeight" />

    @if($title || $subtitle || $overlayColor)
        @php
            $textPosition = match($textPosition) {
                'top-left' => 'justify-start items-start',
                'top-center' => 'justify-center items-start',
                'top-right' => 'justify-end items-start',

                'center-left' => 'justify-start items-center',
                'center-center' => 'justify-center items-center',
                'center-right' => 'justify-end items-center',

                'bottom-left' => 'justify-start items-end',
                'bottom-center' => 'justify-center items-end',
                'bottom-right' => 'justify-end items-end',

                default => 'justify-start items-start',
            };

            $textAlignment = match($textAlignment) {
                'left' => 'text-start',
                'center' => 'text-center',
                'right' => 'text-end',
                default => 'text-center',
            };
        @endphp

        <div class="absolute inset-0 p-[5vw] lg:px-10 lg:py-8 text-white tracking-wider" @style(['background-color: ' . $overlayColor => $overlayColor])>
            @if($variant == 'simple')
                <div class="flex {{ $textPosition }} h-full">
                    <div class="{{ $textAlignment }}">
                        @if($title)
                            <div @class([
                                'text-white text-[7vw] lg:text-2xl font-medium mb-1',
                            ])>{{ $title }}</div>
                        @endif
                        @if($subtitle)
                            <div @class([
                                'text-[5vw] lg:text-base',
                            ])>{{ $subtitle }}</div>
                        @endif
                    </div>
                </div>
            @endif

            @if($variant == 'lines')
                @if($title)
                    <div class="absolute inset-0 flex {{  $textAlignment }} {{ $textPosition }} transition-all lg:px-10 lg:py-8">
                        <div class="border-t border-b border-white text-white py-2 px-4 lg:text-3xl">
                            {{ $title }}
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endif
</x-div-or-link>