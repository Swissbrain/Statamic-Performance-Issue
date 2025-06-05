<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Swissbrain\Makaris\Models\Activity;
use Swissbrain\Makaris\Models\ExpenseType;
use Swissbrain\Makaris\Models\ProductB2B;
use Swissbrain\Makaris\Models\ProductB2C;

class MakarisService
{
    public static function findB2B($number, $cacheKey = null)
    {
        if (!$number) {
            return null;
        }

        if ($cacheKey) {
            return Cache::remember($cacheKey, 600, fn() => ProductB2B::find($number));
        }

        return ProductB2B::find($number);
    }

    public static function findB2C($number, $cacheKey = null)
    {
        if (!$number) {
            return null;
        }

        if ($cacheKey) {
            return Cache::remember($cacheKey, 600, fn() => ProductB2C::find($number));
        }

        return ProductB2B::find($number);
    }

    public static function allExpenseTypes()
    {
        return Cache::remember('makaris.expense_types.b2b.all', 60, fn() => ExpenseType::all());
    }

    public static function findExpenseType($id, $cacheKey = null)
    {
        if (!$id) {
            return null;
        }

        if ($cacheKey) {
            return Cache::remember($cacheKey, 600, fn() => ExpenseType::find($id));
        }

        return ExpenseType::find($id);
    }

    public static function allActivities()
    {
        return Cache::remember('makaris.activity.b2b.all', 60, fn() => Activity::all());
    }

    public static function findActivity($id, $cacheKey = null)
    {
        if (!$id) {
            return null;
        }

        if ($cacheKey) {
            return Cache::remember($cacheKey, 600, fn() => Activity::find($id));
        }

        return Activity::find($id);
    }
}