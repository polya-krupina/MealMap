<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Dish;

class DishesController extends Controller
{
    public function show(){
        $dishesGroupped = Dish::where('kindergarten_id', auth()->user()->kindergarten_id)->get()->groupBy('meal_type_id');
        return view('dishes.show', [
            'kids' => auth()->user()->kids,
            'dishes' => $dishesGroupped,
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get(),
            'found' => Dish::find(request('id'))
        ]);
    }

    public function send(Dish $dish){
        $id = $dish->id;
        return response()->json(Dish::with('products')->where('id', $id)->first());
    }

    public function destroy(Request $request){
        $dish = Dish::find($request->id);
        $dish->delete();

        return back()->with(['success' => 'Успешно']);
    }
}
