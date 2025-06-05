<?php

namespace App\Rules;

use App\Models\Auth\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Swissbrain\Makaris\Enums\SectionTypeEnum;
use Swissbrain\Makaris\Models\ProductB2B;
use Swissbrain\Makaris\Models\ProductB2C;

class MakarisProductExistRule implements ValidationRule
{
    public function __construct(public $distributionChannel = 'B2C')
    {

    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value && $this->distributionChannel == 'B2B' && ! ProductB2B::find($value)) {
            $fail($this->distributionChannel . ' Produkt  mit Artikel-Nr. ' . $value . ' ist in makaris deaktiviert oder existiert nicht.');
        }

        if ($value && $this->distributionChannel == 'B2C' && ! ProductB2C::find($value)) {
            $fail($this->distributionChannel . ' Produkt  mit Artikel-Nr. ' . $value . ' ist in makaris deaktiviert oder existiert nicht.');
        }
    }
}
