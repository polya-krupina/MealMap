<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function login(){
        return view("sessions.create");
    }

    public function store(Request $request){
        $attributes = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);
        
        if (! auth()->attempt($attributes)) {
            return back()
            ->withInput()
            ->withErrors(["username" => 'Не существует аккаунта с такими данными']);
        }
        
        session()->regenerate();

        return redirect('');
    }
}
