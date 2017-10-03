<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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
    	return view('frontend.transaction_add');
    }
}
