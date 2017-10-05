<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function group_coins() {
        return $this->belongsTo('\App\UserCoin', 'group_id');
    }
}
