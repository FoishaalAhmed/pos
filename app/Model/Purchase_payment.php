<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase_payment extends Model
{
    protected $fillable = [
    	'purchase_id', 'date', 'invoice', 'paid', 'due', 'user_id', 'supplier_id', 'payment_method', 
    ];
}
