@props([
    'title' => null,
    'url' => null,
])

<x-div-or-link :as-link="(bool) $url" :href="$url" class="text-lg mb-6 font-semibold after:content-[''] after:border-b-2 after:w-[30px] after:my-3 after:border-primary after:block">
    {{ $title ?: $slot }}
</x-div-or-link>