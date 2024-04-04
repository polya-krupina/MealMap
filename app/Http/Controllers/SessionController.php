<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function login(){
        return view("sessions.create");
    }

    public function store(Request $request){
        $attributes = $request->validate([
            "phone_number" => "required",
            "password" => "required"
        ]);
        

        if (! Auth::attempt($attributes)) {
            return back()
            ->withInput()
            ->withErrors(["phone_number" => 'Не существует аккаунта с такими данными']);
        }
        
        session()->regenerate();

        return redirect('');
    }

    public function destroy(){
        Auth::logout();
        
        return redirect('');
    }
}
