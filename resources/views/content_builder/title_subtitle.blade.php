<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <x-title :title="$title->value()"
             :subtitle="$subtitle->value()"
             :bold="$show_in_bold->value()"
             :position="$title_positioning->value()"
    />
</x-section>