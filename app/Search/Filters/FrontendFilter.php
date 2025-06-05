<?php

namespace App\Search\Filters;

class FrontendFilter
{
    public function handle($item)
    {
        return match((string) $item->collection?->handle) {
            'website' => $this->handleWebsite($item),
            'jura_professional' => $this->handleJuraProfessional($item),
            'jura_household' => $this->handleJuraHousehold($item),
            default => false,
        };
    }

    private function handleWebsite($item): bool
    {
        return $item->status() === 'published' && ! $item->exclude_from_search;
    }

    private function handleJuraHousehold($item): bool
    {
        $makarisProduct = \Makaris::findB2B($item->makaris_product_number, 'quote_jura_machine_' . $item->id);

        return $item->status() === 'published' && ! $item->exclude_from_search && $makarisProduct;
    }

    private function handleJuraProfessional($item): bool
    {
        $makarisProduct = \Makaris::findB2B($item->makaris_product_number, 'quote_jura_machine_' . $item->id);

        return $item->status() === 'published' && ! $item->exclude_from_search && $makarisProduct;
    }
}