<?php

namespace App\Livewire;

use App\Models\Quote;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Statamic\Entries\Entry;

class QuoteConfigurator extends Component
{
    #[Locked]
    public $juraMachineId;

    #[Locked]
    public Quote $quote;

    #[Locked]
    public $message;

    public bool $catalogueShowMore = false;

    public $company;
    public $firstName;
    public $lastName;
    public $street;
    public $zipCode;
    public $city;
    public $email;
    public $phone;
    public $remarks;
    public $terms;

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    public function render(): View
    {
        $juraMachine = Entry::findOrFail($this->juraMachineId);

        return view('livewire.quote-configurator', [
            'juraMachine' => $juraMachine,
            'makarisProduct' => \Makaris::findB2B($juraMachine->makaris_product_number, 'quote_jura_machine_' . $this->quote->id),
        ]);
    }

    public function rules(): array
    {
        return [
            'company' => 'nullable|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'street' => 'required|string',
            'zipCode' => 'required|integer|min:1000|max:9999',
            'city' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'terms' => 'accepted',
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'company' => 'Firma',
            'firstName' => 'Vorname',
            'lastName' => 'Nachname',
            'street' => 'Strasse',
            'zipCode' => 'PLZ',
            'city' => 'Ort',
            'email' => 'E-Mail',
            'phone' => 'Telefon',
            'remarks' => 'Bemerkungen',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function remove($id): void
    {
        $item = $this->quote->items()->where('product_number', $id)->orderByDesc('selling_price')->first();

        if ($item && $item->amount == 1) {
            $item->delete();
            return;
        }

        if ($item) {
            $item->decrement('amount');
        }
    }

    public function removePosition($id): void
    {
        $item = $this->quote->items()->firstWhere('id', $id);

        if ($item && $item->type != 'product') {
            $item->delete();
        }
    }

    public function add($id): void
    {
        $itemWithPrice = $this->quote->items()->where('product_number', $id)->where('selling_price', '>', 0)->first();

        if ($itemWithPrice) {
            $itemWithPrice->increment('amount');
            return;
        }

        $itemWithoutPriceExists = $this->quote->items()->where('product_number', $id)->where('selling_price', 0)->exists();

        $catalogueItem = $this->catalogue[$id];
        $makarisProduct = \Makaris::findB2B($id, 'quote_jura_machine_' . $this->quote->id .'_product_' . $id);

        $data = [
            'name' => $catalogueItem['title'] ?: $makarisProduct->name,
            'product_number' => $makarisProduct->number,
            'description' => $catalogueItem['description'],
            'selling_price' => round($makarisProduct->sellingPrice, 2),
            'image_url' => collect($makarisProduct->images)->pluck('original')->first(),
            'is_required' => false,
            'amount' => 1,
        ];

        if (!$itemWithoutPriceExists && $catalogueItem['is_free']) {
            $data['selling_price'] = 0;
        }

        $this->quote->items()->create($data);
        $this->quote->fresh();
    }

    public function toggleCatalogue(): void
    {
        $this->catalogueShowMore = !$this->catalogueShowMore;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->quote->confirmed_at) {
            return;
        }

        $this->quote->update([
            'company' => $this->company,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'street' => $this->street,
            'zip_code' => $this->zipCode,
            'city' => $this->city,
            'email' => $this->email,
            'phone' => $this->phone,
            'remarks' => strip_tags(str_replace("\n", ' ', $this->remarks)),
        ]);

        try {
           if ($order = $this->quote->transmitToMakaris()) {
                $this->quote->update([
                    'confirmed_at' => now(),
                    'makaris_quote_id' => $order->id,
                ]);

                Mail::to($this->quote->email)
                    ->bcc('msc@kafi.ch', 'technik@swissbrain.ch')
                    ->send(new \App\Mail\QuoteMail($this->quote));

                session()->forget('quote_jura_machine_' . $this->juraMachineId);

                $this->redirectRoute('quote.confirmed', $this->quote->uuid);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
        }

        $this->message = 'Etwas ist schief gelaufen. Bitte versuchen Sie es erneut.';
    }

    /*
    |--------------------------------------------------------------------------
    | Computed Attributes
    |--------------------------------------------------------------------------
    */

    #[Computed]
    public function catalogue(): Collection
    {
        $juraMachine = Entry::findOrFail($this->juraMachineId);
        $list = [];
        $productNumbers = [];

        foreach($juraMachine->catalogue as $item) {
            if (!$item['is_required'] && $item['type'] == 'product') {
                $productNumbers[] = $item['product'];
            }
        }

        $makarisProductList = \Makaris::findB2B($productNumbers, 'quote_catalogue_' . $juraMachine->id);

        foreach($juraMachine->catalogue as $item) {
            if (!$item['is_required'] && $item['type'] == 'product') {
                $product = $makarisProductList->firstWhere('number', $item['product']);

                if ($product) {
                    $list[$item['product']] = [
                        'image_url' => collect($product->images)->pluck('original')->first()
                            ? glide(collect($product->images)->pluck('original')->first(), 100, 100, 'contain')
                            : null,
                        'title' => $item['title'] ?: $product->name,
                        'description' => $item['description'],
                        'product_number' => $item['product'],
                        'is_free' => $item['is_free'],
                        'selling_price' => $product->sellingPrice,
                    ];
                }
            }
        }

        return collect($list);
    }

    #[Computed]
    public function termsAndConditions()
    {
        $entryId = \Statamic\Facades\GlobalSet::findByHandle('configuration')->inCurrentSite()->get('tos_entry');

        return \Statamic\Facades\Entry::find($entryId)?->url();
    }

    #[Computed]
    public function privacyStatement()
    {
        $entryId = \Statamic\Facades\GlobalSet::findByHandle('configuration')->inCurrentSite()->get('privacy_statement_entry');

        return \Statamic\Facades\Entry::find($entryId)?->url();
    }
}
