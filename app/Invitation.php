<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
	public function groups(){
		return $this->belongsTo('\App\Group', 'group_id');
	}

	public function users(){
		return $this->belongsTo('\App\User', 'user_id');
	}

	
    
}
