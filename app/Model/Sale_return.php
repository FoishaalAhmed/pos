<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale_return extends Model
{
    protected $fillable = [
    	'date', 'sale_id', 'customer_id','invoice', 'product_id','quantity', 'user_id',
    ];
}
}
