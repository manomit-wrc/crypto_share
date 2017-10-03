<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\CoinList;

class TransactionController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->role_code = Auth::user()->role_code;
            if($this->role_code == "SITEADM") {
                echo "Permission Denied";
                die();
            }
            return $next($request);
        });
    }
    
	public function index() {
        $coin_list = CoinList::All();
    	return view('frontend.transaction_add')->with('coin_list', $coin_list);
    }
}
