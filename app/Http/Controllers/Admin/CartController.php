<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Cart;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {
    	$productCode = $request->productCode;
    	$product     = DB::table('products')->where('product_code', $productCode)->select('id', 'name', 'buy_price', 'sell_price')->first();

        echo json_encode($product);
    }

    public function subtotal()
    {
    	$subtotal = Cart::subtotal();

        $subtotal2 = str_replace(',', '', $subtotal);

    	echo $subtotal2;
    }
}
