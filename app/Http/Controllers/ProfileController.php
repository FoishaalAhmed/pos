<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{	
	private $user_object;

    public function __construct()
    {
    	$this->user_object = new User;

    	$this->middleware('auth');
    }

    public function index()
    {
    	$user_id   = Auth::user()->id;

    	$user_info = User::findOrFail($user_id);

    	return view('profile', compact('user_info'));
    }

    public function photo(Request $request)
    {
    	$user_id      = Auth::user()->id;

    	$validateData = $request->validate(User::$validatePhotoRule);

        $this->user_object->update_user_photo($request, $user_id);

        return redirect()->back();
    }

    public function password(Request $request)
    {
    	$user_id      = Auth::user()->id;
    	$validateData = $request->validate(User::$validatePasswordRule);

        $this->user_object->update_user_password($request, $user_id);

        return redirect()->back();
    }

    public function update(Request $request)
    {
    	$user_id      = Auth::user()->id;

    	$validateData = $request->validate(User::$validateInfoRule);

        $this->user_object->update_user_info($request, $user_id);

        return redirect()->back();
    }
}
