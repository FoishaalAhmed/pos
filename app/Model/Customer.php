<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Session;

class Customer extends Model
{
    protected $fillable = [
    	'name', 'email', 'phone', 'area', 'photo', 'address', 'credit_limit',
    ];

    public static $validateStoreRule = [

        'photo'        => 'mimes:jpeg,jpg,png,gif|max:1999|nullable',
        'name'         => 'required|string|max:255',
        'area'         => 'string|max:255|nullable',
        'email'        => 'email|max:255|nullable',
        'phone'        => 'required|numeric',
        'credit_limit' => 'numeric|nullable',
        'address'      => 'string|nullable',
    ];

    public static $validateUpdateRule = [

        'photo'        => 'mimes:jpeg,jpg,png,gif|max:1999|nullable',
        'name'         => 'required|string|max:255',
        'area'         => 'string|max:255|nullable',
        'email'        => 'email|max:255|nullable',
        'phone'        => 'required|numeric',
        'credit_limit' => 'numeric|nullable',
        'address'      => 'string|nullable',
    ];

    public function store_customer($request)
    {

        $image = $request->file('photo');

        if ($image) {

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/customers/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $this->photo     = $image_url;
        }

        $this->name         = $request->name;
        $this->area         = $request->area;
        $this->email        = $request->email;
        $this->phone        = $request->phone;
        $this->address      = $request->address;
        $this->credit_limit = $request->credit_limit;
        $customer           = $this->save();

        if ($customer) {

            Session::flash('message', 'New Customer Created Successfully!');

        } else {

            Session::flash('message', 'Customer Create Failed!');
        }
        
    }

    public function update_customer($request, $id)
    {

        $customer  = $this::findOrFail($id);

        $image = $request->file('photo');

        if ($image) {

            if(file_exists($customer->photo)) unlink($customer->photo);

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/customers/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $customer->photo     = $image_url;
        }

        $customer->name         = $request->name;
        $customer->address      = $request->address;
        $customer->email        = $request->email;
        $customer->phone        = $request->phone;
        $customer->area         = $request->area;
        $customer->credit_limit = $request->credit_limit;

        $customer_update        = $customer->save();

        if ($customer_update) {

            Session::flash('message', 'Customer Updated Successfully!');

        } else {

            Session::flash('message', 'Customer Update Failed!');
        }
        
    }

    public function delete_customer($id)
    {
        $customer_info = $this::findOrFail($id);

        if($customer_info) {

            if (file_exists($customer_info->photo)) unlink($customer_info->photo);
        }

        $customer_delete = $this::where('id', $id)->delete();

        if ($customer_delete) {

            Session::flash('message', 'Customer Deleted Successfully!');

        } else {

            Session::flash('message', 'Customer Delete Failed!');
        }
        
    }
}
