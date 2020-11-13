<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Sale_payment;
use App\Model\Customer;
use App\User;
use Illuminate\Http\Request;

class SalePaymentController extends Controller
{
    private $sale_payment_object;

    public function __construct()
    {
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
        $sale_payments = $this->sale_payment_object->get_sale_payments();
        return view('admin.salepayment.list', compact('sale_payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users     = User::select('id','name')->get();
        $customers = Customer::select('id','name')->get();

        return view('admin.salepayment.add', compact('users', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(Sale_payment::$validateStoreRule);

        $this->sale_payment_object->store_sale_payment($request);

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
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale_payment = Sale_payment::findOrFail($id);
        $users     = User::select('id','name')->get();
        $customers = Customer::select('id','name')->get();

        return view('admin.salepayment.edit', compact('sale_payment', 'users', 'customers'));
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
        $validateData = $request->validate(Sale_payment::$validateUpdateRule);

        $this->sale_payment_object->update_sale_payment($request, $id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sale_payment_object->delete_sale_payment($id);

        return redirect()->back();
    }
}
