<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request)
    {
    	$product_id = $request->product_id;
    	$quantity   = $request->quantity;
    	$rate       = $request->rate;
    	$total      = $request->total;
    	$unit       = $request->unit;

    	$product = Product::findOrFail($product_id);

    	if ($product) {
    		//Cart::destroy();
    		Cart::add(['id' => $product_id, 'name' => $product->name, 'qty' => $quantity, 'price' => $rate, 'weight' => $total ]);

	    	$cart = Cart::content();

	    	return view('cart', compact('cart'));

    	} else {

    		$success_output = '<div class="alert alert-danger"> Product Not Found! </div>';
    		echo $success_output;
    	}	
    }

    public function subtotal()
    {
    	$subtotal = Cart::subtotal();

    	echo $subtotal;
    }
}
