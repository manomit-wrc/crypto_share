<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCoin extends Model
{
    protected $fillable = [
    	'coin_list_id', 'user_id', 'transaction_type', 'current_price', 'total_value', 'trade_price', 'quantity', 'trade_date', 'notes', 'chip_value', 'trade_type', 'target_1', 'target_2', 'target_3', 'status'
    ];

    public function coinlists() {
        return $this->belongsTo('\App\CoinList', 'coin_list_id');
    }
}
