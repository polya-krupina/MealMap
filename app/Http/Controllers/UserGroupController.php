<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index(){
        return view("parent.index", [
            'kids' => auth()->user()->kids
        ]);
    }
}
