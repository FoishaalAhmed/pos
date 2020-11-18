<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Purchase;
use App\Model\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function purchase(Request $request)
    {
    	$purchase = new Purchase;

    	$suppliers = Supplier::select('id', 'name')->get();

    	$start_date   = date('Y-m-d', strtotime($request->start_date));
    	$end_date     = date('Y-m-d', strtotime($request->end_date));
    	$supplier_id  = $request->supplier_id;

    	if ($supplier_id != '' || $start_date != '' || $end_date != '') {

    		$purchase_report = $purchase->get_purchase_report($start_date, $end_date, $supplier_id);

    		return view('admin.report.purchase', compact('suppliers', 'supplier_id', 'start_date', 'end_date', 'purchase_report'));

    	} else {

    		return view('admin.report.purchase', compact('suppliers'));

    	}
    	

    }
}
