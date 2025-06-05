@props([
    'aspectRatio' => 'one_to_one',
    'aspectRatioWidth' => 1,
    'aspectRatioHeight' => 1,
    'size' => 'limited',
    'imageSrc' => null,
    'textAlignment' => 'left',
    'textPosition' => 'top-left',
    'title' => null,
    'subtitle' => null,
    'href' => null,
    'isTargetBlank' => false,
    'buttonVariation' => 'filled',
    'buttonTitle' => null,
    'buttonLabel' => null,
    'overlayColor' => null,
    'overlayOpacity' => null,
])

@php
    $ratio = getAspectRatio(
        $aspectRatio,
        $aspectRatioWidth,
        $aspectRatioHeight
    );
    $imageWidth = 1216;
    $imageHeight = $imageWidth * $ratio;

    if ($overlayColor) {
        if ($overlayOpacity <= 0) {
            $overlayColor = null;
        } else {
            $overlayColor = hexColorWithAlpha($overlayColor, $overlayOpacity);
        }
    }

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
<div @class([
        'mx-auto w-full px-6 lg:px-8 relative bg-center bg-cover my-6',
        '[:where(&)]:max-w-7xl' => $size == 'limited',
    ])
        @style([
            "background-image: url('" . glide($imageSrc, $imageWidth, $imageHeight) .  "')" => $imageSrc,
            "background-image: url('" . imagePlaceholder($imageWidth, $imageHeight) .  "')" => ! $imageSrc,
            'width: ' . $imageWidth . 'px' => $size == 'limited',
            'height: ' . $imageHeight . 'px' => $size == 'limited',
            'max-width: 100%' => $size == 'limited',
            'height: ' . (1/$ratio * 100) . 'vw' => $size == 'full',
            'min-height: 300px;' => $size == 'full',
            'max-height: 500px;' => $size == 'full',
        ])
>
    @if($overlayColor)
        <div style="background-color: {{ $overlayColor }}" class="absolute inset-0"></div>
    @endif
    <div @class([
        $textPosition,
        'flex flex-col h-full space-y-6 p-12 z-10 relative' ,
        'mx-auto w-full [:where(&)]:max-w-7xl' => $size == 'full',
    ])>
        <div>
            @if($title)
                <div class="{{ $textAlignment }} text-white text-5xl">{{ $title }}</div>
            @endif

            @if($subtitle)
                <div class="{{ $textAlignment }} text-white text-xl">{{ $subtitle }}</div>
            @endif

            @if($href)
                <div class="">
                    <flux:button :href="$href"
                                 :target="$isTargetBlank"
                                 :variant="$buttonVariation"
                                 :title="$buttonTitle"
                    >
                        {{ $buttonLabel ? : 'Button' }}
                    </flux:button>
                </div>
            @endif
        </div>
    </div>
</div>