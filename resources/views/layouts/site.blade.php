<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @php
    if (isset($page) && $page?->seo_title) {
        $pageTitle[] = $page->seo_title;
    } elseif (isset($page) && $page?->title) {
        $pageTitle[] = $page->title;
    }
    $pageTitle[] = config('app.name');
    @endphp
    <title>{{ implode(' - ', $pageTitle) }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/css/site.css')
    @livewireStyles
    @fluxStyles

    <!-- Scripts -->
    <script src="https://static.elfsight.com/platform/platform.js" async></script>

    @antlers {{ partial:statamic-peak-seo::snippets/seo }} @endantlers
</head>
<body class="min-h-screen bg-white">
@antlers {{ stack:seo_body }} @endantlers

@include('includes.header')

@include('sidebar')

<flux:main class="flex flex-col text-primary mt-[100px]">

    @yield('content')

    <flux:spacer />

    @include('includes.footer')

    <div class="bg-primary-900 text-white no-print">
        <flux:container class="text-sm py-6 text-center">
            &copy; {{ now()->format('Y') }} {{ $company['company_name'] }} <span class="hidden md:inline">|</span><span class="md:hidden"><br></span> developed by <a class="text-secondary" href="https://www.swissbrain.ch" target="_blank">swissbrain</a>
        </flux:container>
    </div>
</flux:main>

    @include('includes.whats-app')

@stack('scripts')
@vite('resources/js/site.js')
@livewireScriptConfig
@fluxScripts
</body>
</html>