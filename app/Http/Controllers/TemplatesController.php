<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Preset;
class TemplatesController extends Controller
{
    public function show(){
        return view("templates.show", [
            'kids' => auth()->user()->kids
        ]);
    }

    public function create(){
        $preset = auth()->user()->presets->where('saved', 0)->first();
        if (!$preset){
            $preset = new Preset();
            $preset->name = 'Без_названия_' . count(auth()->user()->presets);
            $preset->user_id = auth()->user()->id;
            $preset->save();
        }

        return view("templates.create", [
            'kids' => auth()->user()->kids,
            'found' => Dish::find(request('id')),
            'dishes' => Dish::all()->groupBy('meal_type_id'),
            'preset' => $preset
        ]);
    }

    public function check(Request $request){
        $preset = Preset::find($request->id);

        if (! $preset->saved){
            $preset->delete();
        }

        return redirect('/');
    }

    public function save(Request $request){
        $preset = Preset::find($request->id);
        $preset->name = $request->name;
        $preset->saved = true;
        $preset->save();

        return redirect('/');   
    }
}
