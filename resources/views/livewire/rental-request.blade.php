<div>
    @if($sendSuccessfully)
        <div class="text-center bg-green-200 p-6 my-6 rounded-lg">{{ $successText ?: 'Ihre Anfrage wurde erfolgreich übermittelt. Vielen Dank!' }}</div>
    @else
        <form wire:submit="submit" class="space-y-6">
            <flux:input type="date" wire:model="birthday" class="hidden" /> {{-- honeytop trap --}}

            <div class="lg:flex gap-6">
                <div class="lg:w-1/2-gap-6 space-y-6 mb-6">
                    <flux:heading size="xl" class="border-b pb-3 mb-3 !text-primary">Angaben zum Anlass</flux:heading>

                    <flux:radio.group wire:model="request_type" label="Art der Anfrage *">
                        <flux:radio value="reservation" label="Reservation" />
                        <flux:radio value="contact" label="Telefonische Kontaktaufnahme" />
                    </flux:radio.group>
                    <div class="flex gap-6 flex-wrap">
                        <div class="w-full md:w-1/2-gap-6"><flux:input type="date" wire:model="event_start" label="Anlass beginnt am *" placeholder="Anlass beginnt am" /></div>
                        <div class="w-full md:w-1/2-gap-6"><flux:input type="date" wire:model="event_end" label="Anlass endet am *" placeholder="Anlass endet am" /></div>
                        <div class="w-full md:w-1/2-gap-6">
                            <flux:select wire:model="time_of_day" label="Tageszeit *" placeholder="Tageszeit" variant="listbox">
                                <flux:option value="whole_day">Ganzer Tag</flux:option>
                                <flux:option value="morning">Morgen</flux:option>
                                <flux:option value="noon">Mittag</flux:option>
                                <flux:option value="evening">Abend</flux:option>
                            </flux:select>
                        </div>
                        <div class="w-full md:w-1/2-gap-6">
                            <flux:input type="number" wire:model="guest_count" label="Anzahl Gäste ca. *" placeholder="Anzahl Gäste ca." />
                        </div>
                    </div>
                    <flux:input wire:model="event_place" label="Anlass Ort *" placeholder="Anlass Ort" />

                    <flux:textarea wire:model="description" label="Anlass Beschreibung *" placeholder="Anlass Beschreibung" rows="5"></flux:textarea>
                </div>
                <div class="lg:w-1/2-gap-6 space-y-6 mb-6">

                    <flux:heading size="xl" class="border-b pb-3 mb-3 !text-primary">Kontaktangaben</flux:heading>

                    <flux:input wire:model="company" label="Firma / Verein" placeholder="Firma / Verein" />
                    <flux:input wire:model="additional" label="Firmenzusatz" placeholder="Firmenzusatz" />
                    <div class="md:flex gap-6 space-y-6 md:space-y-0">
                        <div class="w-full md:w-1/2-gap-6">
                            <flux:input wire:model="firstname" label="Vorname *" placeholder="Vorname" />
                        </div>
                        <div class="w-full md:w-1/2-gap-6">
                            <flux:input wire:model="lastname" label="Nachname *" placeholder="Nachname" />
                        </div>
                    </div>
                    <flux:input wire:model="street" label="Strasse / Nr. *" placeholder="Strasse / Nr." />
                    <div class="md:flex gap-6 space-y-6 md:space-y-0">
                        <div class="md:max-w-[150px] w-full">
                            <flux:input type="number" min="1000" max="9999" wire:model="zip_code" label="PLZ *" placeholder="PLZ" />
                        </div>
                        <div class="flex-1">
                            <flux:input wire:model="city" label="Ort *" placeholder="Ort" />
                        </div>
                    </div>
                    <div class="md:flex gap-6 space-y-6 md:space-y-0">
                        <div class="w-full md:w-1/2-gap-6">
                            <flux:input type="email" wire:model="email" label="E-Mail *" placeholder="E-Mail" />
                        </div>
                        <div class="w-full md:w-1/2-gap-6">
                            <flux:input wire:model="phone" label="Telefon *" placeholder="Telefon" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="max-w-[300px] mx-auto">
                <flux:button type="submit" variant="primary" class="w-full my-3">Anfrage senden</flux:button>
            </div>
        </form>
    @endif
</div>