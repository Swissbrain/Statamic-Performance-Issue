@props([
    'blocks' => null,
    'override' => null,
    'page' => null,
])

@php($items = $override ? $blocks->{$override} : $blocks->content_builder)
@php($firstItem = collect($items)->first())

@if (!$blocks->isRoot() && ($firstItem?->type != 'image_slider' || $firstItem?->type == 'image_slider' && $firstItem?->center_slider))
    @include('includes.breadcrumb', ['page' => $blocks])
@endif

@foreach($items as $block)
    @include('/content_builder/' . $block['type'], $block)

    @if(!$blocks->isRoot() && $loop->first && $block->type == 'image_slider' && !$block->center_slider)
        @include('includes.breadcrumb', ['page' => $blocks])
    @endif
@endforeach