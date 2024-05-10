<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kid;
use App\Models\Order;
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

    public function pay(Request $request){
        $attributes = $request->validate(['kids' => 'required']);

        $now = Carbon::now();
        $startDate = $now->copy()->subMonth()->startOfMontH();
        $endDate = $now->copy()->subMonth()->endOfMonth();
        $orders = Order::whereDate('day', '<=', $endDate)->whereDate('day', '>=', $startDate)->where('completed', '1')->get()->groupBy('kid_id');

        foreach($attributes['kids'] as $kid_id){
            if (isset($orders[$kid_id])){
                foreach($orders[$kid_id] as $order){
                    $order->paid = true;
                    $order->save();
                }
            }
        }
    }

    public function payment(){
        $now = Carbon::now();
        $startDate = $now->copy()->subMonth()->startOfMontH();
        $endDate = $now->copy()->subMonth()->endOfMonth();
        $orders = Order::whereDate('day', '<=', $endDate)->whereDate('day', '>=', $startDate)->where('completed', '1')->where('paid', '0')->get()->groupBy('kid_id');
        $kids = auth()->user()->kids;
        $ordersSums = [];
        $payments = [];


        foreach($kids as $kid){
            $ordersSums[$kid->id] = 0;
            if (!isset($orders[$kid->id])) continue;
            $payments[] = $kid;
            foreach($orders[$kid->id] as $order){
                $ordersSums[$kid->id] += $order->price;
            }
        }

        

        $dishes = [];
        $count = 0;
        foreach($orders as $kid){
            foreach($kid as $order){
                foreach($order->preset->meals as $meal){
                    foreach($meal->dishes as $dish){
                        $dishes[$kids[$count]->id][$dish->id]['dish'] = $dish;
                        if (!isset($dishes[$kids[$count]->id][$dish->id]['count'])){
                            $dishes[$kids[$count]->id][$dish->id]['count'] = 0;
                        }
                        $dishes[$kids[$count]->id][$dish->id]['count']++;
                    } 
                }
            }
            $count++;
        }

        
        return view('kids.payment', [
            'kids' => $kids,
            'month' => $startDate->formatLocalized('%B %Y'),
            'dishes' => $dishes,
            'orderSums' => $ordersSums,
            'payments' => $payments
        ]);
    }
}
