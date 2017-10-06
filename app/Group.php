<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	public function user_info() {
        return $this->belongsTo('\App\User', 'user_id');
    }
}
