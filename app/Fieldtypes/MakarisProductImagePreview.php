<?php

namespace App\Fieldtypes;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Statamic\Fields\Fieldtype;

class MakarisProductImagePreview extends Fieldtype
{
    public static $title = 'Makaris Produkte Bild Vorschau';

    public $icon = 'images';

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    public function preload(): array
    {
        $list = [];
        $number = $this->field()->parent() instanceof \Statamic\Entries\Collection
            ? null
            : $this->field()->parent()->data()->get($this->config('product_number_fieldtype'));

        $product = $this->product($number);

        if ($number && $product && count($product->images)) {
            $list = collect($product->images)->pluck('thumbnail')->toArray();
        }

        return [
            'images' => $list,
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
            'product_number_fieldtype' => [
                'display' => 'Produkte-Nr. Feld',
                'instructions' => 'Von welchem Feld soll die Produkte-Nr. ausgelesen werden?',
                'type' => 'text',
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

    private function product($productNumber): null
    {
        if (!$productNumber) {
            return null;
        }

        // censored

        return null;
    }
}
