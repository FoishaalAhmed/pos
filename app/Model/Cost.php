<?php

namespace App\Model;

use DB;
use Session;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
    	'date', 'note', 'amount', 
    ];

    public static $validateRule = [

        'date'   => 'required|string|max:10',
        'note'   => 'string|nullable',
        'amount' => 'required|numeric|between:0,99999999999.99',
    ];

    public function store_cost($request)
    {
    	$this->date    = date('Y-m-d', strtotime($request->date));
        $this->note    = $request->note;
        $this->amount  = $request->amount;
        $cost          = $this->save();

        if ($cost) {

            Session::flash('message', 'New Cost Created Successfully!');

        } else {

            Session::flash('message', 'Cost Create Failed!');
        }
    }

    public function update_cost($request, $id)
    {
    	$cost          = $this::findOrFail($id);
    	$cost->date    = date('Y-m-d', strtotime($request->date));
        $cost->note    = $request->note;
        $cost->amount  = $request->amount;
        $cost_update   = $cost->save();

        if ($cost_update) {

            Session::flash('message', 'Cost Updated Successfully!');

        } else {

            Session::flash('message', 'Cost Update Failed!');
        }
    }

    public function delete_cost($id)
    {
    	$cost_delete = $this::where('id', $id)->delete();

        if ($cost_delete) {

            Session::flash('message', 'Cost Deleted Successfully!');

        } else {

            Session::flash('message', 'Cost Delete Failed!');
        }
    }

    public function get_todays_cost($today)
    {
        $costs = DB::table('costs')
                     ->where('costs.date', $today)
                     ->groupBy('costs.date')
                     ->select(DB::raw('SUM(costs.amount) as total_amount'));

        if ($costs->count() > 0) {

            return $costs->first();

        } else{

            return null;
        }
    }
}
