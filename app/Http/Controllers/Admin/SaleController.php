<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Sale;
use App\Model\Sale_detail;
use App\Model\Sale_payment;
use App\Model\Unit;
use App\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    private $sale_object;
    private $sale_datil_object;
    private $sale_payment_object;

    public function __construct()
    {
        $this->sale_object         = new Sale;
        $this->sale_datil_object   = new Sale_detail;
        $this->sale_payment_object = new Sale_payment;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = $this->sale_object->get_sales();

        return view('admin.sale.list', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products  = Product::select('id','name', 'sell_price')->get();
        $users     = User::select('id','name')->get();
        $customers = Customer::select('id','name')->get();
        $units     = Unit::select('value','name')->get();

        return view('admin.sale.add', compact('products', 'users', 'customers', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(Sale::$validateStoreRule);

        $this->sale_object->store_sale($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);

        if ($sale) {
            $user_info = '';
            if($sale->user_id != '') $user_info     = User::findOrFail($sale->user_id);
            $customer_info = Customer::findOrFail($sale->customer_id);

            $sale_details = $this->sale_datil_object->get_sale_detail_by_sale_id($id);
            $sale_payment = $this->sale_payment_object->get_sale_payment_by_sale_id($id);

            return view('admin.sale.view', compact('sale', 'user_info', 'customer_info', 'sale_details', 'sale_payment'));
            
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sale_object->delete_sale($id);

        return redirect()->back();
    }
}
