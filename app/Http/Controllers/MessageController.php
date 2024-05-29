<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create(Request $request){
        $data = $request->validate([
            'body' => 'required',
            'group_id' => 'required'
        ]);

        $message = new Message;
        $message->body = $data['body'];
        $message->user_id = auth()->user()->id;
        $message->group_id = $data['group_id']; // Пока что - заглушка
        $message->save();

        return 200;
    }

    public function get(Group $group){
        $messages = Message::where('group_id', $group->id)->with('user')->get();

        return $messages;
    }
}
