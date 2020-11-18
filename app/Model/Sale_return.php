<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Sale_return extends Model
{
    protected $fillable = [
    	'date', 'sale_id', 'customer_id','invoice', 'product_id','quantity', 'user_id',
    ];

    public static $validateStoreRule = [

        'date'        => 'required|string|max:10',
        'invoice'     => 'required|string|max:50',
        'user_id'     => 'numeric|nullable',
        'customer_id' => 'required|numeric',
        'product_id'  => 'required|numeric',
        'quantity'    => 'required|numeric',
    ];

    public function get_sale_return()
    {
    	$sale_payment = DB::table('sale_returns')
    					    ->leftJoin('products', 'sale_returns.product_id', '=', 'products.id')
    					    ->leftJoin('customers', 'sale_returns.customer_id', '=', 'customers.id')
                            ->leftJoin('users', 'sale_returns.user_id', '=', 'users.id')
                            ->select('sale_returns.id', 'sale_returns.quantity', 'sale_returns.date', 'users.name as user', 'customers.name as customer', 'products.name as product')
                     			->get();
        return $sale_payment;
    }

    public function store_sale_return($request)
    {
    	$this->date        = date('Y-m-d', strtotime($request->date));
        $this->sale_id     = $request->sale_id;
        $this->invoice     = $request->invoice;
        $this->user_id     = $request->user_id;
        $this->customer_id = $request->customer_id;
        $this->product_id  = $request->product_id;
        $this->quantity    = $request->quantity;
        $sale_returns      = $this->save();

        if ($sale_returns) {

            Session::flash('message', 'Sale Returns Successful!');

        } else {

            Session::flash('message', 'Sale Returns Failed!');
        }
    }

    public function delete_sale_return($id)
    {
    	$sale_return_delete = $this::where('id', $id)->delete();

        if ($sale_return_delete) {

            Session::flash('message', 'Sale Return Deleted Successfully!');

        } else {

            Session::flash('message', 'Sale Return Delete Failed!');
        }
    }
}

