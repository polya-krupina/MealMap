<?php

namespace App\Http\Controllers;

use App\models\Kid;
use Illuminate\Http\Request;

class KidController extends Controller
{
    public function avatarChange(Request $request){
        $attributes = $request->validate([
            'kid_id' => 'required',
            'file' => 'required'
        ]);

        $path = $request->file('file')->store('avatars');
        $kid = Kid::find($attributes['kid_id']);

        $kid->avatar = $path;
        $kid->save();
        return $request;
    }
}
