<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Group;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function schedule(){
        if (request('date'))
             $selected =  Carbon::createFromFormat('Y-m-d', request('date'));
        else
            $selected = Carbon::now();

        $weekStart = $selected->copy()->startOfWeek();
        $weekEnd = $selected->copy()->endOfWeek();

        $weekDates = [];
        for ($date = $weekStart->copy(); $date <= $weekEnd; $date->addDay()) {
            $weekDates[] = $date->copy();
        }

        $groups = auth()->user()->kindergarten->groups;

        if (request('group')){
            $selectedGroup = Group::find(request('group'));
            if (!$groups->contains($selectedGroup))
                return back()->withError(['group' => 'Недоступная группа']);
        }
        else 
            $selectedGroup = $groups->first();

        $kids = $selectedGroup->kids;
        $ordersToday = Order::where('day', $selected->format('Y-m-d'))->where('completed', 0)->where('paid', 0)->get();
        $kidsToday = $ordersToday->pluck('id');

        $ordersToday = $ordersToday->whereIn('kid_id', $kidsToday->intersect($kids->pluck('id')));
        
        $meals = [
            [],
            [],
            [],
            []
        ];
        $dishes = [];
        foreach ($ordersToday as $order){
            $template = $order->preset;
            $c = 0;
            foreach($template->meals as $meal){
                foreach($meal->dishes as $dish){
                    if (isset($dishes[$dish->id]))
                        $dishes[$dish->id]['count']++;
                    else{
                        $dishes[$dish->id]['count'] = 1;
                        $dishes[$dish->id]['name'] = $dish->name;
                    }
                    $meals[$c][$dish->id] = $dishes[$dish->id];
                }
                $c++;
            }
        }

        return view('worker.schedule',[
            'week' => $weekDates,
            'selected' => $selected,
            'weekStart' => $weekStart->isoformat("MMMM  D"),
            'weekEnd' => $weekEnd->isoformat("MMMM  D"),
            'groups' => $groups,
            'meals' => $meals,
            'dishes' => $dishes
        ]);
    }

    public function menu(){
        return view('worker.menu', [
            'dishes' => Dish::all()->groupBy('meal_type_id')
        ]);
    }

    public function save(Request $request){
        // ddd($request);

        $attributes = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'products' => 'required',
            'callories' => 'required',
            'proteins' => 'required',
            'carbohydrates' => 'required',
            'fats' => 'required',
        ]);

        $dish = new Dish();
        $dish->name = $attributes['name'];
        $dish->price = $attributes['price'];
        $dish->callories = $attributes['callories'];
        $dish->proteins = $attributes['proteins'];
        $dish->carbohydrates = $attributes['carbohydrates'];
        $dish->fats = $attributes['fats'];
        $dish->kindergarten_id = auth()->user()->kindergarten_id;
        $dish->meal_type_id = 1;
        
        // if (request('img'))
        //     $dish->avatar = $request->file('img')->store('avatars');
        
        $products = collect(preg_split('/[\s,]+/', $attributes['products']));
        $genered = new Collection();
        $diff = $products->diff(Product::all()->pluck('name'))->map( function ($elem) {
            $genered[] = Product::factory(1)->create([
                'name' => $elem
            ]);
        });
        
        $realProducts = Product::whereIn('name', $products)->get();

        $dish->save();
        $dish->products()->attach(
            $realProducts->pluck('id')->toArray()
        );

        return back();
    }
}