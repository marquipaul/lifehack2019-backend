<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'address',
        'start', 
        'end',
        'long',
        'lat'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('approved')->withTimestamps();
    }
}
