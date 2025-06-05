@props([
    'columns' => 2,
    'images' => [],
    'aspectRatio' => 'one_to_one',
    'aspectRatioWidth' => 1,
    'aspectRatioHeight' => 1,
])
<div class="flex gap-6 flex-wrap">
    @php
        $wrapperWidth = match($columns) {
            2 => 'lg:w-1/2-gap-6',
            3 => 'lg:w-1/3-gap-6',
            4 => 'lg:w-1/4-gap-6',
            5 => 'lg:w-1/5-gap-6',
            6 => 'lg:w-1/6-gap-6',
            7 => 'lg:w-1/7-gap-6',
            8 => 'lg:w-1/8-gap-6',
            9 => 'lg:w-1/9-gap-6',
            10 => 'lg:w-1/10-gap-6',
            11 => 'lg:w-1/11-gap-6',
            12 => 'lg:w-1/12-gap-6',
        };
    @endphp

    @foreach($images as $item)
        <x-div-or-link :as-link="(bool) $item->link_setting->linking_link->url()" :href="$item->link_setting->linking_link->url()" class="{{ $wrapperWidth }} w-full block">

            @php
                if ($aspectRatio == 'individual' && $item->image_setting->aspect_ratio->value() == 'custom') {
                    $aspectRatioWidth = $item->image_setting->width;
                    $aspectRatioHeight = $item->image_setting->height;
                }

                $overlayColor = $item->image_setting->use_color_overlay && $item->image_setting->color && $item->image_setting->opacity > 0
                    ? hexColorWithAlpha($item->image_setting->color, $item->image_setting->opacity)
                    : null;
                $variant = $item->title_setting->variant->value() ?: 'simple';
                $textPosition = match((string) $item->title_setting->text_position) {
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

                $textAlignment = match((string) $item->title_setting->text_alignment) {
                    'left' => 'text-start',
                    'center' => 'text-center',
                    'right' => 'text-end',
                    default => 'text-center'
                };
            @endphp

            <x-image :src="$item->image?->path()"
                     :aspect-ratio="$aspectRatio == 'individual' ? $item->image_setting->aspect_ratio->value() : $aspectRatio"
                     class="relative"
                     :aspect-ratio-width="$aspectRatioWidth"
                     :aspect-ratio-height="$aspectRatioHeight"
            >

                @if($item->title_setting->title || $item->title_setting->subtitle || $overlayColor)
                    <div class="absolute inset-0 p-[5vw] lg:px-10 lg:py-8 text-white tracking-wider z-10" @style(['background-color: ' . $overlayColor => $overlayColor])>
                        @if($variant == 'simple')
                            <div class="flex {{ $textPosition }} {{ $textAlignment }} h-full">
                                <div>
                                    @if($item->title_setting->title)
                                        <div @class([
                                                    'text-white text-[7vw] lg:text-2xl font-medium mb-1',
                                                    'text-center' => in_array($item->title_setting->text_alignment, ['top-center', 'center-center', 'bottom-center']),
                                                    'text-end' => in_array($item->title_setting->text_alignment, ['top-right', 'center-right', 'bottom-right']),
                                                ])>{{ $item->title_setting->title }}</div>
                                    @endif

                                    @if($item->title_setting->subtitle)
                                        <div @class([
                                                'text-[5vw] lg:text-base',
                                                'text-center' => in_array($item->title_setting->text_alignment, ['top-center', 'center-center', 'bottom-center']),
                                                'text-end' => in_array($item->title_setting->text_alignment, ['top-right', 'center-right', 'bottom-right']),
                                            ])>{{ $item->title_setting->subtitle }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($variant == 'lines')
                            @if($item->title_setting->title)
                                <div class="absolute inset-0 flex {{ $textPosition }} {{ $textAlignment }} transition-all lg:px-10 lg:py-8">
                                    <div class="border-t border-b border-white text-white py-2 px-4 lg:text-3xl">
                                        {{ $item->title_setting->title }}
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif
            </x-image>
        </x-div-or-link>
    @endforeach
</div>