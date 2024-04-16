<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use App\Models\Dish;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Preset;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show(Kid $kid){
        $selected =  Carbon::createFromFormat('Y-m-d', request('date'));
        $order = $kid->orders()->where('day', $selected->toDateString())->first();
        $template = Auth::user()->presets()->where('id', request('template'))->first();
        $today = Carbon::today();

        $weekStart = $selected->copy()->startOfWeek();
        $weekEnd = $selected->copy()->endOfWeek();

        $weekDates = [];
        for ($date = $weekStart->copy(); $date <= $weekEnd; $date->addDay()) {
            $weekDates[] = $date->copy();
        }

        $weekOrders = [];
        
        for ($i = 0; $i < 7; $i++){
            $weekOrders[$i] = $kid->orders()->where('day', $weekDates[$i])->first();
        }

        if (!request('template') && $order)
            $template = Preset::find($order->preset_id);

        return view('kids.order', [
            'kids' => auth()->user()->kids,
            'preset' => $template,
            'order' => $order,
            'week' => $weekDates,
            'kid' => $kid,
            'dishes' => Dish::all()->groupBy('meal_type_id'),
            'date' => $selected,
            'today' => $today,
            'weekOrders' => $weekOrders
        ]);
    }

    public function store(Request $request){
        $order = Order::find($request['order_id']);
        $template = Preset::find($request['template_id']);
        $kid = Kid::find($request['kid_id']);
        $day = $request['date'];

        function count_price(Meal $meal){
            $price = 0;
            foreach($meal->dishes as $dish)
                $price += $dish->price;

            return $price;
        }


        if (!$order){
            $order = new Order();
            $order->kid_id = $kid->id;
            $order->preset_id = $template->id;
            $order->day = $day;
            $order->completed = 0;
            $order->price = 0;
            foreach ($template->meals as $meal)
                $order->price += count_price($meal);
            $order->save();
        } else {
            $order->preset_id = $template->id;
            $order->price = 0;
            foreach ($template->meals as $meal)
                $order->price += count_price($meal);
            $order->save();
        }

        return back()->with('success', 'Все получилось');
    }
}
