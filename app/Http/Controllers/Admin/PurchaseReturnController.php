<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Purchase_detail;
use App\Model\Purchase_return;
use App\Model\Supplier;
use App\User;

class PurchaseReturnController extends Controller
{
    private $purchase_return_object;

    public function __construct()
    {
        $this->purchase_return_object   = new Purchase_return;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
    	$purchase_returns = $this->purchase_return_object->get_purchase_return();

    	return view('admin.purchasereturn.list', compact('purchase_returns'));
    }

    public function return($id)
    {
    	$purchase_detail = Purchase_detail::findOrFail($id);
        $users           = User::select('id','name')->get();
        $suppliers       = Supplier::select('id','name')->get();

        return view('admin.purchasereturn.add', compact('purchase_detail', 'users', 'suppliers'));
    }

    public function store(Request $request)
    {
    	$purchase_detail = Purchase_detail::findOrFail($request->detail_id);

    	if ($purchase_detail->quantity < $request->quantity) {

    		return redirect()->back()->withErrors(['Return quantity can not be bigger than buy quantity']);
    	}

    	$validateData = $request->validate(Purchase_return::$validateStoreRule);

        $this->purchase_return_object->store_purchase_return($request);

        return redirect()->back();
    }

    public function destroy($id)
    {
    	$this->purchase_return_object->delete_purchase_return($id);

        return redirect()->back();
    }
}
