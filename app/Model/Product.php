<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'photo', 'description', 'vat', 'buy_price', 'sell_price',
    ];
}
