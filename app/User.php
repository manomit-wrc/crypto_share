<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'street_address', 'country_id', 'state', 'city', 'pincode', 'image', 'role_code', 'status' 
    ];

    public function countries() {
        return $this->belongsTo('\App\countries', 'country_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function invitations() {
        return $this->hasMany('\App\Invitation', 'user_id');
    }
}
