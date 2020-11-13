<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Purchase_detail extends Model
{
    protected $fillable = [
    	'purchase_id', 'invoice', 'product_id', 'quantity', 'rate', 'total',
    ];

    public function get_purchase_detail_by_purchase_id($purchase_id)
    {
    	$purchase_details = DB::table('purchase_details')
                     ->leftJoin('products', 'purchase_details.product_id', '=', 'products.id')
                     ->select('purchase_details.invoice','purchase_details.quantity','purchase_details.rate','purchase_details.total','products.name as product')
                     ->get();
        return $purchase_details;
    }
}
