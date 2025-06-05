<flux:container class="my-6">
    <flux:breadcrumbs>
        <s:nav:breadcrumbs>
            @if($is_current->value())
                <flux:breadcrumbs.item>{{ $title }}</flux:breadcrumbs.item>
            @else
                <flux:breadcrumbs.item :href="$url">{{ $title }}</flux:breadcrumbs.item>
            @endif
        </s:nav:breadcrumbs>
    </flux:breadcrumbs>
</flux:container>
