<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Purchase;
use App\Model\Purchase_payment;
use App\Model\Sale;
use App\Model\Sale_payment;
use App\Model\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function purchase(Request $request)
    {
    	$purchase = new Purchase;

    	$suppliers    = Supplier::select('id', 'name')->get();

        $start_date   = $request->start_date;
        $end_date     = $request->end_date;
    	$supplier_id  = $request->supplier_id;

    	if($start_date != '') $start_date = date('Y-m-d', strtotime($start_date));
    	if($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));

    	if ($supplier_id != '' || $start_date != '' || $end_date != '') {

            $validateData = $request->validate(Purchase::$validateSearchRule);
    		$purchase_report = $purchase->get_purchase_report($start_date, $end_date, $supplier_id);
    		return view('admin.report.purchase', compact('suppliers', 'purchase_report'));

    	} else {

    		return view('admin.report.purchase', compact('suppliers'));

    	}
    	

    }

    public function sale(Request $request)
    {
        $sale         = new Sale;
        $customers    = Customer::select('id', 'name')->get();

        $start_date   = $request->start_date;
        $end_date     = $request->end_date;
        $customer_id  = $request->customer_id;


        if($start_date != '') $start_date = date('Y-m-d', strtotime($start_date));
        if($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));

        if ($customer_id != '' || $start_date != '' || $end_date != '') {

            $validateData = $request->validate(Sale::$validateSearchRule);
            $sale_report  = $sale->get_sale_report($start_date, $end_date, $customer_id);
            return view('admin.report.sale', compact('customers', 'sale_report'));

        } else {

            return view('admin.report.sale', compact('customers'));

        }
        

    }

    public function sale_payment(Request $request)
    {
        $sale_payment = new Sale_payment;
        $customers    = Customer::select('id', 'name')->get();

        $start_date   = $request->start_date;
        $end_date     = $request->end_date;
        $customer_id  = $request->customer_id;


        if($start_date != '') $start_date = date('Y-m-d', strtotime($start_date));
        if($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));

        if ($customer_id != '' || $start_date != '' || $end_date != '') {

            $validateData        = $request->validate(Sale_payment::$validateSearchRule);
            $sale_payment_report = $sale_payment->get_sale_payment_report($start_date, $end_date, $customer_id);
            return view('admin.report.salepayment', compact('customers', 'sale_payment_report'));

        } else {

            return view('admin.report.salepayment', compact('customers'));

        }
        

    }

    public function purchase_payment(Request $request)
    {
        $purchase_payment = new Purchase_payment;
        $suppliers        = Supplier::select('id', 'name')->get();

        $start_date       = $request->start_date;
        $end_date         = $request->end_date;
        $supplier_id      = $request->supplier_id;


        if($start_date != '') $start_date = date('Y-m-d', strtotime($start_date));
        if($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));

        if ($supplier_id != '' || $start_date != '' || $end_date != '') {

            $validateData            = $request->validate(Purchase_payment::$validateSearchRule);
            $purchase_payment_report = $purchase_payment->get_purchase_payment_report($start_date, $end_date, $supplier_id);
            return view('admin.report.purchasepayment', compact('suppliers', 'purchase_payment_report'));

        } else {

            return view('admin.report.purchasepayment', compact('suppliers'));

        }
        

    }
}
