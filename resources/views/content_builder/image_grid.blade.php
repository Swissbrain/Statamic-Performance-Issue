<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    <x-image-grid :columns="$columns->value()"
                  :images="$images->value()"
                  :aspect-ratio="(string) $image_setting->value()->aspect_ratio->value()"
                  :aspect-ratio-width="$image_setting->value()->width"
                  :aspect-ratio-height="$image_setting->value()->height"
    />
</x-section>