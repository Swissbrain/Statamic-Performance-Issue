@props(['level' => 'a', 'align' => 'left'])

@php
$color = match(strtoupper($level)) {
    'A' => 'bg-green-600',
    'B' => 'bg-green-500',
    'C' => 'bg-lime-400',
    'D' => 'bg-yellow-300',
    'E' => 'bg-amber-400',
    'F' => 'bg-orange-500',
    default => 'bg-red-500'
}
@endphp

<div {{ $attributes->class('text-white flex overflow-hidden w-[75px]') }}>
    @if ($align == 'right')
        <div class="{{ $color }} aspect-square rotate-45 w-7 relative left-3"></div>
    @endif

        <div class="h-7 flex items-center px-3 font-semibold {{ $color }} flex-grow relative z-10 {{ $align == 'right' ? 'justify-end' : 'justify-start' }}">{{ strtoupper($level) }}</div>

    @if($align == 'left')
        <div class="{{ $color }} aspect-square rotate-45 w-7 relative right-3"></div>
    @endif
</div>