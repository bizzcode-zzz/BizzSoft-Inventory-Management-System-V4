<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // Saktong gaya ng sa Product mo, proteksyon sa mass assignment
    protected $fillable = [
        'supplier_name',
        'contact_person',
        'phone_number',
        'email',
        'address',
    ];
}
