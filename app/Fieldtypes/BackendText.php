<?php

namespace App\Fieldtypes;

use Statamic\Fields\Fieldtype;

class BackendText extends Fieldtype
{
    public static $title = 'Text für Backend';

    public $icon = 'text';

    public function preload(): array
    {
        return [
            'description' => $this->config('description')
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
            'description' => [
                'display' => 'Beschreibung',
                'instructions' => 'Welcher Text soll im Backend (CP) erscheinen?',
                'type' => 'textarea',
            ],
        ];
    }
}
