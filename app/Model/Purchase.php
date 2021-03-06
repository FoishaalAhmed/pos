<?php

namespace App\Model;

use App\Model\Purchase_detail;
use App\Model\Purchase_payment;
use App\Model\Supplier;
use Cart;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;


class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = [

    	'date', 'invoice', 'user_id','supplier_id', 'subtotal', 'vat_percentage','vat', 'extra_cost', 'discount_percentage','discount', 'total', 'note',
    ];

    public static $validateStoreRule = [

        'date'                => 'required|string|max:10',
        'note'                => 'string|nullable',
        'invoice'             => 'required|string|max:50',
        'supplier_id'         => 'numeric|required',
        'user_id'             => 'numeric|nullable',
        'extra_cost'          => 'numeric|nullable',
        'vat_percentage'      => 'numeric|nullable',
        'paid'                => 'required|numeric',
        'due'                 => 'required|numeric',
        'vat'                 => 'numeric|between:0,99999999999.99|nullable',
        'discount_percentage' => 'numeric|nullable',
        'discount'            => 'numeric|between:0,99999999999.99|nullable',
        'total'               => 'required|numeric|between:0,99999999999.99',
    ];

    public static $validateSearchRule = [

        'start_date'  => 'nullable|string|max:10',
        'end_date'    => 'nullable|string|max:10',
        'supplier_id' => 'numeric|nullable',
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
        $supplier_id = '';
        if ($request->supplier == 'new') {

            $supplier        = new Supplier;
            $supplier->name  = $request->name;
            $supplier->phone = $request->phone;
            $supplier->save();

            $supplier_id = $supplier->id;

        } else {

            $supplier_id = $request->supplier_id;
        }

        $this->date                = date('Y-m-d', strtotime($request->date));
        $this->invoice             = $request->invoice;
        $this->user_id             = $request->user_id;
        $this->supplier_id         = $supplier_id;
        $this->subtotal            = $request->subtotal;
        $this->vat_percentage      = $request->vat_percentage;
        $this->vat                 = $request->vat;
        $this->extra_cost          = $request->extra_cost;
        $this->discount_percentage = $request->discount_percentage;
        $this->discount            = $request->discount;
        $this->note                = $request->note;
        $this->total               = $request->total;
        $purchases                 = $this->save();

        $purchase_id               = $this->id;

        foreach ($request->price as $key => $value) {

            if($value == 0 ) continue;

            $purchase_details = new Purchase_detail;
            $purchase_details->purchase_id = $purchase_id;
            $purchase_details->invoice     = $request->invoice;
            $purchase_details->product_id  = $request->product_id[$key];
            $purchase_details->quantity    = $request->quantity[$key];
            $purchase_details->rate        = $request->rate[$key];
            $purchase_details->total       = $value;
            $purchase_details->save();
        }



        foreach ($request->price as $key => $value) {
            if($value == 0 ) continue;
            $stock = new Stock;
            $stock->product_id  = $request->product_id[$key];
            $stock->quantity    = $request->quantity[$key];
            //$stock->unit        = $value->options->size;
            $stock->save();
        }

        $purchase_payments = new Purchase_payment;

        $purchase_payments->date           = date('Y-m-d', strtotime($request->date));
        $purchase_payments->purchase_id    = $purchase_id;
        $purchase_payments->invoice        = $request->invoice;
        $purchase_payments->paid           = $request->paid;
        $purchase_payments->due            = $request->due;
        $purchase_payments->user_id        = $request->user_id;
        $purchase_payments->supplier_id    = $supplier_id;

        $purchase_payments->save();

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

    public function get_purchase_report($start_date = '', $end_date = '', $supplier_id = '')
    {
        $query = DB::table('purchases')
                     ->leftJoin('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
                     ->leftJoin('users', 'purchases.user_id', '=', 'users.id')
                     ->where('purchases.deleted_at', '=', NULL);

        if ($start_date != '' && $end_date != '') {

            $query->where('purchases.date', '>=', $start_date);
            $query->where('purchases.date', '<=', $end_date);
        }

        if ($supplier_id != '') {
            $query->where('purchases.supplier_id', $supplier_id);
        }

        $query->select('purchases.id','purchases.date','purchases.total','purchases.note','users.name as user', 'suppliers.name as supplier');

        $result = $query->get();

        return $result;
    }

    public function get_todays_purchase($today)
    {
        $purchases = DB::table('purchases')
                     ->where('purchases.deleted_at', '=', NULL)
                     ->where('purchases.date', $today)
                     ->groupBy('purchases.date')
                     ->select(DB::raw('SUM(purchases.total) as total_purchase'));

        if ($purchases->count() > 0) {

            return $purchases->first();

        } else{

            return null;
        }
    }
}
