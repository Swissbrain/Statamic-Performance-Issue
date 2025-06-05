<x-section :block="$block" :container="true" :show-border="$blocks->show_space_bordering">
    @php($basicCss = "text-3xl font-semibold after:content-[''] after:block after:border-b-2 after:w-[75px] after:pt-1 after:border-primary after:pb-3")

    @if($direction == 'left')
        <h1 class="{{ $basicCss }}">
            {{ $blocks?->seo_title ?: $blocks?->title }}
        </h1>
    @endif

    @if($direction == 'center')
        <h1 class="{{ $basicCss }} text-center after:mx-auto">
            {{ $blocks?->seo_title ?: $blocks?->title }}
        </h1>
    @endif

    @if($direction == 'right')
        <h1 class="{{ $basicCss }} text-right after:ms-auto">
            {{ $blocks?->seo_title ?: $blocks?->title }}
        </h1>
    @endif
</x-section>