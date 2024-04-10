<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class DishesController extends Controller
{
    public function show(){
        $dishesGroupped = Dish::all()->groupBy('meal_type_id');
        return view('dishes.show', [
            'kids' => auth()->user()->kids,
            'dishes' => $dishesGroupped,
            'found' => Dish::find(request('id'))
        ]);
    }
}