<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Kid;
use App\Models\Product;
use Illuminate\Http\Request;

class AllergyController extends Controller
{
    public function create(Request $request){
        $attributes = $request->validate([
            'product_id' => 'required',
            'kid_id' => 'required'
        ]);

        $kid = Kid::find($attributes['kid_id']);
        $kid->allergies()->attach($attributes['product_id']);

        return back()->with('success','хайпы');
    }

    public function delete(Request $request){
        $attributes = $request->validate([
            'product'=> 'required',
            'kid' => 'required'
        ]);

        Kid::find( $attributes['kid'])->allergies()->detach($attributes['product']);
        return back()->with('success','Удалено!');
    }
}
