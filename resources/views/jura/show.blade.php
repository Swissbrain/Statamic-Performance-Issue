@extends('layouts.site')

@section('content')
    @php($makarisProduct =  Makaris::findB2B($makaris_product_number, 'makaris_proudct_' . $makaris_product_number))
    @if(!$makarisProduct)
        @php(\Illuminate\Support\Facades\Redirect::to($configuration->error_404_entry->url())->send())
    @endif

    @include('includes.breadcrumb')
    <flux:container class="mb-6">
        <div class="lg:flex gap-6">
            <div>
            <x-swiperjs.swiper
                    class="lg:w-[600px]"
                    :swiper_id="uniqid('product-detail-image-slider')"
                    :loop="true"
                    :speed="300"
                    :autoplay="5000"
                    :allow-touch-move="true"
                    effect="slide"
                    max-items="1"
                    :pagination="true"
                    :navigation="true"
            >
                @php($images = $images->count() ? $images->pluck('path') : collect($makarisProduct->images)->pluck('original'))
                @foreach($images as $url)
                    <x-swiperjs.slide>
                        <div class="bg-gray-100 p-6 aspect-square">
                            <img src="{{ url(glide($url, 600, 600,  'contain')) }}" alt="{{ $title }}" class="mx-auto"/>
                        </div>
                    </x-swiperjs.slide>
                @endforeach
            </x-swiperjs.swiper>

                @if($videos->count() > 0)
                    <div class="my-6 p-3 bg-gray-100 max-w-[600px]">
                        <video src="{{ $videos->get()->first()->url }}" controls="controls" class="mx-auto"></video>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-semibold">{{ $title }}</h1>
                <div class="flex justify-between items-end mt-3">
                    <div class="text-xl">{{ currency_format($makarisProduct->sellingPrice) }}</div>
                    @if((string) $energy_usage)
                        <x-energy-usage-symbol :level="(string)$energy_usage"/>
                    @endif
                </div>

                <flux:separator class="my-6"/>

                <div class="wysiwyg">
                    {!! $description->wysiwyg !!}
                </div>

                <flux:table>
                    <flux:rows>
                        <flux:row>
                            <flux:column>Marke</flux:column>
                            <flux:cell>Jura</flux:cell>
                        </flux:row>
                        <flux:row>
                            <flux:column>Linie</flux:column>
                            <flux:cell>{{ $product_line->title }}</flux:cell>
                        </flux:row>
                        <flux:row>
                            <flux:column>Artikel-Nr.</flux:column>
                            <flux:cell>{{ $makaris_product_number }}</flux:cell>
                        </flux:row>
                        <flux:row>
                            <flux:column>Verkaufseinheit</flux:column>
                            <flux:cell>1 Kaffeemaschine</flux:cell>
                        </flux:row>
                        <flux:row>
                            <flux:column>Garantie</flux:column>
                            <flux:cell>{{ $warranty_duration }} Monate</flux:cell>
                        </flux:row>
                    </flux:rows>
                </flux:table>

                <flux:button href="{{ route('quote.create', ['id' => $id, 'slug' => $slug]) }}" class="w-full mt-12" variant="primary">Offerte anfragen</flux:button>
            </div>
        </div>

        @if(count($accessoires->value()) || count($care_product->value()) || $documents->count() || (string) $specifications || $videos->count())
            <flux:tab.group class="my-12">
                <flux:tabs>
                    @if(count($accessoires->value()))
                        <flux:tab name="accessories" icon="squares-2x2">Zubehör</flux:tab>
                    @endif

                    @if(count($care_product->value()))
                        <flux:tab name="clean-products" icon="squares-2x2">Pflegeprodukte</flux:tab>
                    @endif

                    @if($documents->count())
                        <flux:tab name="documents" icon="paper-clip">Dokumente</flux:tab>
                    @endif

                    @if((string) $specifications)
                        <flux:tab name="technical-data" icon="wrench-screwdriver">Technische Daten</flux:tab>
                    @endif

                    @if($videos->count())
                        <flux:tab name="videos" icon="film">Videos</flux:tab>
                    @endif
                </flux:tabs>

                <flux:tab.panel name="clean-products">
                    @php($productNumbers = collect($care_product->value())->pluck('makaris_product_number')->unique()->toArray())
                    @php($originCareProducts = collect(Makaris::findB2C($productNumbers, 'makaris_products_care_' . $page->id)))
                    <div class="flex gap-6 flex-wrap">
                        @foreach($care_product as $careProduct)
                            @php($originCareProduct = $originCareProducts->firstWhere('number', $careProduct['makaris_product_number']))
                            @if($originCareProduct)
                                <div class="w-full max-w-[45%] md:max-w-[250px]">
                                    <a href="{{ $originCareProduct->shopLink() }}"
                                       target="_blank"
                                       class="block aspect-square bg-gray-100 p-6">
                                        <div class="bg-center bg-contain bg-no-repeat w-full h-full"
                                             style="background-image: url('{{ $originCareProduct->originalImageSrc() }}')"></div>
                                    </a>


                                    <div class="text-center mt-3">
                                        <a href="{{ $originCareProduct->shopLink() }}" class="font-semibold">{{ $originCareProduct->name }}</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </flux:tab.panel>

                <flux:tab.panel name="accessories">
                    @php($productNumbers = collect($accessoires->value())->pluck('makaris_product_number')->unique()->toArray())
                    @php($originAccessoireProducts = collect(Makaris::findB2C($productNumbers, 'makaris_products_accessoires_' . $page->id)))
                    <div class="flex gap-6 flex-wrap">
                        @foreach($accessoires as $accessoriesItem)
                            @php($originAccessoireProduct = $originAccessoireProducts->firstWhere('number', $accessoriesItem['makaris_product_number']))
                            @if($originAccessoireProduct)
                                <div class="w-full max-w-[45%] md:max-w-[250px]">
                                    <a href="{{ $originAccessoireProduct->shopLink() }}"
                                       target="_blank"
                                       class="block aspect-square bg-gray-100 p-6">
                                        <div class="bg-center bg-contain bg-no-repeat w-full h-full"
                                             style="background-image: url('{{ $originAccessoireProduct->originalImageSrc() }}')"></div>
                                    </a>
                                    <div class="text-center mt-3">
                                        <a href="{{ $originAccessoireProduct->shopLink() }}" class="font-semibold">{{ $originAccessoireProduct->name }}</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </flux:tab.panel>

                @if($documents->count())
                    <flux:tab.panel name="documents">
                        <div class="space-y-6">
                            @foreach($documents as $document)
                                <flux:link href="{{ $document->url() }}" target="_blank" class="flex gap-2">
                                    <flux:icon.document/>{{ $document->title }}</flux:link>
                            @endforeach
                        </div>
                    </flux:tab.panel>
                @endif

                @if((string) $specifications)
                    <flux:tab.panel name="technical-data">
                        <div class="wysiwyg">
                            {!! $specifications !!}
                        </div>
                    </flux:tab.panel>
                @endif

                @if($videos->count())
                    <flux:tab.panel name="videos">
                        <div class="flex flex-col lg:flex-row lg:flex-wrap gap-6">
                            @foreach($videos as $video)
                                <div class="lg:w-1/4-gap-6 bg-gray-100 relative flex justify-center items-center">
                                    <video src="{{ $video->url }}" class="lg:max-h-[200px] w-full"></video>
                                    <a href="{{ $video->url }}" data-fancybox>
                                        <span class="absolute inset-0"></span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </flux:tab.panel>
                @endif
            </flux:tab.group>
        @endif
    </flux:container>
@endsection