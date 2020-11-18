<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;

class Supplier extends Model
{
    protected $fillable = [
    	'name', 'email', 'phone', 'area', 'photo', 'address', 'company', 'company_phone',
    ];

    public static $validateStoreRule = [

        'photo'         => 'mimes:jpeg,jpg,png,gif|max:1999|nullable',
        'name'          => 'required|string|max:255',
        'area'          => 'string|max:255|nullable',
        'email'         => 'email|max:255|nullable',
        'phone'         => 'required|numeric',
        'address'       => 'string|nullable',
        'company'       => 'string|max:255|nullable',
        'company_phone' => 'numeric|nullable',
    ];

    public static $validateUpdateRule = [

        'photo'         => 'mimes:jpeg,jpg,png,gif|max:1999|nullable',
        'name'          => 'required|string|max:255',
        'area'          => 'string|max:255|nullable',
        'email'         => 'email|max:255|nullable',
        'phone'         => 'required|numeric',
        'address'       => 'string|nullable',
        'company'       => 'string|max:255|nullable',
        'company_phone' => 'numeric|nullable',
    ];

    public function store_supplier($request)
    {

        $image = $request->file('photo');

        if ($image) {

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/suppliers/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $this->photo     = $image_url;
        }

        $this->name         = $request->name;
        $this->area         = $request->area;
        $this->email        = $request->email;
        $this->phone        = $request->phone;
        $this->address      = $request->address;
        $this->company      = $request->company;
        $this->company_phone = $request->company_phone;
        $supplier           = $this->save();

        if ($supplier) {

            Session::flash('message', 'New Supplier Created Successfully!');

        } else {

            Session::flash('message', 'Supplier Create Failed!');
        }
        
    }

    public function update_supplier($request, $id)
    {

        $supplier  = $this::findOrFail($id);

        $image = $request->file('photo');

        if ($image) {

            if(file_exists($supplier->photo)) unlink($supplier->photo);

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/suppliers/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $supplier->photo     = $image_url;
        }

        $supplier->name         = $request->name;
        $supplier->address      = $request->address;
        $supplier->email        = $request->email;
        $supplier->phone        = $request->phone;
        $supplier->area         = $request->area;
        $supplier->company      = $request->company;
        $supplier->company_phone= $request->company_phone;

        $supplier_update        = $supplier->save();

        if ($supplier_update) {

            Session::flash('message', 'Supplier Updated Successfully!');

        } else {

            Session::flash('message', 'Supplier Update Failed!');
        }
        
    }

    public function delete_supplier($id)
    {
        $supplier_info = $this::findOrFail($id);

        if($supplier_info) {

            if (file_exists($supplier_info->photo)) unlink($supplier_info->photo);
        }

        $supplier_delete = $this::where('id', $id)->delete();

        if ($supplier_delete) {

            Session::flash('message', 'Supplier Deleted Successfully!');

        } else {

            Session::flash('message', 'Supplier Delete Failed!');
        }
        
    }
}
