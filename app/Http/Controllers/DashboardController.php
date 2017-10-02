<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
    	/*$ch = curl_init(); 
    	curl_setopt($ch, CURLOPT_URL, "https://www.cryptocompare.com/api/data/coinlist/"); 
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    	$json = curl_exec($ch); 
    	curl_close ($ch);
    	echo "<pre>";
    	print_r(json_decode($json));
    	die();*/
    	return view('frontend.dashboard');
    }
}
