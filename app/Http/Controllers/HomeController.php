<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
        $role = array('Admin', 'User', 'Accountent');

        switch ($role) {
            case @Auth::user()->hasRole(['Admin']):
                return view('admin.dashboard');
                break;

            case @Auth::user()->hasRole(['Accountent']):
                return view('accountent.dashboard');
                break;
            
            default:
                return view('user.dashboard');
                break;
        }
    }
}
