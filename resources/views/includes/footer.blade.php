<div class="bg-gray-100 py-12 no-print">
    <flux:container class="md:flex flex-wrap gap-12">
        @php($navigation = Statamic::tag('nav:bottom')->sort('order')->fetch())
        <div class="{{ count($navigation) ? '' : 'flex-1' }}">
            <div>
                <img src="{{ asset('static/svg/Logo_Morger_Blau.svg') }}" alt="{{ config('app.name') }}" class="h-32 mx-auto" />
            </div>
            <div class="text-sm mt-4">Ihr Kaffeemaschinen Experte</div>
            <div class="flex gap-3 mt-6">
                @foreach($social_media->social_media as $item)
                @php($data = $item->toArray())
                    <a href="{{ $data['prefix'] . $data['handle'] }}" target="_blank" class="p-2 border-primary rounded-lg hover:text-white hover:bg-primary border border-primary-200">
                        <flux:icon :icon="$data['type']" class="size-6" />
                    </a>
                @endforeach
            </div>
        </div>

        @foreach ($navigation as $entry)
            <div class="{{ $loop->last ? 'flex-1' : '' }}">
                <div class="md:p-2">
                    <x-footer-title :title="$entry['title']" :url="$entry['url']->value()" />
                    <ul>
                        @foreach($entry['children'] as $child)
                            <li class="mb-2"><a href="{{ $child['url'] }}" class="md:text-sm hover:text-primary-500">{{ $child['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
        <div class="">
            <div class="md:p-2">
                <div class="text-lg mb-6  font-semibold after:content-[''] after:border-b-2 after:w-[30px] after:my-3 after:border-primary after:block">
                    Kontakt
                </div>
                <div class="flex gap-3">
                    <flux:icon.map-pin />
                    <a href="{{ $company['map_link'] }}" target="_blank" class="hover:text-primary-500">
                        {{ $company['company_name'] }}<br>
                        {{ $company['street'] }}<br>
                        CH-{{ $company['zip_code'] }} {{ $company['city'] }}
                    </a>
                </div>

                <div class="my-6 flex gap-3">
                    <flux:icon.envelope />
                    <a href="mailto:{{ $company['email'] }}" class="hover:text-primary-500">{{ $company['email'] }}</a>
                </div>

                <div class="my-6 flex gap-3">
                    <flux:icon.phone />
                    <a href="tel:{{ $company['phone_number'] }}" class="hover:text-primary-500">{{ $company['phone_number'] }}</a>
                </div>
            </div>
        </div>
    </flux:container>
</div>