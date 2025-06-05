<x-section :block="$block" :show-border="$page->show_space_bordering">
    <x-title :title="$title->value()"
             :subtitle="$subtitle->value()"
             :bold="$show_in_bold->value()"
             :position="$title_positioning->value()"
    />
</x-section>