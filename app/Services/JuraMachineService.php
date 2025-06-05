<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Statamic\Statamic;
use Swissbrain\Makaris\Models\ProductB2B;

class JuraMachineService
{
    public static function collection($category): array
    {
       return (new self)->getList($category);
    }

    public function getList($category): array
    {
        $juraMachineList = Statamic::tag('collection:jura_' . $category)->fetch();
        $productNumberList = $juraMachineList->pluck('makaris_product_number')->unique();
        $originProducts = Cache::remember('jura_machine_list_' . $category, 60, fn() => collect(ProductB2B::find($productNumberList->toArray())));

        $list = [];

        foreach($juraMachineList as $juraMachine) {
            $originProduct = $originProducts->firstWhere('number', $juraMachine->makaris_product_number);

            // show only products if it is active in makaris
            if ($originProduct && $juraMachine->product_line) {
                $key = 'product_line_' . $juraMachine->product_line->id;

                if (! array_key_exists($key, $list)) {
                    $list[$key] = [
                        'lineId' => $juraMachine->product_line->id,
                        'lineName' => $juraMachine->product_line->title,
                        'lineDescription' => $juraMachine->product_line->description,
                        'items' => [],
                    ];
                }

                $list[$key]['items'][] = $juraMachine;
            }
        }

        return $list;
    }
}