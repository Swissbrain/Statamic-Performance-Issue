<x-section :block="$block" :show-border="$page->show_space_bordering">
    <x-swiperjs.swiper
            class="w-full"
            :swiper_id="uniqid('image-slider')"
            :loop="true"
            :speed="300"
            :autoplay="5000"
            :allow-touch-move="true"
            effect="slide"
            max-items="1"
            :pagination="$show_pagination->value()"
            :navigation="$show_navigation->value()"
            :pagination-overlapping="true"
    >
        @if($entry_type->value() == 'only_images')
            @foreach($images->value()->get() as $image)
                <x-swiperjs.slide>
                    <x-image :src="$image->path()"
                             :class="$animate_images->value() ? 'animate-zoom' : ''"
                             :aspect-ratio="(string) $aspect_ratio->value()"
                             :width="$center_slider->value() ? 'full' : null"
                    />
                </x-swiperjs.slide>
            @endforeach
        @endif

        @if ($entry_type->value() == 'image_with_link')
            @foreach($slides as $slide)
                    @php
                        $overlayColor = $slide->image_color_overlay['use_color_overlay'] && $slide->image_color_overlay['color'] && $slide->image_color_overlay['opacity'] > 0
                            ? hexColorWithAlpha($slide->image_color_overlay['color'], $slide->image_color_overlay['opacity'])
                            : null;
                    @endphp
                <x-swiperjs.slide class="max-w-full">

                    <x-image @class([
                                'flex items-center relative',
                                'animate-zoom' => $animate_images->value(),
                             ])
                             :src="$slide->image?->path()"
                             :aspect-ratio="(string) $aspect_ratio->value()"
                             :width="$center_slider->value() ? null : 'full'">

                        @if($overlayColor)
                            <div style="background-color: {{ $overlayColor }}" class="absolute inset-0"></div>
                        @endif
                        <flux:container class="{{ $center_slider->value() ? 'lg:!px-36' : '' }} !px-12 relative z-10 {{ $slide->direction == 'center' ? 'text-center' : '' }} {{ $slide->direction == 'right' ? 'text-right' : '' }}">
                            @if($slide->entry_subtitle)
                                <div class="text-xl md:text-2xl xl:text-3xl mb-3" style="color: {{ $slide->font_color }}">{{ str_replace("\n", '<br>', e($slide->entry_subtitle)) }}</div>
                            @endif

                            @if($slide->entry_title)
                                <h2 class="text-2xl md:text-4xl xl:text-6xl font-semibold mb-6 xl:mb-12 leading-snug" style="color: {{ $slide->font_color }}">{!! str_replace("\n", '<br>', e($slide->entry_title)) !!}</h2>
                            @endif

                            @if($slide->linking['title'] || $slide->linking['link'])
                                <flux:button variant="{{ in_array($slide->linking['variant'], ['primary', 'secondary', 'filled-solid', 'outline', 'active']) ? $slide->linking['variant'] : 'primary' }}"
                                             class="min-w-[200px]"
                                             :href="$slide->linking['link']"
                                             :target="$slide->linking['target_blank'] ? '_blank' : ''"
                                             :title="$slide->linking['title']"
                                >
                                    {{ $slide->linking['link_text'] }}
                                </flux:button>
                            @endif
                        </flux:container>
                    </x-image>
                </x-swiperjs.slide>
            @endforeach
        @endif
    </x-swiperjs.swiper>
</x-section>