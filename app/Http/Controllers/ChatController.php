<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Chat;
use App\Events\BroadcastChat;

class ChatController extends Controller
{
    public function friends()
    {
        return Auth::user()->friends();
    }

    public function sendChat(Request $request)
    {
        $chat = new Chat();
        $chat->user_id = Auth::user()->id;
        $chat->receiver_id = $request->receiver_id;
        $chat->chat = $request->chat;
        $chat->save();
        
        event(new BroadcastChat($chat));
        
        return $chat;
    }
}
