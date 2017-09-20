<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function countries() {
        return $this->belongsTo('\App\countries', 'country_id');
    }
}
