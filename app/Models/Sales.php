<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sales extends Model
{
    // Proteksyon sa mass assignment para sa apat na columns niyo
    protected $fillable = [
        'product_id',
        'quantity',
        'selling_price',
        'sales_date',
    ];

    /**
     * Ugnayan pabalik sa Product Model (Isang Sales record ay may isang Product)
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
