<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
    	'first_name','last_name','designation','description','facebook_url','twitter_url','google_plus_url','status'
    ];
}
