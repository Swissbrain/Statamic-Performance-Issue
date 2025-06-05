@extends('layouts.site')

@section('content')
    @php($juraMachine = $quote->items()->firstWhere('type', 'jura_machine'))
    <flux:container>
        <x-title title="Bestätigung Ihrer Offert-Anfrage #{{ $quote->makaris_quote_number }}" position="center" class="my-12"/>
        <div class="wysiwyg text-center no-print mb-12">
            <p>Herzlichen Dank für das Einreichen der Anfrage der gewünschte Offerte.<br></p>
        </div>

        <div class="flex gap-12 mt-12 flex-col md:flex-row">
            <div class="w-full md:w-1/3-gap-12 flex flex-wrap gap-12 ">
                <div class="w-1/2-gap-12 md:w-full">
                    <div class="font-bold text-xl mb-3 pb-3 border-b-2 border-b-primary">Ihre Anfrage</div>
                    <table>
                        <tr>
                            <th class="text-start pe-6 align-text-top">Referenz-Nr.</th>
                            <td>{{ $quote->makaris_quote_number }}</td>
                        </tr>
                        <tr>
                            <th class="text-start pe-6 align-text-top">Datum</th>
                            <td>{{ $quote->confirmed_at->format('d.m.Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-start pe-6 align-text-top">Jura Maschine</th>
                            <td>
                                {{ $juraMachine->name }}<br>
                                <small class="text-gray-500">Art. Nr. {{ $juraMachine->product_number }}</small>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="w-1/2-gap-12 md:w-full">
                    <div class="font-bold text-xl mb-3 pb-3 border-b-2 border-b-primary">Kontaktangaben</div>
                    @if ($quote->company)
                        <div class="font-semibold">{{ $quote->company }}</div>
                        <div>{{ $quote->first_name }} {{ $quote->last_name }}</div>
                    @else
                        <div class="font-semibold">{{ $quote->first_name }} {{ $quote->last_name }}</div>
                    @endif
                    <div>{{ $quote->street }}</div>
                    <div>CH-{{ $quote->zip_code }} {{ $quote->city }}</div>
                    <div class="mt-3">{{ $quote->email }}</div>
                    @if($quote->phone)
                        <div>{{ $quote->phone }}</div>
                    @endif
                </div>
            </div>

            <div class="w-full md:w-2/3-gap-12">
                <div class="font-bold text-xl mb-3 pb-3 border-b-2 border-b-primary">Ihr gewünschtes Angebot</div>
                <div class="flex gap-3 flex-wrap">
                    @php($juraMachineItem = $quote->items->firstWhere('type', 'jura_machine'))

                    <div class="w-full">
                        <x-quote.summary-row :title="$juraMachineItem->name"
                                             :subtitle="$juraMachineItem->description"
                                             :image="$juraMachineItem->image_url ? glide($juraMachineItem->image_url, 100,100, 'contain') : null"
                                             :price="$juraMachineItem->selling_price"
                                             :product-number="$juraMachineItem->product_number"
                                             :show-type-number="true"
                        />
                    </div>

                    @foreach($quote->items->where('type', '!=', 'jura_machine') as $item)
                        <div class="w-full">
                            <x-quote.summary-row :title="$item->name"
                                                 :type="$item->makaris_type"
                                                 :subtitle="$item->description"
                                                 :price="$item->selling_price"
                                                 :image="$item->image_url ? glide($item->image_url, 100,100, 'contain') : null"
                                                 :product-number="$item->product_number"
                                                 :amount="$item->amount" />
                        </div>
                    @endforeach
                </div>

                <div class="text-end font-bold text-xl border-t pt-3 mt-3">{{ currency_format($quote->calcTotal(), shortcut: false) }}</div>
                <div class="text-end text-gray-400">Inkl. MwSt.</div>
            </div>
        </div>
        <div class="my-12 text-end">
            <flux:button icon="arrow-left" href="{{ route('statamic.site') }}" class="no-print me-3">Zurück zur Startseite</flux:button>
            <flux:button icon="printer" onclick="window.print()" class="no-print" variant="primary">Drucken</flux:button>
        </div>

        <div class="text-center border-t my-3 bg-primary text-white py-3 text-xs print-only">
            <div class="flex justify-center">
                <div class="border-r border-white px-2">{{ $company['company_name'] }}</div>
                <div class="border-r border-white px-2">{{ $company['street'] }}</div>
                <div class="border-r border-white px-2">CH-{{ $company['zip_code'] }} {{ $company['city'] }}</div>
                <div class="border-r border-white px-2">{{ $company['email'] }}</div>
                <div class="px-2">{{ $company['phone_number'] }}</div>
            </div>
        </div>
    </flux:container>
@endsection