@props([
    'src' => null,
    'aspectRatio' => null,
    'width' => null,
    'aspectRatioWidth' => 1,
    'aspectRatioHeight' => 1,
    'height' => 'fixed',
])

@php
$aspectRatioWidth = $aspectRatioWidth > 0 ? (int) $aspectRatioWidth : 1;
$aspectRatioHeight = $aspectRatioHeight > 0 ? (int) $aspectRatioHeight : 1;
$ratio = getAspectRatio($aspectRatio, $aspectRatioWidth, $aspectRatioHeight);
$aspectRatioLabel = match($aspectRatio) {
    'one_to_one' => 'aspect-[1/1]',
    'two_to_one' => 'aspect-[2/1]',
    'three_to_one' => 'aspect-[3/1]',
    'four_to_one' => 'aspect-[4/1]',
    'custom' => 'custom',
    default => 'aspect-[1/1]',
};

//$imageWidth = (int) $width > 0 ? $width : 1920;

$imageWidth = match($width) {
    'full' => 1920,
    null => 1216,
    default => (int) $width >= 50 ? (int) $width : 50,
};

$imageHeight = $imageWidth * $ratio;
$imageSrc = $src
    ? glide($src, $imageWidth, $imageHeight)
    : imagePlaceholder($imageWidth, $imageHeight);

@endphp
<div
     @class([
        $attributes->has('class') ? $attributes->get('class') : null,
        $aspectRatioLabel => $height != 'auto',
        'bg-center bg-cover',
        'w-full' => !$width
    ])
     @style([
        "background-image: url('" . $imageSrc . "')",
        'aspect-ratio: ' . $aspectRatioWidth . '/' . $aspectRatioHeight => $aspectRatioLabel == 'custom',
    ])
>
    {{ $slot }}
</div>