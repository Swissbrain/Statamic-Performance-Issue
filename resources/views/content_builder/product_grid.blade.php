@php
use \Illuminate\Support\Facades\Cache;
use \Swissbrain\Makaris\Models\ProductB2C;

$widthCss = match($columns->value()) {
    2 => 'w-full sm:w-1/2-gap-6',
    3 => 'w-full sm:w-1/2-gap-6 md:w-1/3-gap-6',
    4 => 'w-full sm:w-1/2-gap-6 md:w-1/3-gap-6 lg:w-1/4-gap-6',
    5 => 'w-full sm:w-1/2-gap-6 md:w-1/3-gap-6 lg:w-1/4-gap-6 xl:w-1/5-gap-6',
    6 => 'w-full sm:w-1/2-gap-6 md:w-1/3-gap-6 lg:w-1/4-gap-6 xl:w-1/6-gap-6',
    default => ''
};

$ids = collect($products)->pluck('makaris_product_id')->toArray();
$makarisProducts = Cache::remember(
    'makaris.products.product_grid.' . $block->id,
    600,
    fn() => ProductB2C::find($ids)
);
@endphp

<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <div class="flex gap-6 flex-wrap">
        @foreach($products as $product)
            @php($originProduct = $makarisProducts->firstWhere(fn($item) => $item->number == $product->makaris_product_id))
            @if ($originProduct)
                @php($image = $originProduct->originalImageSrc() ?: imagePlaceholder(500, 500))
                <a class="{{ $widthCss }} block" href="{{ $originProduct->shopLink() }}" target="_blank">
                    <div class="bg-gray-100 aspect-square p-6 hover:p-3 transition-all group relative">
                        <div class="bg-black/20 absolute z-10 inset-0 items-center justify-center hidden group-hover:flex">
                            <flux:icon.shopping-cart class="size-24 text-white" />
                        </div>
                        <div class="bg-center bg-cover bg-no-repeat h-full w-full" style="background-image: url('{{ $image }}')"></div>
                    </div>
                    <div class="font-semibold text-center mt-3">{{ $product->override_title ? : $originProduct->name }}</div>
                    <div class="font-semibold text-center mt-1 text-secondary-600">{{ number_format($originProduct->discountedSellingPrice ?: $originProduct->sellingPrice, 2, '.', "'") }} CHF</div>
                </a>
            @endif
        @endforeach
    </div>
</x-section>