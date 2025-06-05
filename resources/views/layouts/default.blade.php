@extends('layouts.site')

@section('content')
    <x-dynamic.content-builder :blocks="$page"/>

    @if((string) $popup)
        @php($hash = md5($popup_title . $popup_image?->path . $popup_button?->link . $popup_button->link_text))

        <div class="fixed right-0  max-w-[300px] hidden lg:block" style="z-index: 999999999"
             :class="{ 'bottom-[100px]': !open, 'bottom-0': open }"
             x-data="{
             open: false,
             hash: '{{ $hash }}',
             saveToCookie(state) {this.open = state; document.cookie = `popup_${this.hash}=${this.open}; path=/;`; },
             loadFromCookie() { this.open = document.cookie.split('; ').find(row => row.startsWith(`popup_${this.hash}=`))?.split('=')[1] === 'false' ? false : true }
          }" x-init="loadFromCookie()">
            {{-- Header when open --}}
            <div class="px-6 py-3 font-bold text-xl text-center bg-primary text-white rounded-tl-lg items-center hidden w-full"
                 :class="{ 'hidden': !open, 'flex': open }"
            >
                @if((string) $popup_title)
                    <div>{{ $popup_title }}</div>
                @endif
                <flux:spacer />
                <flux:icon.x-mark class="cursor-pointer" @click="saveToCookie(false)" />
            </div>

            {{-- Header when closed --}}
            <div class="p-3 font-bold text-xl cursor-pointer text-center w-[50px] bg-primary text-white rounded-l-lg hidden"
                 :class="{ 'hidden': open }"
                 @click="saveToCookie(true)"
            >
                <flux:icon.arrow-left class="ms-1" />
                @if((string) $popup_title)
                    <div class="[writing-mode:vertical-rl] transform scale-[-1] py-3">{{ $popup_title }}</div>
                @endif
            </div>

            {{-- content when open --}}
            <div class="bg-white hidden rounded-bl-lg border-b border-l border-primary" :class="{ 'hidden': !open }">
                @if((string) $popup_image)
                    <img src="{{ glide($popup_image->path, 300, 300, 'fit') }}" alt="" class="w-full" />
                @endif

                <div class="p-6">
                    <div class="wysiwyg">
                        {!! $popup_wysiwyg !!}
                    </div>

                    @if(((string) $popup_button->link) || ((string) $popup_button->link_text))
                        <x-button
                                class="w-full mt-6"
                                :variant="$popup_button->variant->value()"
                                :href="(string) $popup_button->link"
                                :target="(string) $popup_button->target_blank ? '_blank' : ''"
                                :title="$popup_button->title"
                                :label="$popup_button->link_text"
                                :icon="(string) $popup_button->icon"
                                :icon-position="(string) $popup_button->icon_position"
                        />
                    @endif
                </div>
            </div>

        </div>
    @endif
@endsection
