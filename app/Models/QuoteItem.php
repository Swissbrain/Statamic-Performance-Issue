<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteItem extends Model
{
    protected $fillable = [
        'quote_id',
        'name',
        'type',
        'description',
        'product_number',
        'selling_price',
        'image_url',
        'is_required',
        'amount',
        'makaris_type',
        'makaris_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
