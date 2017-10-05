<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickPost extends Model
{
    public function user_name(){
		return $this->belongsTo('\App\User', 'user_id');
	}
}
