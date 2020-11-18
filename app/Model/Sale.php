<?php

namespace App\Model;

use App\Model\Customer;
use App\Model\Sale_detail;
use App\Model\Sale_payment;
use Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Session;

class Sale extends Model
{
	use SoftDeletes;
    protected $fillable = [

    	'date', 'invoice', 'user_id','customer_id', 'subtotal', 'vat_percentage','vat', 'extra_cost', 'discount_percentage','discount', 'total', 'note',
    ];

    public static $validateStoreRule = [

        'date'                => 'required|string|max:10',
        'note'                => 'string|nullable',
        'invoice'             => 'required|string|max:50',
        'user_id'             => 'numeric|nullable',
        'customer_id'         => 'numeric|nullable',
        'extra_cost'          => 'numeric',
        'vat_percentage'      => 'numeric',
        'paid'                => 'required|numeric',
        'due'                 => 'required|numeric',
        'vat'                 => 'numeric|between:0,99999999999.99',
        'discount_percentage' => 'numeric',
        'discount'            => 'numeric|between:0,99999999999.99',
        'total'               => 'required|numeric|between:0,99999999999.99',
    ];

    public function get_sales()
    {
    	$sales = DB::table('sales')
                     ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
                     ->leftJoin('users', 'sales.user_id', '=', 'users.id')
                     ->where('sales.deleted_at', '=', NULL)
                     ->select('sales.id','sales.date','sales.subtotal','sales.total','sales.note','users.name as user', 'customers.name as customer')
                     ->get();

        return $sales;
    }

    public function store_sale($request)
    {

        $customer_id = '';
        if ($request->customer == 'new') {

            $customer        = new Customer;
            $customer->name  = $request->name;
            $customer->phone = $request->phone;
            $customer->save();

            $customer_id = $customer->id;

        } else {

            $customer_id = $request->user_id;
        }

        $subtotal = str_replace(',', '', Cart::subtotal());

        $this->date                = date('Y-m-d', strtotime($request->date));
        $this->invoice             = $request->invoice;
        $this->user_id             = $request->user_id;
        $this->customer_id         = $customer_id;
        $this->subtotal            = $subtotal;
        $this->vat_percentage      = $request->vat_percentage;
        $this->vat                 = $request->vat;
        $this->extra_cost          = $request->extra_cost;
        $this->discount_percentage = $request->discount_percentage;
        $this->discount            = $request->discount;
        $this->note                = $request->note;
        $this->total               = $request->total;
        $sales                     = $this->save();

        $sale_id                   = $this->id;


        $cart = Cart::content();

        foreach ($cart as $key => $value) {

            $sale_details = new Sale_detail;
            $sale_details->sale_id     = $sale_id;
            $sale_details->invoice     = $request->invoice;
            $sale_details->product_id  = $value->id;
            $sale_details->quantity    = $value->qty;
            $sale_details->rate        = $value->price;
            $sale_details->total       = $value->total;
            $sale_details->save();
        }

        $sale_payments = new Sale_payment;

        $sale_payments->date           = date('Y-m-d', strtotime($request->date));
        $sale_payments->sale_id        = $sale_id;
        $sale_payments->invoice        = $request->invoice;
        $sale_payments->paid           = $request->paid;
        $sale_payments->due            = $request->due;
        $sale_payments->user_id        = $request->user_id;
        $sale_payments->customer_id    = $customer_id;

        $sale_payments->save();

        Cart::destroy();


        if ($sales) {

            Session::flash('message', 'New Sale Created Successfully!');

        } else {

            Session::flash('message', 'Sale Create Failed!');
        }
    }

    public function delete_sale($id)
    {

        $sale_delete = $this::where('id', $id)->delete();

        if ($sale_delete) {

            Session::flash('message', 'Sale Deleted Successfully!');

        } else {

            Session::flash('message', 'Sale Delete Failed!');
        }
        
    }
}
