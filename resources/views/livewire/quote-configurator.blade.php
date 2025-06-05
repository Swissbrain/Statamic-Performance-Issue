<flux:container class="h-full">
    @if ($message)
        <div class="my-6 border border-red-300 rounded-md px-6 py-4 bg-red-100 shadow">
            <div class="flex gap-3">
                <flux:icon.exclamation-triangle class="text-red-600" />
                <div class="text-red-600">{{ $message }}</div>
            </div>
        </div>
    @endif

    <form wire:submit="save">
        @csrf
        <input type="hidden" name="id" value="{{ $juraMachine->id }}" />
        <div class="lg:flex flex-wrap gap-6 h-full">
            <div class="lg:w-1/2-gap-6 h-full my-6">
                <flux:accordion transition>
                    <flux:accordion.item heading="Zubehör" expanded>
                        <div class="space-y-3">
                            @foreach(($catalogueShowMore ? $this->catalogue : $this->catalogue->take(3)) as $item)
                                <div class="flex gap-3">
                                    @if($item['image_url'])
                                        <div class="aspect-square w-[100px] border p-3 rounded-md border-gray-300 flex items-center justify-center">
                                            <img src="{{ $item['image_url'] }}" alt="{{ $item['title'] }}" class="max-h-full max-w-full">
                                        </div>
                                    @else
                                        <div class="aspect-square w-[100px]"></div>
                                    @endif
                                    <div>
                                        <div>{{ $item['title'] }}</div>
                                        @if($item['description'])
                                            <div class="text-gray-500">{{ $item['description'] }}</div>
                                        @endif
                                        <div class="text-gray-400 mt-3 text-sm">Art. Nr. {{ $item['product_number'] }}</div>
                                    </div>

                                    <flux:spacer />

                                    <div class="text-end">
                                        <flux:button icon="plus" size="sm" wire:click="add('{{ $item['product_number'] }}')" :loading="false">Hinzufügen</flux:button>
                                    </div>
                                </div>
                            @endforeach
                            @if($this->catalogue->count() > 3)
                                <div class="text-center">
                                    @if($catalogueShowMore)
                                        <flux:button size="sm" wire:click="toggleCatalogue">Weniger anzeigen</flux:button>
                                    @else
                                        <flux:button size="sm" wire:click="toggleCatalogue">Mehr anzeigen</flux:button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </flux:accordion.item>
                    <flux:accordion.item heading="Kontakt Angaben" expanded>
                        <div class="flex gap-6 flex-wrap mt-6">
                            <div class="w-full">
                                <flux:input label="Firma" placeholder="Firma" wire:model="company" />
                            </div>

                            <div class="w-full md:w-1/2-gap-6">
                                <flux:input label="Vorname" placeholder="Vorname" wire:model="firstName" />
                            </div>

                            <div class="w-full md:w-1/2-gap-6">
                                <flux:input label="Nachname" placeholder="Nachname" wire:model="lastName" />
                            </div>

                            <div class="w-full">
                                <flux:input label="Strasse" placeholder="Strasse" class="w-full" wire:model="street" />
                            </div>

                            <div class="w-1/3-gap-6">
                                <flux:input label="PLZ" placeholder="PLZ" wire:model="zipCode" />
                            </div>

                            <div class="w-2/3-gap-6">
                                <flux:input label="Ort" placeholder="Ort" wire:model="city" />
                            </div>

                            <div class="w-full md:w-1/2-gap-6">
                                <flux:input label="E-Mail" type="email" placeholder="E-Mail" class="w-full" wire:model="email" />
                            </div>

                            <div class="w-full md:w-1/2-gap-6">
                                <flux:input label="Telefon" placeholder="Telefon" class="w-full" wire:model="phone" />
                            </div>

                            <div class="w-full">
                                <flux:textarea wire:model="remarks" placeholder="Bemerkungen" label="Bemerkungen" class="w-full"  />
                            </div>
                        </div>
                    </flux:accordion.item>
                </flux:accordion>

            </div>
            <div class="bg-gray-100 lg:w-1/2-gap-6 min-h-full p-6 space-y-6">
                <div class="text-xl font-semibold pb-3 border-b">Angebot für Jura {{ $juraMachine->title }}</div>

                @php($juraMachineItem = $quote->items->firstWhere('type', 'jura_machine'))

                <x-quote.summary-row :title="$juraMachineItem->name"
                                     :subtitle="$juraMachineItem->description"
                                     :image="$juraMachineItem->image_url ? glide($juraMachineItem->image_url, 100,100, 'contain') : null"
                                     :price="$juraMachineItem->selling_price"
                                     :product-number="$juraMachineItem->product_number"
                                     :show-type-number="true"
                />

                @foreach($quote->items->where('type', '!=', 'jura_machine') as $item)
                    <x-quote.summary-row :title="$item->name"
                                         :type="$item->makaris_type"
                                         :subtitle="$item->description"
                                         :price="$item->selling_price"
                                         :image="$item->image_url ? glide($item->image_url, 100,100, 'contain') : null"
                                         :product-number="$item->product_number"
                                         :amount="$item->amount">
                        <x-slot:left>
                            @if(!$item['is_required'])
                                <flux:spacer />
                                @if($item->makaris_type == 'product')
                                    <div class="text-sm flex gap-1 items-center cursor-pointer text-red-600" wire:click="remove('{{ $item->product_number }}')"><flux:icon.x-mark variant="micro"/>Entfernen</div>
                                @else
                                    <div class="text-sm flex gap-1 items-center cursor-pointer text-red-600" wire:click="removePosition('{{ $item->id }}')"><flux:icon.x-mark variant="micro"/>Entfernen</div>
                                @endif
                            @endif
                        </x-slot:left>
                    </x-quote.summary-row>
                @endforeach

                <div class="border-t pt-3 mt-3 flex justify-between">
                    <div class="font-bold">Total</div>
                    <div class="text-end">
                        <div class="font-bold text-xl">{{ currency_format($quote->calcTotal()) }}</div>
                        <div class="text-gray-400">Inkl. MwSt.</div>
                    </div>
                </div>

                <div class="flex gap-3">
                <flux:checkbox wire:model="terms" />
                    <div>Ich stimme den
                        @if($url = $this->termsAndConditions())
                            <flux:link href="{{ $url }}" target="_blank">AGB sowie den Nutzungsbestimmungen</flux:link>
                        @else
                            AGB sowie den Nutzungsbestimmungen
                        @endif
                        & dem
                        @if($url = $this->privacyStatement())
                            <flux:link href="{{ $url }}" target="_blank">Datenschutz</flux:link>
                        @else
                            Datenschutz
                        @endif
                        zu.</div>
                </div>

                <flux:button variant="secondary" type="submit" class="w-full">Offerte einholen</flux:button>
            </div>
        </div>
    </form>
</flux:container>