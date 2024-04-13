<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function add(Request $request){
        $meal = Meal::find($request->meal_id);
        $dish = Dish::find($request->dish_id);

        $meal->dishes()->attach($dish->id);
    }
}
