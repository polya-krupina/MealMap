<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Unisender\ApiWrapper\UnisenderApi;

class UserGroupController extends Controller
{
    public function index(){
        $ways = [
            'parent' => view('parent.index', [
                'kids' => auth()->user()->kids
            ]),
            'admin' => 'admin.index',
            'teacher' => 'teacher.index',
            'canteen' => 'canteen.index'
        ];
        
        $user = auth()->user();
        
        return $ways[$user->getRoleNames()[0]];
    }
}
