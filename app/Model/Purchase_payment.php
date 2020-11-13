<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Purchase_payment extends Model
{
    protected $fillable = [
    	'purchase_id', 'date', 'invoice', 'paid', 'due', 'user_id', 'supplier_id', 'payment_method', 
    ];

    public static $validateStoreRule = [

    	'purchase_id'    => 'required|numeric',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'required|string|max:50',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'required|numeric',
        'supplier_id'    => 'required|numeric',

    ];

    public static $validateUpdateRule = [

    	'purchase_id'    => 'required|numeric',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'required|string|max:50',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'required|numeric',
        'supplier_id'    => 'required|numeric',

    ];

    public function get_purchase_payment_by_purchase_id($purchase_id)
    {
    	$purchase_payment = DB::table('purchase_payments')
    							->select('purchase_payments.id','purchase_payments.date','purchase_payments.invoice','purchase_payments.paid','purchase_payments.due')
                     			->get();

        return $purchase_payment;
    }

    public function store_purchase_payment($request)
    {
    	
        $this->date           = date('Y-m-d', strtotime($request->date));
        $this->purchase_id    = $request->purchase_id;
        $this->invoice        = $request->invoice;
        $this->paid           = $request->paid;
        $this->due            = $request->due;
        $this->user_id        = $request->user_id;
        $this->supplier_id    = $request->supplier_id;
        $this->payment_method = 1;

        $purchase_payment = $this->save();

        if ($purchase_payment) {

            Session::flash('message', 'New Purchase Payment Successfully!');

        } else {

            Session::flash('message', 'Purchase Payment Failed!');
        }
    }
}
