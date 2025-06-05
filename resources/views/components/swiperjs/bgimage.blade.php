@props([
    'src' => '',
    'width' => 800,
    'height' => 600,
    'crop' => null,
])

<div {{ $attributes->merge(['class' => 'swiper-slide']) }}>
    <div class="absolute w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('{{ glide($src, $width, $height, $crop) }}');"></div>
</div>
