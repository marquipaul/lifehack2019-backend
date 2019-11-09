<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Chat;

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

        return $chat;
    }
}
