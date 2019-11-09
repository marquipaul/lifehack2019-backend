<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
