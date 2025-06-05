<x-section :block="$block" :container="!$image_setting->value()->full_width" :show-border="$blocks->show_space_bordering">
    <x-image-advanced
        :href="$link_setting->value()->linking_link->url()"
        :target="$link_setting->value()->linking_target_blank"
        :src="$image->value()?->path()"
        :aspect-ratio="$image_setting->value()->aspect_ratio->value()"
        :width="1216"
        :title="$title_setting->value()->title"
        :subtitle="$title_setting->value()->subtitle"
        :alt-text="$image->value()?->alt"
        :aspect-ratio-width="$image_setting->value()->aspect_ratio->value() == 'custom' ? $image_setting->value()->width : 1"
        :aspect-ratio-height="$image_setting->value()->aspect_ratio->value() == 'custom' ? $image_setting->value()->height : 1"
        :overlay-color="$image_setting->use_color_overlay ? $image_setting->color : null"
        :overlay-opacity="$image_setting->use_color_overlay ? $image_setting->opacity : null"
        :variant="$title_setting->value()->variant->value() ?: 'simple'"
        :text-position="(string) $title_setting->value()->text_position"
        :text-alignment="(string) $title_setting->value()->text_alignment"
    />
</x-section>