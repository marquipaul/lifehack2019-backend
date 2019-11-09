<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qr_code',
        'name',
        'birthday', 
        'gender',
        'user_type',
        'email',
        'mobile_number',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function joinedevents()
    {
        return $this->belongsToMany(Event::class)->withPivot('approved')->withTimestamps();
    }

    public function locations()
    {
        return $this->hasMany(UserLocation::class);
    }

    public function myRequests()
    {
        return $this->hasMany(BloodRequest::class, 'user_id');
    }

    public function myDonations()
    {
        return $this->hasMany(BloodRequest::class, 'donor_id');
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'requestor_id', 'donor_id');
    }
    public function friendsOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'donor_id', 'requestor_id');
    }

    public function friends()
    {
        return $this->friendsOfMine->merge($this->friendsOf);
    }
}
