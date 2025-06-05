<?php

namespace App\Fieldtypes;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Statamic\Fields\Fieldtype;

class MakarisProduct extends Fieldtype
{
    public static $title = 'Makaris Produkt';

    public $icon = 'tags';

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    public function preload(): array
    {
        $products = $this->productList();

        $list = [];

        foreach($products as $product) {
            $list[] = [
                'number' => $product->number,
                'name' =>  $product->name,
                'image' => $product->originalImageSrc(),
                'price' => currency_format($product->sellingPrice),
            ];
        }

        return [
            'articles' => $list,
            'entry_id' => $this->field()->parent()->id,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Configuration Attributes
    |--------------------------------------------------------------------------
    */

    protected function configFieldItems(): array
    {
        return [
            'distribution_channel' => [
                'display' => 'Produkt Typ',
                'instructions' => 'Welche Produkte sollen ausgelesen werden? B2B vs B2C',
                'type' => 'select',
                'default' => 'B2C',
                'options' => [
                    'B2B' => 'B2B',
                    'B2C' => 'B2C',
                ],
                'width' => 50
            ],
            'disable_editing' => [
                'display' => 'Bearbeiten verhindern',
                'instructions' => 'Soll der Wert nach dem Erstellen unveränderbar bleiben?',
                'type' => 'toggle',
                'default' => false,
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Internals
    |--------------------------------------------------------------------------
    */

    private function distributionChannel(): string
    {
        return in_array($this->config('distribution_channel'), ['B2B', 'B2C'])
            ? $this->config('distribution_channel')
            : 'B2C';
    }

    private function productList(): Collection
    {
        // censored

        return collect();
    }
}
