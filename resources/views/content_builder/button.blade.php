@php
    $direction = match((string) $positioning->value()) {
        'center' => 'justify-center',
        'right' => 'justify-end',
        default => 'justify-start',
    };
@endphp

<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <div class="flex flex-wrap gap-3 {{ $direction }} items-center">
        @foreach($block->links as $button)
            <x-button
                    {{ $attributes->class(' min-w-[200px] ' . ($direction == 'full' ? 'w-full' : '')) }}
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
</x-section>