<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Swissbrain\Makaris\Enums\LanguageEnum;
use Swissbrain\Makaris\Enums\OrderShippingMethodEnum;
use Swissbrain\Makaris\Models\ContractAddress;
use Swissbrain\Makaris\Models\ContractProduct;
use Swissbrain\Makaris\Models\Order;
use Swissbrain\Makaris\Models\Quote as MakarisQuote;

class Quote extends Model
{
    protected $fillable = [
        'uuid',
        'company',
        'first_name',
        'last_name',
        'street',
        'zip_code',
        'city',
        'email',
        'phone',
        'remarks',
        'confirmed_at',
        'makaris_quote_id',
        'makaris_quote_number',
        'makaris_quote_version_id',
        'makaris_quote_version_number',
        'view_counter',
        'email_confirmed_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'confirmed_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        self::creating(
            fn (self $quote) => $quote->uuid = str_replace('-', '', (string) \Str::uuid())
        );
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return \Str::length($value) == 32
            ? self::where('uuid', '=', $value)->firstOrFail()
            : self::where('id', '=', $value)->firstOrFail();
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function transmitToMakaris(): ?Order
    {
        $quote = MakarisQuote::create();
        $address = ContractAddress::make([
            'company' => $this->company,
            'firstname' => $this->first_name,
            'lastname' => $this->last_name,
            'street' => $this->street,
            'zipCode' => $this->zip_code,
            'city' => $this->city,
            'countryCode' => 'CH',
            'email' => $this->email,
        ]);

        if ($this->phone) {
            $address->setPhone(preg_replace('/[^0-9+]/', '', $this->phone));
        }

        $quote->setShippingMethod(OrderShippingMethodEnum::ON_ORDER)
            ->setCustomerAddress($address)
            ->setDeliveryAddress($address)
            ->setDefaultLanguage(LanguageEnum::GERMAN)
            ->setVoidAt(now()->addMonths(2))
            ->setShippingRemarks($this->remarks)
            ->setSource('CMS');

        $this->addItemsForMakaris($quote);

        $order = $quote->save();

        $this->update([
            'makaris_quote_id' => $order->id,
            'makaris_quote_number' => $order->number,
            'makaris_quote_version_id' => $order->versionId,
            'makaris_quote_version_number' => $order->versionNumber,
        ]);

        return $order;
    }

    private function addItemsForMakaris(MakarisQuote &$quote): void
    {
        foreach($this->items as $item) {
            if ($item->makaris_type == 'product') {
                $quote->addProduct(ContractProduct::make([
                    'articleId' => $item->product_number,
                    'quantity' => $item->amount,
                    'nameDE' => $item->name,
                    'nameFR' => $item->name,
                    'nameEN' => $item->name,
                    'nameIT' => $item->name,
                    'descriptionDE' => $item->description,
                    'descriptionFR' => $item->description,
                    'descriptionEN' => $item->description,
                    'descriptionIT' => $item->description,
                ]));
            }

            if ($item->makaris_type == 'activity') {
                $quote->addActivity($item->makaris_id);
            }

            if ($item->makaris_type == 'expense_type') {
                $quote->addExpenseType($item->makaris_id);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function calcTotal(): float
    {
        $total = 0;

        foreach($this->items as $item) {
            $total += round($item->selling_price * $item->amount, 2);
        }

        return $total;
    }

    public function publicLink(): string
    {
        return route('quote.confirmed', $this->uuid);
    }

    public function juraMachine(): QuoteItem
    {
        return $this->items->firstWhere('type', 'jura_machine');
    }
}
