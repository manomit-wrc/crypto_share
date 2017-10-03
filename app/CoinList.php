<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinList extends Model
{
    protected $fillable = [
    	'coin_id', 'url', 'image_url', 'name', 'coin_name', 'full_name', 'algorithm', 'proof_type', 'fully_premined', 'total_coin_supply', 'pre_mined_value', 'total_coins_free_float', 'sort_order', 'sponsored'
    ];
}
