<x-section :block="$block" :show-border="$page->show_space_bordering">
    <x-image-grid :columns="$columns->value()"
                  :images="$images->value()"
                  :aspect-ratio="$image_setting->value()->aspect_ratio->value()"
                  :aspect-ratio-width="$image_setting->value()->width"
                  :aspect-ratio-height="$image_setting->value()->height"
    />
</x-section>
