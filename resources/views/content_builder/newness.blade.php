<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <div class="my-6">
        <h2 class="text-4xl border-b pb-2 border-b-primary mb-6">{{ $title }}</h2>

        <div class="flex gap-6 flex-wrap justify-center xl:justify-start">

            @foreach($items as $item)
                @php
                    $image = $item['image']?->path ?
                        glide($item['image']->path, 600, 600)
                        : imagePlaceholder(600, 600);
                @endphp

                <div class="mb-6 max-w-[285px] w-full">
                    <a href="{{  $item['link'] }}" target="{{ $item['target_blank'] ? '_blank' : '' }}" class="bg-gray-100 aspect-square p-6 hover:p-3 transition-all overflow-hidden block relative group">
                        <div class="bg-center bg-no-repeat bg-contain h-full w-full" style="background-image: url('{{ $image }}')"></div>
                        <div class="absolute inset-0 bg-black/20 z-10 items-center justify-center lg:group-hover:flex hidden">
                            <flux:icon.magnifying-glass class="size-20 text-white" />
                        </div>
                    </a>

                    <div class="mt-3">
                        @if((string) $item['title'])
                            <div class="text-center">
                                <a href="#" class="font-semibold">{{ $item['title'] }}</a>
                            </div>
                        @endif
                        @if((string) $item['wysiwyg'])
                            <div class="wysiwyg">
                                {!! $item['wysiwyg'] !!}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-section>