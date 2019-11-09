<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Chat;
use App\User;
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

    public function getChats($id)
    {
        $friend = User::find($id);

        $chats = Chat::where(function ($query) use ($id){
            $query->where('user_id', '=', Auth::user()->id)->where('receiver_id', '=', $id);
        })->orwhere(function ($query) use ($id){
            $query->where('user_id', '=', $id)->where('receiver_id', '=', Auth::user()->id);
        })->get();

        return response()->json([
            "friend" => $friend,
            "chats" => $chats
      ], 200);
    }
}
