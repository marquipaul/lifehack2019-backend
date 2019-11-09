<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function requestor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
