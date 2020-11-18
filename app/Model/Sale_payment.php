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

    	'sale_id'        => 'numeric',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'string|max:50',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'numeric|nullable',
        'customer_id'    => 'required|numeric',

    ];

    public static $validateUpdateRule = [

    	'sale_id'        => 'numeric',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'string|max:50',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'numeric',
        'customer_id'    => 'required|numeric',

    ];

    public function get_sale_payment_by_sale_id($sale_id)
    {
    	$sale_payment = DB::table('sale_payments')
    							->select('sale_payments.id','sale_payments.date','sale_payments.invoice','sale_payments.paid','sale_payments.due')
                     			->get();

        return $sale_payment;
    }

    public function get_sale_payments()
    {
        $sale_payment = DB::table('sale_payments')
                            ->leftJoin('customers', 'sale_payments.customer_id', '=', 'customers.id')
                            ->leftJoin('users', 'sale_payments.user_id', '=', 'users.id')
                            ->select('sale_payments.*','users.name as user', 'customers.name as customer')
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

    public function update_sale_payment($request, $id)
    {
        $sale_payment                 = $this::findOrFail($id);
        $sale_payment->date           = date('Y-m-d', strtotime($request->date));
        $sale_payment->sale_id        = $request->sale_id;
        $sale_payment->invoice        = $request->invoice;
        $sale_payment->paid           = $request->paid;
        $sale_payment->due            = $request->due;
        $sale_payment->user_id        = $request->user_id;
        $sale_payment->customer_id    = $request->customer_id;
        $sale_payment->payment_method = 1;

        $sale_payment_update = $sale_payment->save();

        if ($sale_payment_update) {

            Session::flash('message', 'Sale Payment Update Successfully!');

        } else {

            Session::flash('message', 'Sale Payment Update Failed!');
        }
    }

    public function delete_sale_payment($id)
    {
        $sale_payment_delete = $this::where('id', $id)->delete();

        if ($sale_payment_delete) {

            Session::flash('message', 'Sale Payment Deleted Successfully!');

        } else {

            Session::flash('message', 'Sale Payment Delete Failed!');
        }
    }
}
