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
                        ->where('sale_details.sale_id', $sale_id)
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

    public function get_todays_profit($today)
    {
        $sale_details = DB::table('sale_details')
                     ->leftJoin('products', 'sale_details.product_id', '=', 'products.id')
                     ->where(DB::raw('date(sale_details.invoice)'), $today)
                     ->select('sale_details.quantity','sale_details.total','products.buy_price')
                     ->get();
        return $sale_details;
    }
}
