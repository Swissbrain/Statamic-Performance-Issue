@props([
    'title' => null,
    'subtitle' => null,
    'bold' => false,
    'position' => 'left',
])

<div {{ $attributes->class([
    'text-center' => $position == 'center',
    'text-end' => $position == 'right',
]) }}>

    @if($subtitle)
        <div class="{{ $title ? 'mb-2' : '' }}">{{ $subtitle }}</div>
    @endif

    @if ($title)
        <h2 @class([
            'text-2xl uppercase',
            "after:content-[''] after:block after:border-b-2 after:w-[75px] after:pt-1 after:border-primary",
            ($bold === true ? 'font-bold' : 'font-medium tracking-widest'),
            'after:mx-auto' => $position == 'center',
            'after:ml-auto' => $position == 'right',
        ])>{{ $title }}</h2>
    @endif
</div>