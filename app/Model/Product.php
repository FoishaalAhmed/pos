<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Session;

class Product extends Model
{
    protected $fillable = [
        'name', 'photo', 'description', 'vat', 'buy_price', 'sell_price', 'category_id',
    ];

    public static $validateStoreRule = [

        'photo'       => 'mimes:jpeg,jpg,png,gif|max:1999',
        'name'        => 'required|string|max:255',
        'description' => 'string',
        'vat'         => 'between:0,99.99',
        'buy_price'   => 'required|numeric',
        'sell_price'  => 'required|numeric',
        'category_id' => 'required|numeric',
    ];

    public static $validateUpdateRule = [

        'photo'       => 'mimes:jpeg,jpg,png,gif|max:1999',
        'name'        => 'required|string|max:255',
        'description' => 'string',
        'vat'         => 'between:0,99.99',
        'buy_price'   => 'required|numeric',
        'sell_price'  => 'required|numeric',
        'category_id' => 'required|numeric',
    ];

    public function store_product($request)
    {
    	$image = $request->file('photo');

        if ($image) {

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/products/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $this->photo     = $image_url;
        }

    	$this->name        = $request->name;
        $this->description = $request->description;
        $this->vat         = $request->vat;
        $this->buy_price   = $request->buy_price;
        $this->sell_price  = $request->sell_price;
        $this->category_id = $request->category_id;
        $products          = $this->save();

        if ($products) {

            Session::flash('message', 'New Products Created Successfully!');

        } else {

            Session::flash('message', 'Products Create Failed!');
        }
    }

    public function update_product($request, $id)
    {
    	$product = $this::findOrFail($id);

    	$image = $request->file('photo');

    	if ($image) {

    		if(file_exists($product->photo)) unlink($product->photo);

            $image_name      = rand();
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path     = 'public/images/products/';
            $image_url       = $upload_path.$image_full_name;
            $success         = $image->move($upload_path,$image_full_name);
            $product->photo     = $image_url;
        }

    	$product->name        = $request->name;
        $product->description = $request->description;
        $product->vat         = $request->vat;
        $product->buy_price   = $request->buy_price;
        $product->sell_price  = $request->sell_price;
        $product->category_id = $request->category_id;
        $products             = $product->save();

        if ($products) {

            Session::flash('message', 'New Products Updated Successfully!');

        } else {

            Session::flash('message', 'Products Update Failed!');
        }
    }

    public function delete_product($id)
    {
    	$product = $this::findOrFail($id);

    	if($product) {

            if (file_exists($product->photo)) unlink($product->photo);
        }

        $product_delete = $this::where('id', $id)->delete();

        if ($product_delete) {

            Session::flash('message', 'Product Deleted Successfully!');

        } else {

            Session::flash('message', 'Product Delete Failed!');
        }
    }
}
