<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class DishesController extends Controller
{
    public function show(){
        return view('dishes.show', [
            'kids' => auth()->user()->kids,
            'dishes' => Dish::all()
        ]);
    }
}
