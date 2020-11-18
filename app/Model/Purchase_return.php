<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Purchase_return extends Model
{
    protected $fillable = [
    	'date', 'purchase_id', 'supplier_id','invoice', 'product_id','quantity', 'user_id',
    ];

    public static $validateStoreRule = [

        'date'        => 'required|string|max:10',
        'invoice'     => 'required|string|max:50',
        'user_id'     => 'numeric|nullable',
        'supplier_id' => 'required|numeric',
        'product_id'  => 'required|numeric',
        'quantity'    => 'required|numeric',
    ];

    public function get_purchase_return()
    {
    	$purchase_payment = DB::table('purchase_returns')
    					    ->leftJoin('products', 'purchase_returns.product_id', '=', 'products.id')
    					    ->leftJoin('suppliers', 'purchase_returns.supplier_id', '=', 'suppliers.id')
                            ->leftJoin('users', 'purchase_returns.user_id', '=', 'users.id')
                            ->select('purchase_returns.id', 'purchase_returns.quantity', 'purchase_returns.date', 'users.name as user', 'suppliers.name as supplier', 'products.name as product')
                     			->get();
        return $purchase_payment;
    }

    public function store_purchase_return($request)
    {
    	$this->date                = date('Y-m-d', strtotime($request->date));
        $this->purchase_id         = $request->purchase_id;
        $this->invoice             = $request->invoice;
        $this->user_id             = $request->user_id;
        $this->supplier_id         = $request->supplier_id;
        $this->product_id          = $request->product_id;
        $this->quantity            = $request->quantity;
        $purchase_returns          = $this->save();

        if ($purchase_returns) {

            Session::flash('message', 'Purchase Returns Successful!');

        } else {

            Session::flash('message', 'Purchase Returns Failed!');
        }
    }

    public function delete_purchase_return($id)
    {
    	$purchase_return_delete = $this::where('id', $id)->delete();

        if ($purchase_return_delete) {

            Session::flash('message', 'Purchase Return Deleted Successfully!');

        } else {

            Session::flash('message', 'Purchase Return Delete Failed!');
        }
    }
}
