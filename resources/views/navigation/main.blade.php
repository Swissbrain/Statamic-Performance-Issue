<div class="gap-12 hidden lg:flex relative" x-data="{ open: null }" @keyup.escape.window="open= null">
    @foreach (Statamic::tag('nav:main')->params(['include_home' => true])->sort('order')->fetch() as $entry)
        @if(!$entry['children'])
            <flux:link :href="$entry['url']->value()" variant="ghost" class="cursor-pointer" @mouseover="open = null">{{ $entry['title']->value() }}</flux:link>
        @else
            <div>
                <flux:link :href="$entry['url']->value()" variant="ghost" class="cursor-pointer" @mouseover="open = {{ $loop->iteration }}">{{ $entry['title']->value() }}</flux:link>

                <div class="fixed top-[100px] left-0 right-0 bottom-0 bg-black/30 z-30" style="display: none" x-show="open == {{ $loop->iteration }}">
                    <div class="absolute inset-0 z-10" @mouseover="open = null"></div>
                    <flux:container class="bg-white relative shadow z-20">
                        <div class="absolute top-3 right-6 cursor-pointer" @click="open = null">
                            <flux:icon.x-mark class="text-gray-400" />
                        </div>
                        <div class="flex gap-24 pt-6 pb-12 justify-center">
                            @foreach($entry['children'] as $headerChild)
                                <ul>
                                    <li class="mb-6">
                                        <x-div-or-link :as-link="(bool) $headerChild['url']->value()" :href="$headerChild['url']->value()" class="uppercase font-semibold text-primary after:content-[''] after:block after:border-b-2 after:w-[40px] after:pt-1 after:mb-3 after:border-primary">
                                            {{ $headerChild['title'] }}
                                        </x-div-or-link>
                                    </li>

                                    @foreach($headerChild['children'] as $child)
                                        <li class="mb-2">
                                            <a href="{{ $child['url']->value() }}" class="text-gray-500 hover:underline">
                                                {{ $child['title']->value() }}

                                                @if($child['show_badge']->value())
                                                    <flux:badge size="sm" color="{{ $child['badge_color']->value() ?: 'green' }}" class="ms-2">{{ $child['badge_text']->value() ?: 'Neu' }}</flux:badge>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach

                                    @if(array_key_exists('image', $headerChild) && $headerChild['image']->value()->image)
                                        <div class="min-w-[150px] mt-6">
                                            <x-image-advanced
                                                    :href="$headerChild['image']->value()->link_setting->linking_link->url()"
                                                    :target="$headerChild['image']->value()->link_setting->linking_target_blank"
                                                    :src="$headerChild['image']->value()->image?->path()"
                                                    :title="$headerChild['image']->value()->title_setting->title"
                                                    :subtitle="$headerChild['image']->value()->title_setting->subtitle"
                                                    :alt-text="$headerChild['image']->value()->image?->alt"
                                                    :width="150"
                                                    :aspect-ratio="$headerChild['image']->value()->image_setting->aspect_ratio->value()"
                                                    :aspect-ratio-width="$headerChild['image']->value()->image_setting->aspect_ratio->value() == 'custom' ? $headerChild['image']->value()->image_setting->width : 1"
                                                    :aspect-ratio-height="$headerChild['image']->value()->image_setting->aspect_ratio->value() == 'custom' ? $headerChild['image']->value()->image_setting->height : 1"
                                                    :overlay-color="$headerChild['image']->value()->image_setting->use_color_overlay ? $headerChild['image']->value()->image_setting->color : null"
                                                    :overlay-opacity="$headerChild['image']->value()->image_setting->use_color_overlay ? $headerChild['image']->value()->image_setting->opacity : null"
                                                    :variant="$headerChild['image']->value()->title_setting->variant->value() ?: 'simple'"
                                                    :text-alignment="$headerChild['image']->value()->title_setting->text_alignment"
                                            />
                                        </div>
                                    @endif
                                </ul>
                            @endforeach
                        </div>
                        @if($entry['image']->value()->image)
                        <div class="pb-12">
                            <x-image-advanced
                                    :href="$entry['image']->value()->link_setting->linking_link->url()"
                                    :target="$entry['image']->value()->link_setting->linking_target_blank"
                                    :src="$entry['image']->value()->image?->path()"
                                    :aspect-ratio="$entry['image']->value()->image_setting->aspect_ratio->value()"
                                    :width="1000"
                                    :title="$entry['image']->value()->title_setting->title"
                                    :subtitle="$entry['image']->value()->title_setting->subtitle"
                                    :alt-text="$entry['image']->value()->image?->alt"
                                    :aspect-ratio-width="$entry['image']->value()->image_setting->aspect_ratio->value() == 'custom' ? $entry['image']->value()->image_setting->width : 1"
                                    :aspect-ratio-height="$entry['image']->value()->image_setting->aspect_ratio->value() == 'custom' ? $entry['image']->value()->image_setting->height : 1"
                                    :overlay-color="$entry['image']->value()->image_setting->use_color_overlay ? $entry['image']->value()->image_setting->color : null"
                                    :overlay-opacity="$entry['image']->value()->image_setting->use_color_overlay ? $entry['image']->value()->image_setting->opacity : null"
                                    :variant="$entry['image']->value()->title_setting->variant->value() ?: 'simple'"
                                    :text-alignment="$entry['image']->value()->title_setting->text_alignment"
                            />
                        </div>
                        @endif
                    </flux:container>
                </div>
            </div>
        @endif
    @endforeach
</div>