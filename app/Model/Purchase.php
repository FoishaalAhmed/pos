<?php

namespace App\Model;

use App\Model\Purchase_detail;
use App\Model\Purchase_payment;
use Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Session;


class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = [

    	'date', 'invoice', 'user_id','supplier_id', 'subtotal', 'vat_percentage','vat', 'extra_cost', 'discount_percentage','discount', 'total', 'note',
    ];

    public static $validateStoreRule = [

        'date'                => 'required|string|max:10',
        'note'                => 'required|string',
        'invoice'             => 'required|string|max:50',
        'user_id'             => 'required|numeric',
        'supplier_id'         => 'required|numeric',
        'extra_cost'          => 'numeric',
        'vat_percentage'      => 'numeric',
        'paid'                => 'required|numeric',
        'due'                 => 'required|numeric',
        'vat'                 => 'numeric|between:0,99999999999.99',
        'discount_percentage' => 'numeric',
        'discount'            => 'numeric|between:0,99999999999.99',
        'total'               => 'required|numeric|between:0,99999999999.99',
    ];

    public function get_purchases()
    {
    	$purchases = DB::table('purchases')
                     ->leftJoin('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
                     ->leftJoin('users', 'purchases.user_id', '=', 'users.id')
                     ->where('purchases.deleted_at', '=', NULL)
                     ->select('purchases.id','purchases.date','purchases.subtotal','purchases.total','purchases.note','users.name as user', 'suppliers.name as supplier')
                     ->get();

        return $purchases;
    }

    public function store_purchase($request)
    {

        $subtotal = str_replace(',', '', Cart::subtotal());

        $this->date                = date('Y-m-d', strtotime($request->date));
        $this->invoice             = $request->invoice;
        $this->user_id             = $request->user_id;
        $this->supplier_id         = $request->supplier_id;
        $this->subtotal            = $subtotal;
        $this->vat_percentage      = $request->vat_percentage;
        $this->vat                 = $request->vat;
        $this->extra_cost          = $request->extra_cost;
        $this->discount_percentage = $request->discount_percentage;
        $this->discount            = $request->discount;
        $this->note                = $request->note;
        $this->total               = $request->total;
        $purchases                 = $this->save();

        $purchase_id               = $this->id;


        $cart = Cart::content();

        foreach ($cart as $key => $value) {

            $purchase_details = new Purchase_detail;
            $purchase_details->purchase_id = $purchase_id;
            $purchase_details->invoice     = $request->invoice;
            $purchase_details->product_id  = $value->id;
            $purchase_details->quantity    = $value->qty;
            $purchase_details->rate        = $value->price;
            $purchase_details->total       = $value->total;
            $purchase_details->save();
        }

        foreach ($cart as $key => $value) {

            $Stock = new Stock;
            $Stock->product_id  = $value->id;
            $Stock->quantity    = $value->qty;
            $Stock->unit        = 'piece';
            $Stock->save();
        }

        $purchase_payments = new Purchase_payment;

        $purchase_payments->date           = date('Y-m-d', strtotime($request->date));
        $purchase_payments->purchase_id    = $purchase_id;
        $purchase_payments->invoice        = $request->invoice;
        $purchase_payments->paid           = $request->paid;
        $purchase_payments->due            = $request->due;
        $purchase_payments->user_id        = $request->user_id;
        $purchase_payments->supplier_id    = $request->supplier_id;
        $purchase_payments->payment_method = 1;

        $purchase_payments->save();

        Cart::destroy();


        if ($purchases) {

            Session::flash('message', 'New Purchase Created Successfully!');

        } else {

            Session::flash('message', 'Purchase Create Failed!');
        }
    }

    public function delete_purchase($id)
    {

        $purchase_delete = $this::where('id', $id)->delete();

        if ($purchase_delete) {

            Session::flash('message', 'Purchase Deleted Successfully!');

        } else {

            Session::flash('message', 'Purchase Delete Failed!');
        }
        
    }
}
