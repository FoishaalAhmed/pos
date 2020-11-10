<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase_return extends Model
{
    protected $fillable = [
    	'date', 'purchase_id', 'supplier_id','invoice', 'product_id','quantity', 'user_id',
    ];
}
