<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;


class Sale_payment extends Model
{
    protected $fillable = [
    	'sale_id', 'date', 'invoice', 'paid', 'due', 'user_id', 'customer_id', 'payment_method', 
    ];

    public static $validateStoreRule = [

    	'sale_id'        => 'required|numeric',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'required|string|max:50',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'required|numeric',
        'customer_id'    => 'required|numeric',

    ];

    public static $validateUpdateRule = [

    	'sale_id'    => 'required|numeric',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'required|string|max:50',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'required|numeric',
        'customer_id'    => 'required|numeric',

    ];

    public function get_sale_payment_by_sale_id($sale_id)
    {
    	$sale_payment = DB::table('sale_payments')
    							->select('sale_payments.id','sale_payments.date','sale_payments.invoice','sale_payments.paid','sale_payments.due')
                     			->get();

        return $sale_payment;
    }

    public function store_sale_payment($request)
    {
    	
        $this->date           = date('Y-m-d', strtotime($request->date));
        $this->sale_id        = $request->sale_id;
        $this->invoice        = $request->invoice;
        $this->paid           = $request->paid;
        $this->due            = $request->due;
        $this->user_id        = $request->user_id;
        $this->customer_id    = $request->customer_id;
        $this->payment_method = 1;

        $sale_payment = $this->save();

        if ($sale_payment) {

            Session::flash('message', 'New Sale Payment Successfully!');

        } else {

            Session::flash('message', 'Sale Payment Failed!');
        }
    }
}
