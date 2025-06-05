<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    @php
        $groups = \App\Services\JuraMachineService::collection((string) $category->value());
    @endphp

    <div class="my-6">
        <div class="flex justify-center">
            <flux:button.group>
                @if(request()->input('lineId'))
                    <flux:button :href="'/' . request()->path()" variant="primary">Alle</flux:button>
                @endif

                @foreach($groups as $group)
                    @if($group['items'])
                        <flux:button :href="'/' . request()->path(). '?lineId=' . $group['lineId']" :variant="request()->input('lineId') == $group['lineId'] ? 'active' : 'primary'">
                            {{ $group['lineName'] }}
                        </flux:button>
                    @endif
                @endforeach
            </flux:button.group>
        </div>
    </div>

    @foreach($groups as $group)
        @if($group['items'] && (!request()->input('lineId') || $group['lineId'] == request()->input('lineId')))
            <div class="my-6">
                <h2 class="text-4xl border-b pb-2 border-b-primary mb-6">{{ $group['lineName'] }}</h2>

                @if($group['lineDescription'])
                    <div class="text-gray-400 mb-6">{{ $group['lineDescription'] }}</div>
                @endif

                <div class="flex gap-6 flex-wrap justify-center xl:justify-start">
                    @foreach($group['items'] as $juraMachine)
                        @php
                            $image = imagePlaceholder(600, 600);

                            if($juraMachine->images->count()) {
                                $image = glide($juraMachine->images->first()->path);
                            } else {
                                $product = Cache::remember('makaris.products.b2b.' . Str::snake($juraMachine['makaris_product_number']) , 60, fn() => \Swissbrain\Makaris\Models\ProductB2B::find($juraMachine['makaris_product_number']));
                                if ($product && \Arr::get($product->images, '0.thumbnail')) {
                                    $image = \Arr::get($product->images, '0.thumbnail');
                                }
                            }
                        @endphp
                        <div class="mb-6 max-w-[285px] w-full">
                            <a href="{{ $juraMachine->url() }}" class="bg-gray-100 aspect-square p-6 hover:p-3 transition-all overflow-hidden block relative group">
                                <div class="bg-center bg-no-repeat bg-contain h-full w-full" style="background-image: url('{{ $image }}')"></div>
                                @if((string) $juraMachine->energy_usage)
                                    <x-energy-usage-symbol :level="$juraMachine->energy_usage" class="absolute top-3 left-0" />
                                @endif

                                <div class="absolute inset-0 bg-black/20 z-10 items-center justify-center lg:group-hover:flex hidden">
                                    <flux:icon.magnifying-glass class="size-20 text-white" />
                                </div>
                            </a>

                            <div class="text-center mt-3">
                                <a href="{{ $juraMachine->url() }}" class="font-semibold">{{ $juraMachine->title }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</x-section>