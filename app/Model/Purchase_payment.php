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

    	'purchase_id'    => 'numeric|nullable',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'string|max:50|nullable',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'numeric|nullable',
        'supplier_id'    => 'required|numeric',

    ];

    public static $validateUpdateRule = [

    	'purchase_id'    => 'numeric|nullable',
    	'date'           => 'required|string|max:10',
    	'invoice'        => 'string|max:50|nullable',
        'paid'           => 'required|numeric',
        'due'            => 'required|numeric',
        'user_id'        => 'numeric|nullable',
        'supplier_id'    => 'required|numeric',

    ];

    public function get_purchase_payments()
    {
    	$purchase_payment = DB::table('purchase_payments')
    					    ->leftJoin('suppliers', 'purchase_payments.supplier_id', '=', 'suppliers.id')
                            ->leftJoin('users', 'purchase_payments.user_id', '=', 'users.id')
                            ->select('purchase_payments.*','users.name as user', 'suppliers.name as supplier')
                     			->get();

        return $purchase_payment;
    }

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

    public function update_purchase_payment($request, $id)
    {
        $purchase_payment = $this::findOrFail($id);
        $purchase_payment->date           = date('Y-m-d', strtotime($request->date));
        $purchase_payment->purchase_id    = $request->purchase_id;
        $purchase_payment->invoice        = $request->invoice;
        $purchase_payment->paid           = $request->paid;
        $purchase_payment->due            = $request->due;
        $purchase_payment->user_id        = $request->user_id;
        $purchase_payment->supplier_id    = $request->supplier_id;
        $purchase_payment->payment_method = 1;

        $purchase_payment_update = $purchase_payment->save();

        if ($purchase_payment_update) {

            Session::flash('message', 'Purchase Payment Update Successfully!');

        } else {

            Session::flash('message', 'Purchase Payment Update Failed!');
        }
    }

    public function delete_purchase_payment($id)
    {
        $purchase_payment_delete = $this::where('id', $id)->delete();

        if ($purchase_payment_delete) {

            Session::flash('message', 'Purchase Payment Deleted Successfully!');

        } else {

            Session::flash('message', 'Purchase Payment Delete Failed!');
        }
    }
}
