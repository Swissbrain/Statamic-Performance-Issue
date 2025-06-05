@php($fontColor = $override_text_color ?? false ? $text_color : null)

<x-section :block="$block" class="wysiwyg" style="{{ $fontColor ? 'color:' . $fontColor : '' }}" :show-border="$page->show_space_bordering">
    {!! $wysiwyg !!}
</x-section>
