<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\BroadcastChat;

class Chat extends Model
{
    // protected $dispatchesEvents = [
    //     'created' => BroadcastChat::class
    // ];

    protected $fillable = [
        'user_id', 'receiver_id', 'chat',
    ];
}
