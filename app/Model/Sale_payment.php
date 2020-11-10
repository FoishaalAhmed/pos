<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale_payment extends Model
{
    protected $fillable = [
    	'sale_id', 'date', 'invoice', 'paid', 'due', 'user_id', 'customer_id', 'payment_method', 
    ];
}
