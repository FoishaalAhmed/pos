<?php

namespace App\Http\Controllers;

use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Purchase;
use App\Model\Purchase_detail;
use App\Model\Purchase_payment;
use App\Model\Sale;
use App\Model\Sale_detail;
use App\Model\Sale_payment;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function sale($id)
    {
    	$sale = Sale::findOrFail($id);

        if ($sale) {
        	$sale_datil_object   = new Sale_detail;
        	$sale_payment_object = new Sale_payment;
            $customer            = Customer::findOrFail($sale->customer_id);
            $sale_details        = $sale_datil_object->get_sale_detail_by_sale_id($id);
            $sale_payment        = $sale_payment_object->get_total_sale_payment_by_sale_id($id);

    		return view('print.sale', compact('sale', 'customer', 'sale_details', 'sale_payment'));
            
        }
    }

    public function purchase($id)
    {
    	$purchase = Purchase::findOrFail($id);

        if ($purchase) {

        	$purchase_datil_object   = new Purchase_detail;
        	$purchase_payment_object = new Purchase_payment;
            $supplier                = Supplier::findOrFail($purchase->supplier_id);
            $purchase_details        = $purchase_datil_object->get_purchase_detail_by_purchase_id($id);
            $purchase_payment        = $purchase_payment_object->get_total_purchase_payment_by_purchase_id($id);

    		return view('print.purchase', compact('purchase', 'supplier', 'purchase_details', 'purchase_payment'));
            
        }
    }
}
