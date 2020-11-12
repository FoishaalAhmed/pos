<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase_detail extends Model
{
    protected $fillable = [
    	'purchase_id', 'invoice', 'product_id', 'quantity', 'rate', 'total',
    ];
}
