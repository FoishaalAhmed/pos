<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Stock;
use App\Model\Sale_detail;

class StockController extends Controller
{
    private $stock_object;
    private $sale_details_object;

    public function __construct()
    {
        $this->stock_object  = new Stock;
        $this->sale_details_object  = new Sale_detail;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $stocks = $this->stock_object->get_stock();

        $sales_quantity = $this->sale_details_object->get_sale_quantity();

        foreach ($stocks as $key => $value) {

        	foreach ($sales_quantity as $key2 => $value2) {

        		$stocks[$key2]->sale_quantity = $value2->sale_quantity;
        	}
        }

        return view('admin.stock.list', compact('stocks'));
    }
}
