<?php

namespace App\Fieldtypes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Statamic\Entries\Collection;
use Statamic\Fields\Fieldtype;

class MakarisProductInfo extends Fieldtype
{
    public static $title = 'Makaris Produkt Infoblock';

    public $icon = 'eye';

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    public function preload(): array
    {
        $number = $this->field()->parent() instanceof Collection
            ? null
            : $this->field()->parent()->data()->get($this->config('product_number_fieldtype'));

        $product = $this->product($number);

        // censored

        return [];
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
                'display' => 'Feld für Produkte Nummer',
                'instructions' => 'Aus welchem Feld soll die Produkte-Nr. ausgelesen werden?',
                'type' => 'text',
                'default' => '',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Internals
    |--------------------------------------------------------------------------
    */

    private function distributionChannel(): string
    {
        if(! in_array($this->config('distribution_channel'), ['B2B', 'B2C'])) {
            throw new \ErrorException('Distribution channel is invalid: ' . $this->config('distribution_channel'));
        }

        return $this->config('distribution_channel');
    }

    private function product($number): null
    {
        if (!$number) {
            return null;
        }

        // censored

        return null;
    }
}
