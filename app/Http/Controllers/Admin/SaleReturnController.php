<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Sale_detail;
use App\Model\Sale_return;
use App\User;
use Illuminate\Http\Request;

class SaleReturnController extends Controller
{
    private $sale_return_object;

    public function __construct()
    {
        $this->sale_return_object   = new Sale_return;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
    	$sale_returns = $this->sale_return_object->get_sale_return();

    	return view('admin.salereturn.list', compact('sale_returns'));
    }

    public function return($id)
    {
    	$sale_detail = Sale_detail::findOrFail($id);
        $users       = User::select('id','name')->get();
        $customers   = Customer::select('id','name')->get();

        return view('admin.salereturn.add', compact('sale_detail', 'users', 'customers'));
    }

    public function store(Request $request)
    {
    	$sale_detail = Sale_detail::findOrFail($request->detail_id);

    	if ($sale_detail->quantity < $request->quantity) {

    		return redirect()->back()->withErrors(['Return quantity can not be bigger than buy quantity']);
    	}

    	$validateData = $request->validate(Sale_return::$validateStoreRule);

        $this->sale_return_object->store_sale_return($request);

        return redirect()->back();
    }

    public function destroy($id)
    {
    	$this->sale_return_object->delete_sale_return($id);

        return redirect()->back();
    }
}
