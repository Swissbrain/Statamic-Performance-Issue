@php
    $direction = match((string) $positioning->value()) {
        'center' => 'justify-center',
        'right' => 'justify-end',
        default => 'justify-start'
    };
@endphp

<div class="flex flex-wrap gap-3 items-center {{ $direction }}">
    @foreach($block->links as $button)
        <x-button
                {{ $attributes->class('min-w-[200px]') }}
                :variant="$button->variant->value()"
                :href="(string) $button->link"
                :target="$button->target_blank ? '_blank' : ''"
                :title="$button->title"
                :label="$button->link_text"
                :icon="(string) $button->icon"
                :icon-position="(string) $button->icon_position"
        />
    @endforeach
</div>