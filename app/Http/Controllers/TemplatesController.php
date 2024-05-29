<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Preset;
use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

class TemplatesController extends Controller
{
    public function show(){
        return view("templates.show", [
            'kids' => auth()->user()->kids,
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get(),
            'presets' => auth()->user()->presets->where('saved', 1)
        ]);
    }

    public function create(){
        return view("templates.create", [
            'kids' => auth()->user()->kids,
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get(),
            'dishes' => Dish::all()->groupBy('meal_type_id')
        ]);
    }

    public function save(Request $request){
        
        function add_dishes($collection, $dishes){
            $collection->dishes()->attach(explode(',', $dishes));
        }

        function update_dishes($collection, $dishes){
            $collection->dishes()->sync(explode(',', $dishes));
        }

        $attributes = $request->validate([
            'name' => 'required',
            'breakfast' => 'required',
            'second_breakfast' => 'required',
            'dinner' => 'required',
            'half_day' => 'required' 
        ]);
        if ($request['id']){
            $preset = Preset::find($request['id']);
            update_dishes($preset->meals[0], $attributes['breakfast']);
            update_dishes($preset->meals[1], $attributes['second_breakfast']);
            update_dishes($preset->meals[2], $attributes['dinner']);
            update_dishes($preset->meals[3], $attributes['half_day']);
        } else {
            $preset = new Preset;
            $preset->user_id = auth()->user()->id;
            $preset->saved = 1;
            $preset->name = $attributes['name'];
            $preset->save();
            add_dishes($preset->meals[0], $attributes['breakfast']);
            add_dishes($preset->meals[1], $attributes['second_breakfast']);
            add_dishes($preset->meals[2], $attributes['dinner']);
            add_dishes($preset->meals[3], $attributes['half_day']);
        }
        $preset->name = $attributes['name'];
        $preset->save();

        return redirect('/templates');   
    }


    public function destroy(Preset $preset){
        $preset->delete();

        return back()->with('success','');
    }

    public function edit(Preset $preset){
        return view('templates.edit', [
            'preset' => $preset,
            'kids' => auth()->user()->kids,
            'groups' => Group::whereIn('id',auth()->user()->kids->pluck('group_id')->unique())->get(),
            'dishes' => Dish::where('kindergarten_id', auth()->user()->kindergarten_id)->get()->groupBy('meal_type_id'),
        ]);
    }
}
