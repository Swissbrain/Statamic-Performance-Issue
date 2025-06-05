@props([
    'variant' => null,
    'href' => null,
    'target' => null,
    'title' => null,
    'label' => null,
    'icon' => null,
    'iconPosition' => 'left',
])


<flux:button variant="{{ in_array($variant, ['primary', 'secondary', 'filled-solid', 'outline', 'active']) ? $variant : 'primary' }}"
             {{ $attributes }}
             :href="$href"
             :target="$target"
             :title="$title"
>
    @if($icon && $icon != '-' && $iconPosition == 'left')
        <flux:icon :icon="$icon" :variant="null" class="h-4" />
    @endif
    {{ $label }}

    @if($icon && $icon != '-' && $iconPosition == 'right')
        <flux:icon :icon="$icon" :variant="null" class="h-4 inline-block m-0 p-0" />
    @endif
</flux:button>