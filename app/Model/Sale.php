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
        'customer_id'         => 'numeric',
        'extra_cost'          => 'numeric',
        'vat_percentage'      => 'numeric',
        'paid'                => 'required|numeric',
        'due'                 => 'required|numeric',
        'vat'                 => 'numeric|between:0,99999999999.99',
        'discount_percentage' => 'numeric',
        'discount'            => 'numeric|between:0,99999999999.99',
        'total'               => 'required|numeric|between:0,99999999999.99',
    ];

    public static $validateSearchRule = [

        'start_date'  => 'nullable|string|max:10',
        'end_date'    => 'nullable|string|max:10',
        'supplier_id' => 'numeric|nullable',
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

            $customer_id = $request->customer_id;
        }

        //$subtotal = str_replace(',', '', Cart::subtotal());

        $this->date                = date('Y-m-d', strtotime($request->date));
        $this->invoice             = $request->invoice;
        $this->user_id             = $request->user_id;
        $this->customer_id         = $customer_id;
        $this->subtotal            = $request->subtotal;
        $this->vat_percentage      = $request->vat_percentage;
        $this->vat                 = $request->vat;
        $this->extra_cost          = $request->extra_cost;
        $this->discount_percentage = $request->discount_percentage;
        $this->discount            = $request->discount;
        $this->note                = $request->note;
        $this->total               = $request->total;
        $sales                     = $this->save();

        $sale_id                   = $this->id;

        foreach ($request->price as $key => $value) {

            if($value == 0 ) continue;

            $sale_details = new Sale_detail;
            $sale_details->sale_id     = $sale_id;
            $sale_details->invoice     = $request->invoice;
            $sale_details->product_id  = $request->product_id[$key];
            $sale_details->quantity    = $request->quantity[$key];
            $sale_details->rate        = $request->rate[$key];
            $sale_details->total       = $value;
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


        if ($sales) {

            Session::flash('message', 'New Sale Created Successfully!');

        } else {

            Session::flash('message', 'Sale Create Failed!');
        }

        return $sale_id;
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

    public function get_sale_report($start_date = '', $end_date = '', $customer_id = '')
    {
        $query = DB::table('sales')
                     ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
                     ->leftJoin('users', 'sales.user_id', '=', 'users.id')
                     ->where('sales.deleted_at', '=', NULL);

        if ($start_date != '' && $end_date != '') {

            $query->where('sales.date', '>=', $start_date);
            $query->where('sales.date', '<=', $end_date);
        }

        if ($customer_id != '') {
            $query->where('sales.customer_id', $customer_id);
        }

        $query->select('sales.id','sales.date','sales.total','sales.note','users.name as user', 'customers.name as customer');

        $result = $query->get();

        return $result;
    }

    public function get_todays_sale($today)
    {
        $sales = DB::table('sales')
                     ->where('sales.deleted_at', '=', NULL)
                     ->where('sales.date', $today)
                     ->groupBy('sales.date')
                     ->select(DB::raw('SUM(sales.total) as total_sale'));

        if ($sales->count() > 0) {

            return $sales->first();

        } else{

            return null;
        }
    }
}
