<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
      return $this->belongsTo(Vehicle::class);
    }

    public function clearance()
    {
      return $this->belongsTo(ClearanceDescription::class, 'clearance_description_id');
    }
}
