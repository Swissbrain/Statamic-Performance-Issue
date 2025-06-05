<x-section :block="$block" :container="true">
    <x-title :title="$title->value()"
             :subtitle="$subtitle->value()"
             :bold="$show_in_bold->value()"
             :position="$title_positioning->value()"
    />

    <div class="wysiwyg mt-6">
        {!! $wysiwyg !!}
    </div>

    <livewire:rental-request :success-text="(string) $success_text" />
</x-section>