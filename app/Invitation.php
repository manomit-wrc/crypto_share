<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
	public function groups(){
		return $this->belongsTo('\App\Group', 'group_id');
	}
    
}
