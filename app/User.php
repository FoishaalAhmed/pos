<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Session;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'username', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $validateStoreRule = [

        'photo'       => 'mimes:jpeg,jpg,png,gif|required|max:1999',
        'name'        => 'required|string|max:255',
        'username'    => 'required|string|max:255|unique:users',
        'email'       => 'required|email|max:255|unique:users',
        'phone'       => 'required|numeric|unique:users',
        'address'     => 'required|string',
        'password'    => 'required|string|min:8|confirmed',
    ];

    public static $validatePasswordRule = [

        'old_password'    => 'required|string',
        'new_password'    => 'required|string|min:8',
    ];

    public static $validatePhotoRule = [

        'photo'       => 'mimes:jpeg,jpg,png,gif|required|max:1999',
    ];

    public static $validateUpdateRule = [

        'photo'       => 'mimes:jpeg,jpg,png,gif|required|max:1999',
        'name'        => 'required|string|max:255',
        'username'    => 'string|max:255',
        'email'       => 'email|max:255',
        'phone'       => 'numeric',
        'address'     => 'required|string',

    ];

    public static $validateInfoRule = [

        'name'        => 'required|string|max:255',
        'username'    => 'string|max:255',
        'email'       => 'email|max:255',
        'phone'       => 'numeric',
        'address'     => 'required|string',

    ];

    public function store_user($request)
    {

        $image = $request->file('photo');

        if ($image) {

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $this->photo     = $image_url;
        }

        $this->name      = $request->name;
        $this->username  = $request->username;
        $this->email     = $request->email;
        $this->phone     = $request->phone;
        $this->address   = $request->address;
        $this->password  = Hash::make($request->password);
        $user            = $this->save();
        $user_id         = $this->id;

        $user_info = $this::findOrFail($user_id);

        $user_info->assignRole($request->role_id);

        if ($user) {

            Session::flash('message', 'New User Created Successfully!');

        } else {

            Session::flash('message', 'User Create Failed!');
        }
        
    }

    public function update_user($request, $id)
    {

        $user  = $this::findOrFail($id);

        $image = $request->file('photo');

        if ($image) {

            if(file_exists($user->photo)) unlink($user->photo);

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/users/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $user->photo     = $image_url;
        }

        
        $user->name      = $request->name;
        $user->address   = $request->address;

        $user_update       = $user->save();

        if ($user_update) {

            Session::flash('message', 'User Updated Successfully!');

        } else {

            Session::flash('message', 'User Update Failed!');
        }
        
    }

    public function delete_user($id)
    {
        $user_info = $this::findOrFail($id);

        if($user_info) {

            if (file_exists($user_info->photo)) unlink($user_info->photo);

            $user_info->removeRole($user_info->roles->first());
        }

        $user_delete = $this::where('id', $id)->delete();

        if ($user_delete) {

            Session::flash('message', 'User Deleted Successfully!');

        } else {

            Session::flash('message', 'User Delete Failed!');
        }
        
    }
}
