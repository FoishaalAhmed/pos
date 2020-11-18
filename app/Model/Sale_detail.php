<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Sale_detail extends Model
{
    protected $fillable = [
    	'sale_id', 'invoice', 'product_id', 'quantity', 'rate', 'total',
    ];

    public function get_sale_detail_by_sale_id($sale_id)
    {
    	$sale_details = DB::table('sale_details')
                     ->leftJoin('products', 'sale_details.product_id', '=', 'products.id')
                     ->select('sale_details.id', 'sale_details.invoice', 'sale_details.quantity','sale_details.rate','sale_details.total','products.name as product')
                     ->get();
        return $sale_details;
    }

    public function get_sale_quantity()
    {
        $sales = DB::table('sale_details')
                     ->groupBy('sale_details.product_id')
                     ->select('sale_details.id', DB::raw('SUM(sale_details.quantity) as sale_quantity'))
                     ->get();

        return $sales;
    }
}
