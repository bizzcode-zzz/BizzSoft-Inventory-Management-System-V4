<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    // 🏛️ SAKTONG GAYA NG SA PRODUCT MO: Proteksyon sa mass assignment
    protected $fillable = [
        'supplier_id',
        'product_id',
        'quantity',
        'cost_price',
        'purchase_date',
    ];

    /**
     * Ugnayan pabalik sa Supplier Model (Isang Purchase ay may isang Supplier)
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Ugnayan pabalik sa Product Model (Isang Purchase ay may isang Product)
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
