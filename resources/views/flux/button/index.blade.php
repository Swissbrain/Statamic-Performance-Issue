@props([
    'iconTrailing' => null,
    'variant' => 'outline',
    'iconVariant' => null,
    'iconLeading' => null,
    'type' => 'button',
    'loading' => null,
    'size' => 'base',
    'square' => null,
    'inset' => null,
    'icon' => null,
    'kbd' => null,
])

@php
$iconLeading = $icon ??= $iconLeading;

// Button should be a square if it has no text contents...
$square ??= $slot->isEmpty();

// Size-up icons in square/icon-only buttons... (xs buttons just get micro size/style...)
$iconVariant ??= ($size === 'xs')
    ? ($square ? 'micro' : 'micro')
    : ($square ? 'mini' : 'micro');

// When using the outline icon variant, we need to size it down to match the default icon sizes...
$iconClasses = Flux::classes()
    ->add($iconVariant === 'outline' ? ($square && $size !== 'xs' ? 'size-5' : 'size-4') : '')
    ;

$isTypeSubmitAndNotDisabledOnRender = $type === 'submit' && ! $attributes->has('disabled');

$loading ??= $loading ?? ($isTypeSubmitAndNotDisabledOnRender || $attributes->whereStartsWith('wire:click')->isNotEmpty());

if ($loading && $type !== 'submit') {
    $attributes = $attributes->merge(['wire:loading.attr' => 'data-flux-loading']);

    // We need to add `wire:target` here because without it the loading indicator won't be scoped
    // by method params, causing multiple buttons with the same method but different params to
    // trigger each other's loading indicators...
    if (! $attributes->has('wire:target') && $target = $attributes->whereStartsWith('wire:click')->first()) {
        $attributes = $attributes->merge(['wire:target' => $target], escape: false);
    }
}

$classes = Flux::classes()
    ->add('relative items-center font-medium justify-center gap-2 whitespace-nowrap')
    ->add('disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none')
    ->add(match ($size) { // Size...
        'base' => 'h-10 text-sm rounded-lg' . ' ' . ($square ? 'w-10' : 'px-4'),
        'sm' => 'h-8 text-sm rounded-md' . ' ' . ($square ? 'w-8' : 'px-3'),
        'xs' => 'h-6 text-xs rounded-md' . ' ' . ($square ? 'w-6' : 'px-2'),
    })
    ->add('inline-flex') // Buttons are inline by default but links are blocks, so inline-flex is needed here to ensure link-buttons are displayed the same as buttons...
    ->add($inset ? match ($size) { // Inset...
        'base' => $square
            ? Flux::applyInset($inset, top: '-mt-2.5', right: '-mr-2.5', bottom: '-mb-2.5', left: '-ml-2.5')
            : Flux::applyInset($inset, top: '-mt-2.5', right: '-mr-4', bottom: '-mb-3', left: '-ml-4'),
        'sm' => $square
            ? Flux::applyInset($inset, top: '-mt-1.5', right: '-mr-1.5', bottom: '-mb-1.5', left: '-ml-1.5')
            : Flux::applyInset($inset, top: '-mt-1.5', right: '-mr-3', bottom: '-mb-1.5', left: '-ml-3'),
        'xs' => $square
            ? Flux::applyInset($inset, top: '-mt-1', right: '-mr-1', bottom: '-mb-1', left: '-ml-1')
            : Flux::applyInset($inset, top: '-mt-1', right: '-mr-2', bottom: '-mb-1', left: '-ml-2'),
    } : '')
    ->add(match ($variant) { // Background color...
         'active' => 'bg-primary-600',
        'primary' => 'bg-primary hover:bg-primary-700 dark:bg-white dark:hover:bg-zinc-100',
        'filled' => 'bg-zinc-800/5 hover:bg-zinc-800/10 dark:bg-white/10 dark:hover:bg-white/20',
        'outline' => 'bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:hover:bg-zinc-600/75',
        'danger' => 'bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-500',
        'ghost' => 'bg-transparent hover:bg-primary/5 dark:hover:bg-white/15',
        'subtle' => 'bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15',
        'secondary' => 'bg-secondary',
        'filled-solid' => 'bg-gray-200 hover:bg-gray-100',
        default => '',
    })
    ->add(match ($variant) { // Text color...
         'active' => 'text-white',
        'primary' => 'text-secondary dark:text-zinc-800',
        'filled' => 'text-primary dark:text-white',
        'outline' => 'text-primary dark:text-white',
        'danger' => 'text-white',
        'ghost' => 'text-primary dark:text-white',
        'subtle' => 'text-primary-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white',
        'secondary' => 'text-primary',
        'filled-solid' => 'text-primary',
        default => '',
    })
    ->add(match ($variant) { // Border color...
        'primary' => 'border border-black/10 dark:border-0',
        'outline' => 'border border-zinc-200 hover:border-zinc-200 border-b-zinc-300/80 dark:border-zinc-600 dark:hover:border-zinc-600',
         default => '',
    })
    ->add(match ($variant) { // Shadows...
        'primary' => 'shadow-[inset_0px_1px_theme(colors.white/.2)]',
        'danger' => 'shadow-[inset_0px_1px_theme(colors.red.500),inset_0px_2px_theme(colors.white/.15)] dark:shadow-none',
        'outline' => match ($size) {
            'base' => 'shadow-sm',
            'sm' => 'shadow-sm',
            'xs' => 'shadow-none',
        },
        default => '',
    })
    ->add(match ($variant) { // Grouped border treatments...
        'outline' => '[[data-flux-button-group]_&]:border-l-0 [:is([data-flux-button-group]>&:first-child,_[data-flux-button-group]_:first-child>&)]:border-l-[1px]',
        'filled' => '[[data-flux-button-group]_&]:border-r [:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-r-0 [[data-flux-button-group]_&]:border-zinc-200/80 [[data-flux-button-group]_&]:dark:border-zinc-900/50',
        'danger' => '[[data-flux-button-group]_&]:border-r [:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-r-0 [[data-flux-button-group]_&]:border-red-600 [[data-flux-button-group]_&]:dark:border-red-900/25',
        'primary' => '[[data-flux-button-group]_&]:border-r-0 [:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-r-[1px] dark:[:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-r-0 dark:[:is([data-flux-button-group]>&:last-child,_[data-flux-button-group]_:last-child>&)]:border-l-[1px] [:is([data-flux-button-group]>&:not(:first-child),_[data-flux-button-group]_:not(:first-child)>&)]:border-l-[color-mix(in_srgb,var(--color-accent-foreground),transparent_85%)]',
        default => '',
    })
    ->add($loading ? [ // Loading states...
        '*:transition-opacity',
        $type === 'submit' ? '[&[disabled]>:not([data-flux-loading-indicator])]:opacity-0' : '[&[data-flux-loading]>:not([data-flux-loading-indicator])]:opacity-0',
        $type === 'submit' ? '[&[disabled]>[data-flux-loading-indicator]]:opacity-100' : '[&[data-flux-loading]>[data-flux-loading-indicator]]:opacity-100',
        $type === 'submit' ? '[&[disabled]]:pointer-events-none' : '[&[data-flux-loading]]:pointer-events-none',
    ] : [])
    ;

    // Exempt subtle and ghost buttons from receiving border roundness overrides from button.group...
    $attributes = $attributes->merge([
        'data-flux-group-target' => ! in_array($variant, ['subtle', 'ghost']),
    ]);
@endphp

<flux:with-tooltip :$attributes>
    <flux:button-or-link :$type :attributes="$attributes->class($classes)" data-flux-button>
        <?php if ($loading): ?>
            <div class="absolute inset-0 flex items-center justify-center opacity-0" data-flux-loading-indicator>
                <flux:icon icon="loading" :variant="$iconVariant" :class="$iconClasses" />
            </div>
        <?php endif; ?>

        <?php if (is_string($iconLeading) && $iconLeading !== ''): ?>
            <flux:icon :icon="$iconLeading" :variant="$iconVariant" :class="$iconClasses" />
        <?php elseif ($iconLeading): ?>
            {{ $iconLeading }}
        <?php endif; ?>

        <?php if ($loading && ! $slot->isEmpty()): ?>
            {{-- If we have a loading indicator, we need to wrap it in a span so it can be a target of *:opacity-0... --}}
            <span>{{ $slot }}</span>
        <?php else: ?>
            {{ $slot }}
        <?php endif; ?>

        <?php if ($kbd): ?>
            <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $kbd }}</div>
        <?php endif; ?>

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            {{-- Adding the extra margin class inline on the icon component below was causing a double up, so it needs to be added here first... --}}
            <?php $iconClasses->add($square ? '' : '-ml-1'); ?>
            <flux:icon :icon="$iconTrailing" :variant="$iconVariant" :class="$iconClasses" />
        <?php elseif ($iconTrailing): ?>
            {{ $iconTrailing }}
        <?php endif; ?>
    </flux:button-or-link>
</flux:with-tooltip>
