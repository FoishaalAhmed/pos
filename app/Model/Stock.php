<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Stock extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'unit',
    ];

    public function get_stock()
    {
    	$stocks = DB::table('stocks')
                     ->leftJoin('products', 'stocks.product_id', '=', 'products.id')
                     ->groupBy('stocks.product_id')
                     ->select('stocks.id',DB::raw('SUM(stocks.quantity) as total_quanity'), 'stocks.unit', 'products.name as product')
                     ->get();

        return $stocks;
    }
}
