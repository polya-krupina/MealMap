<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Unisender\ApiWrapper\UnisenderApi;

class UserGroupController extends Controller
{
    public function index(){
        $ways = [
            'parent' => view('parent.index', [
                'kids' => auth()->user()->kids,
                'groups' => Group::whereIn('id', auth()->user()->kids->pluck('id'))->get()
            ]),
            'admin' => 'admin.index',
            'teacher' => 'teacher.index',
            'canteen' => view('worker.index', [
                'groups' => auth()->user()->kindergarten->groups
            ])
        ];
        
        $user = auth()->user();
        
        return $ways[$user->getRoleNames()[0]];
    }
}
