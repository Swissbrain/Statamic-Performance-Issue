<?php

namespace App\Fieldtypes;

use Statamic\Fields\Fieldtype;

class MakarisExpenseType extends Fieldtype
{
    public static $title = 'Makaris Aufwand';

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
            'expenseTypes' => $list,
        ];
    }
}
