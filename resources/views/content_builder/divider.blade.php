<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <x-design.divider :variation="(string) $variation->value()" :thickness="(string) $thickness->value()" :size="(string) $width" :with-logo="(string) $with_logo" />
</x-section>
