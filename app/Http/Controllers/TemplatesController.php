<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Preset;
class TemplatesController extends Controller
{
    public function show(){
        return view("templates.show", [
            'kids' => auth()->user()->kids,
            'presets' => auth()->user()->presets->where('saved', 1)
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
        $deleted = false;
        if (! $preset->saved){
            $preset->delete();
            $deleted = true;
        }

        return $deleted;
    }

    public function save(Request $request){
        $preset = Preset::find($request->id);
        $preset->name = $request->name;
        $preset->saved = true;
        $preset->save();

        return redirect('/');   
    }

    public function destroy(Preset $preset){
        $preset->delete();

        return back()->with('success','');
    }

    public function edit(Preset $preset){
        return view('templates.edit', [
            'preset' => $preset,
            'kids' => auth()->user()->kids,
            'dishes' => Dish::all()->groupBy('meal_type_id'),
        ]);
    }
}
