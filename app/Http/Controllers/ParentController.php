<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kid;
use App\Models\Product;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function show(Kid $kid){
        $selected =  Carbon::createFromFormat('Y-m-d', request('date'));
        $weekStart = $selected->copy()->startOfWeek();
        $weekEnd = $selected->copy()->endOfWeek();

        $weekDates = [];
        for ($date = $weekStart->copy(); $date <= $weekEnd; $date->addDay()) {
            $weekDates[] = $date->copy();
        }

        $weekOrders = [];
        
        for ($i = 0; $i < 7; $i++){
            $weekOrders[] = $kid->orders()->where('day', $weekDates[$i])->first();    
        }

        return view('kids.show', [
            'kids' => auth()->user()->kids,
            'kid' => $kid,
            'week' => $weekDates,
            'weekStart' => $weekStart->formatLocalized('%d %B'),
            'weekEnd' => $weekEnd->formatLocalized('%d %B'),
            'selected' => $selected,
            'weekOrders' => $weekOrders
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
