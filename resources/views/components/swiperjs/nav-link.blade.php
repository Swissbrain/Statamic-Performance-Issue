@props([
    'class' => '',
    'direction' => 'right',
])

<div class="absolute bg-white rounded-full transform -translate-y-1/2 z-30 group-hover:visible invisible
    size-10 aspect-square text-black flex justify-center items-center hover:text-primary shadow-xl
    transition ease-in-out {{ $class }} disabled:hidden cursor-pointer hover:opacity-100 opacity-70"
>
    <div>
        @if($direction === 'right')
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-chevron-right">
                <path d="m9 18 6-6-6-6"/>
            </svg>
        @elseif($direction === 'left')
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        @else
            {{ $icon }}
        @endif
    </div>
</div>
