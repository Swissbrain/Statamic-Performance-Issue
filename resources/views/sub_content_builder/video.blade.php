<x-section :block="$block">
    @if ($video_setting->value() == 'video_external' && $video_external)
        <x-video :video_external="$video_external" />
    @endif

{{--    @if($video_setting == 'video_local' && $video_local?->url())--}}
{{--        <x-video :video_external="$video_local->url()" />--}}
{{--    @endif--}}
    [video]
</x-section>