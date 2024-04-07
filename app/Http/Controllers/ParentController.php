<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use App\Models\Product;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function show(Kid $kid){
        return view('kids.show', [
            'kids' => auth()->user()->kids,
            'kid' => $kid
        ]);
    }

    public function allergy(Kid $kid){
        $allergies = $kid->allergies;
        $products = Product::all()->whereNotIn('id', $allergies->pluck('id'));

        return view('kids.allergies', [
            'kids' => auth()->user()->kids,
            'kid' => $kid,
            'products'=> $products
        ]);
    }
}
