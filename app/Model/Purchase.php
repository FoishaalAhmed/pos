<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [

    	'date', 'invoice', 'user_id','supplier_id', 'subtotal', 'vat_percentage','vat', 'extra_cost', 'discount_percentage','discount', 'total', 'note',
    ];
}
