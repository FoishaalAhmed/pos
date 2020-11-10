<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;

class Unit extends Model
{
    protected $fillable = [

    	'name', 'value', 

	];

	public static $validateStoreRule = [

        'name'         => 'required|string|max:255',
        'value'        => 'required|string|max:255',
    ];

    public static $validateUpdateRule = [

        'name'         => 'required|string|max:255',
        'value'        => 'required|string|max:255',
    ];

    public function store_unit($request)
    {
    	$this->name         = $request->name;
        $this->value        = $request->value;
        $unit               = $this->save();

        if ($unit) {

            Session::flash('message', 'New Unit Created Successfully!');

        } else {

            Session::flash('message', 'Unit Create Failed!');
        }
    }

    public function update_unit($request, $id)
    {
    	$unit  = $this::findOrFail($id);

    	$unit->name     = $request->name;
        $unit->value    = $request->value;
        $unit_update    = $unit->save();

        if ($unit_update) {

            Session::flash('message', 'Unit Updated Successfully!');

        } else {

            Session::flash('message', 'Unit Update Failed!');
        }
    }

    public function delete_unit($id)
    {

        $unit_delete = $this::where('id', $id)->delete();

        if ($unit_delete) {

            Session::flash('message', 'Unit Deleted Successfully!');

        } else {

            Session::flash('message', 'Unit Delete Failed!');
        }
        
    }
}
