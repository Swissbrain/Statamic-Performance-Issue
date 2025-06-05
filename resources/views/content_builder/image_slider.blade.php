<x-section :block="$block" :show-border="$blocks->show_space_bordering">
    @if($center_slider->value())
        <div class="mx-auto w-full [:where(&)]:max-w-7xl xl:px-8" data-flux-container>
    @endif

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
                             :aspect-ratio-width="$width->value()"
                             :aspect-ratio-height="$height->value()"
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
                <x-swiperjs.slide>
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
                            @php($buttonAlignment = $slide[''] ?: 'center-center')
                            @php($contentPosition = match((string) $slide['text_position']) {
                                'top-left' => 'items-start justify-start',
                                'top-center' => 'items-start justify-center',
                                'top-right' => 'items-start justify-end',
                                'center-left' => 'items-center justify-start',
                                'center-center' => 'items-center justify-center',
                                'center-right' => 'items-center justify-end',
                                'bottom-left' => 'items-end justify-start',
                                'bottom-center' => 'items-end justify-center',
                                'bottom-right' => 'items-end justify-end',
                                default => 'justify-center items-center'
                            })
                            @php($textAlignmentClass = match((string) $slide['text_alignment']) {
                                'left' => 'text-start',
                                'center' => 'text-center',
                                'right' => 'text-end',
                                default => 'text-center'
                            })
                            @php($buttonAlignment = match((string) $slide['button_alignment']) {
                                'left' => 'text-start',
                                'center' => 'text-center',
                                'right' => 'text-end',
                                default => 'text-start',
                            })

                            <div class="flex p-24 w-full h-full relative z-10 {{ $contentPosition }}">
                                <div>
                                    @if($slide->entry_subtitle)
                                        <div class="{{ $textAlignmentClass }} text-xl md:text-2xl xl:text-3xl mb-3" style="color: {{ $slide->font_color }}">{!! str_replace("\n", '<br>', e($slide->entry_subtitle)) !!}</div>
                                    @endif

                                    @if($slide->entry_title)
                                        <h2 class="{{ $textAlignmentClass }} text-2xl md:text-4xl xl:text-6xl font-semibold mb-6 xl:mb-12 leading-snug" style="color: {{ $slide->font_color }}">{!! str_replace("\n", '<br>', e($slide->entry_title)) !!}</h2>
                                    @endif


                                    @if($slide->linking['link_text'] || $slide->linking['link']->url())
                                        <div class="{{ $buttonAlignment }}">
                                            <flux:button variant="{{ in_array($slide->linking['variant'], ['primary', 'secondary', 'filled-solid', 'outline', 'active']) ? $slide->linking['variant'] : 'primary' }}"
                                                         class="min-w-[200px]"
                                                         :href="$slide->linking['link']->url()"
                                                         :target="$slide->linking['target_blank'] ? '_blank' : ''"
                                                         :title="$slide->linking['title']"
                                            >
                                                {{ $slide->linking['link_text'] }}
                                            </flux:button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                    </x-image>
                </x-swiperjs.slide>
            @endforeach
        @endif
    </x-swiperjs.swiper>

    @if($center_slider->value())
        </div>
    @endif
</x-section>