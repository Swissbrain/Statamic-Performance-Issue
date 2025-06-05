@props([
    'video_local' => null,
    'video_external' => null,
])
@if($video_local)
    <video class="w-full aspect-[16/9] rounded-lg bg-black" controls>
        <source src="{{ asset($video_local) }}" type="video/mp4" />
    </video>
@endif

@if ($video_external)
    @if(Statamic::modify($video_external)->isEmbeddable()->fetch())
        <iframe src="{{ Statamic::modify($video_external)->embedUrl() }}" class="w-full aspect-[16/9] rounded-lg bg-black"></iframe>
    @else
        <video class="w-full aspect-[16/9] rounded-lg bg-black" controls>
            <source src="{{ Statamic::modify($video_external)->embedUrl() }}" type="video/mp4" />
        </video>
    @endif
@endif
