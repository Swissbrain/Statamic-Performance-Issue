<div class="lg:hidden w-full flex bg-white justify-between fixed z-20 top-0 left-0 right-0 h-[50px] no-print">
    <flux:link href="{{ $company->shop_link }}" target="_blank" class="border-r w-1/4 flex justify-center items-center h-[50px] border-b"><flux:icon.shopping-cart class="text-primary" /></flux:link>
    <flux:link href="tel:+{{ preg_replace('/[^0-9+]/', '', $company->phone_number) }}" target="_blank" class="border-r w-1/4 flex justify-center items-center h-[50px] border-b"><flux:icon.phone class="text-primary" /></flux:link>
    <flux:link href="mailto:{{ $company->email }}" target="_blank" class="border-r w-1/4 flex justify-center items-center h-[50px] border-b"><flux:icon.envelope class="text-primary" /></flux:link>
    <flux:link href="{{ $company->map_link }}" target="_blank" class="border-b w-1/4 flex justify-center items-center h-[50px]"><flux:icon.map-pin class="text-primary" /></flux:link>
</div>

<flux:header container class="flex-wrap fixed top-[50px] lg:top-0 left-0 right-0 bg-secondary h-[50px] lg:h-[100px] shadow no-print z-20">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:link href="{{ route('statamic.site') }}" class="hidden lg:flex h-[100px] items-center justify-center">
        <img src="{{ asset('static/svg/Logo_Morger_Blau.svg') }}" alt="{{ config('app.name') }}" class="h-16 mx-auto" />
    </flux:link>

    <flux:spacer />

    @include('navigation.main')

    <flux:spacer />

    <div class="hidden lg:block">
        <flux:button href="{{ route('search.index') }}" icon="magnifying-glass" variant="ghost" icon-variant="outline" />
        <flux:button href="{{ $company['shop_link'] }}" target="_blank" icon="shopping-cart" variant="ghost" icon-variant="outline">Shop</flux:button>
    </div>

    <flux:link href="{{ route('statamic.site') }}" class="lg:hidden">
        <img src="{{ asset('static/svg/Logo_Morger_Blau.svg') }}" alt="{{ config('app.name') }}" class="h-12 mx-auto" />
    </flux:link>
</flux:header>