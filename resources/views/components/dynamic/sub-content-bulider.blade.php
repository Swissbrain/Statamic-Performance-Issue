@props([
    'blocks' => null,
    'override' => null,
    'page' => null
])

@foreach($override ? $blocks->{$override} : $blocks->sub_content_builder as $block)
    @include('/sub_content_builder/' . $block['type'], $block)
@endforeach
