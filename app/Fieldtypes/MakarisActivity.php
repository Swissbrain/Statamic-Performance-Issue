<?php

namespace App\Fieldtypes;

use Statamic\Fields\Fieldtype;

class MakarisActivity extends Fieldtype
{
    public static $title = 'Makaris Tätigkeit';

    public $icon = 'tags';

    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    */

    public function preload(): array
    {
        $list = [];

        // censored

        return [
            'activities' => $list,
        ];
    }
}
