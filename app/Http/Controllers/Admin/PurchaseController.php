<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Purchase_detail;
use App\Model\Purchase_payment;
use App\Model\Supplier;
use App\Model\Unit;
use App\User;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    private $purchase_object;
    private $purchase_datil_object;
    private $purchase_payment_object;

    public function __construct()
    {
        $this->purchase_object         = new Purchase;
        $this->purchase_datil_object   = new Purchase_detail;
        $this->purchase_payment_object = new Purchase_payment;
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
        $purchases = $this->purchase_object->get_purchases();

        return view('admin.purchase.list', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products  = Product::select('id','name')->get();
        $users     = User::select('id','name')->get();
        $suppliers = Supplier::select('id','name')->get();
        $units     = Unit::select('value','name')->get();

        return view('admin.purchase.add', compact('products', 'users', 'suppliers', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(Purchase::$validateStoreRule);

        $this->purchase_object->store_purchase($request);

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

        $purchase = Purchase::findOrFail($id);

        if ($purchase) {

            $user_info = '';

            if($purchase->user_id != '') $user_info = User::findOrFail($purchase->user_id);
            $supplier_info = Supplier::findOrFail($purchase->supplier_id);

            $purchase_details = $this->purchase_datil_object->get_purchase_detail_by_purchase_id($id);
            $purchase_payment = $this->purchase_payment_object->get_purchase_payment_by_purchase_id($id);

            return view('admin.purchase.view', compact('purchase', 'user_info', 'supplier_info', 'purchase_details', 'purchase_payment'));
         
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
        $this->purchase_object->delete_purchase($id);

        return redirect()->back();
    }
}
