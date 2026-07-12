<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
  protected $fillable = [
    'name',
    'price',
    'stock',
    'reorder_level',
    'category_id',
];

public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);
}
}
