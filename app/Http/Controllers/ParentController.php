<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function show(Kid $kid){
        return view('kids.show', [
            'kids' => auth()->user()->kids,
            'kid' => $kid
        ]);
    }
}
