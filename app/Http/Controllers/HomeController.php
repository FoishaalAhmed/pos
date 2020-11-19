<?php

namespace App\Http\Controllers;

use App\Model\Cost;
use App\Model\Purchase;
use App\Model\Purchase_payment;
use App\Model\Sale;
use App\Model\Sale_detail;
use App\Model\Sale_payment;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$role = array('Admin', 'User', 'Accountent');

        /*switch ($role) {
            case @Auth::user()->hasRole(['Admin']):
                return view('admin.dashboard');
                break;

            case @Auth::user()->hasRole(['Accountent']):
                return view('accountent.dashboard');
                break;
            
            default:
                return view('user.dashboard');
                break;
        }*/

        $today            = date('Y-m-d');
        $purchase         = new Purchase;
        $purchase_payment = new Purchase_payment;
        $sale             = new Sale;
        $sale_payment     = new Sale_payment;
        $sale_detail      = new Sale_detail;
        $cost             = new Cost;

        if (@Auth::user()->hasRole(['Admin'])) {

            $today_purchase         = $purchase->get_todays_purchase($today);
            $today_cost             = $cost->get_todays_cost($today);
            $today_sale             = $sale->get_todays_sale($today);
            $today_profit           = $sale_detail->get_todays_profit($today);
            $today_purchase_payment = $purchase_payment->get_todays_purchase_payment($today);
            $today_sale_payment     = $sale_payment->get_todays_sale_payment($today);

            $profit = 0;

            if ($today_profit) {

                foreach ($today_profit  as $key => $value) {

                    $total_buy_price = $value->quantity * $value->buy_price;

                    $profit += $value->total - $total_buy_price;
                }
            }

            return view('admin.dashboard', compact('profit', 'today_purchase', 'today_purchase_payment', 'today_sale', 'today_sale_payment', 'today_cost'));

        } elseif (@Auth::user()->hasRole(['Accountent'])) {

            return view('accountent.dashboard');

        } else {

            return view('user.dashboard');
        }
    }
}
