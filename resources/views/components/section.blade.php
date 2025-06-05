@props([
    'block' => null,
    'container' => false,
    'prefix' => '',
    'showBorder' => false,
])

@php
    $class = [];

    if ($block) {
        if (!is_array($block)) {
            $block = $block->toArray();
        }

        if (array_key_exists($prefix . 'space_top', $block)) {
            $class[] = match((string) $block[$prefix . 'space_top']) {
                'small' => 'pt-6',
                'medium' => 'pt-12',
                'large' => 'pt-24',
                default => 'pt-0'
            };
        }

        if (array_key_exists($prefix . 'space_bottom', $block)) {
            $class[] = match((string) $block[$prefix . 'space_bottom']) {
                'small' => 'pb-6',
                'medium' => 'pb-12',
                'large' => 'pb-24',
                default => 'pb-0'
            };
        }

        if (array_key_exists($prefix . 'visibility', $block)) {
            $values = $block['visibility']->toArray();
            $class[] = $values['mobile']->value() ? 'block' : 'hidden';
            $class[] = $values['tablet']->value() ? 'md:block' : 'md:hidden';
            $class[] = $values['laptop']->value() ? 'lg:block' : 'lg:hidden';
            $class[] = $values['desktop']->value() ? 'xl:block' : 'xl:hidden';
        }
    }

    if ($showBorder) {
        $class[] = 'border border-dashed';
    }
@endphp

<section {{ $attributes->class($class) }}>
    @if($container)
        <flux:container>
            {{ $slot }}
        </flux:container>
    @else
        {{ $slot }}
   @endif
</section>
