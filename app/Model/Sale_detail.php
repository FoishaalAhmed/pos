<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale_detail extends Model
{
    protected $fillable = [
    	'sale_id'; 'invoice'; 'product_id'; 'quantity'; 'rate'; 'total';
    ];
}
