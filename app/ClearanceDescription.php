<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClearanceDescription extends Model
{
    public function vehicle()
    {
      return $this->belongsTo(Vehicle::class);
    }

    public function appointments()
    {
      return $this->belongsTo(Appointment::class);
    }
}
