@props([
    'image' => null,
    'title' => null,
    'subtitle' => null,
    'price' => null,
    'productNumber' => null,
    'deletable' => true,
    'left' => null,
    'right' => null,
    'amount' => 1,
    'type' => 'product',
    'showTypeNumber' => false,
])

<div class="flex gap-3">
    @if($image)
        <div class="aspect-square w-[100px] border p-3 rounded-md border-gray-300 flex items-center justify-center">
            <img src="{{ $image }}" alt="" class="max-h-full max-w-full">
        </div>
    @else
        <div class="w-[100px]"></div>
    @endif

    <div class="flex flex-col gap-1">
        <div>{{ $amount > 1 ? $amount . 'x ' : '' }}{{ $title }}</div>
        @if ($subtitle)
            <div class="text-gray-500">{{ $subtitle }}</div>
        @endif
        @if($productNumber && $showTypeNumber)
            <div class="text-gray-400 text-sm">
                @switch($type)
                    @case('product')Art. Nr. @break
                    @case('expense_type')Afw. Nr. @break
                    @case('activity')Tkt. Nr. @break
                @endswitch
                {{ $productNumber }}
            </div>
        @endif

        @if($left)
            {{ $left }}
        @endif
    </div>

    <flux:spacer />

    <div class="text-end">
        @if($price)
            <div class="mb-3">{{ currency_format(((float) $price) * $amount) }}</div>
        @else
            <div class="mb-3">Gratis</div>
        @endif

        @if($right)
            {{ $right }}
        @endif
    </div>

</div>