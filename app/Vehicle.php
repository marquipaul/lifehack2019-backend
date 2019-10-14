<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'qr_code',
        'body_type',
        'make',
        'series', 
        'year_model', 
        'color', 
        'engine_number', 
        'chassis_number', 
        'me_control_number', 
        'lto_cc_number', 
        'plate_number',
        'mv_file_number',
        'mvrr_number',
        'cr_number',
        'scanned_stencil_chassis',
        'scanned_stencil_motor',
        'scanned_stencil_chassis_url',
        'scanned_stencil_motor_url'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function clearances()
    {
      return $this->belongsTo(ClearanceDescription::class);
    }
}
