@props([
    'variation' => 'solid',
    'thickness' => '1px',
    'size' => 'medium',
    'withLogo' => false,
])

@php
    $sizeClass = match($size) {
        'small' => 'max-w-[150px]',
        'medium' => 'max-w-sm',
        'large' => 'max-w-2xl',
        default => '',
    }
@endphp

<div {{ $attributes->class([
    'w-full border-primary mx-auto h-0 relative',
    $sizeClass,
    match($thickness) {
            '1px' => 'border',
            '2px' => 'border-2',
            '4px' => 'border-4',
            '8px' => 'border-8',
            default => 'border'
    },
    match($variation) {
        'solid' => 'border-solid',
        'dashed' => 'border-dashed',
        'dotted' => 'border-dotted',
        default => 'border-solid'
    }
]) }}>
    @if($withLogo)
        <div class="absolute -top-5 left-0 right-0 flex justify-center">
            <div class="bg-white px-3">
                <img src="{{ asset('static/svg/Logo_Morger_Blau.svg') }}" alt="" class="size-8"/>
            </div>
        </div>
    @endif
</div>
