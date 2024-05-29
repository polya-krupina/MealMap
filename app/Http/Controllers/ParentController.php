<?php

namespace App\Http\Controllers;

use App\Models\Group;
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
            'weekStart' => $weekStart->isoformat("MMMM  D"),
            'weekEnd' => $weekEnd->isoformat("MMMM D"),
            'selected' => $selected,
            'weekOrders' => $weekOrders,
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get()
        ]);
    }

    public function allergy(Kid $kid){
        $allergies = $kid->allergies;
        $products = Product::all()->whereNotIn('id', $allergies->pluck('id'));

        return view('kids.allergies', [
            'kids' => auth()->user()->kids,
            'kid' => $kid,
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get(),
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

        return view('payment.show', [
            'kids' => $kids,
            'month' => $startDate->isoformat("MMMM Y"),
            'orderSums' => $ordersSums,
            'payments' => $payments,
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get(),
            'today' => $now
        ]);
    }

    public function history(){
        $selected =  Carbon::createFromFormat('Y-m-d', request('date'));
        $startDate = $selected->copy()->startOfMontH();
        $endDate = $selected->copy()->endOfMonth();
        $orders = Order::whereDate('day', '<=', $endDate)->whereDate('day', '>=', $startDate)->where('completed', '1')->where('paid', '1')->get()->groupBy('kid_id');
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


        
        return view('payment.history', [
            'kids' => $kids,
            'month' => $startDate->formatLocalized('%B %Y'),
            'orderSums' => $ordersSums,
            'payments' => $payments,    
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get(),
            'date' => $selected
        ]);
    }
}
