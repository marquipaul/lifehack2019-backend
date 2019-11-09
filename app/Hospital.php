<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    public function transactions()
    {
        return $this->hasMany(BloodRequest::class);
    }
}
