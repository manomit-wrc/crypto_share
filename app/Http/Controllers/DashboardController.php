<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        if (Auth::guard('crypto')->user()->role_code == 'SITEADM') {
            return view('frontend.dashboard_admin');
        } else {
            return view('frontend.dashboard_user');
        }
    }

    public function coinList() {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://www.cryptocompare.com/api/data/coinlist/"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $json = curl_exec($ch); 
        $json_data = json_decode($json,true);
        curl_close ($ch);
        /*echo "<pre>";
        print_r($value['Data'][0]);
        die();*/
        $i=0;
        foreach ($json_data['Data'] as $key => $value) {
            $coin_list = new \App\CoinList();

            $coin_list->coin_id = $value['Id'];
            $coin_list->url = array_key_exists("Url", $value)? $value['Url']: '';
            $coin_list->image_url = array_key_exists("ImageUrl", $value)? $value['ImageUrl']: '';
            $coin_list->name = array_key_exists("Name", $value)? $value['Name']: '';
            $coin_list->coin_name = array_key_exists("CoinName", $value)? $value['CoinName']: '';
            $coin_list->full_name = array_key_exists("FullName", $value)? $value['FullName']: '';
            $coin_list->algorithm = array_key_exists("Algorithm", $value)? $value['Algorithm']: '';
            $coin_list->proof_type = array_key_exists("ProofType", $value)? $value['ProofType']: '';
            $coin_list->fully_premined = array_key_exists("FullyPremined", $value)? $value['FullyPremined']: '';
            $coin_list->total_coin_supply = array_key_exists("TotalCoinSupply", $value)?$value['TotalCoinSupply']: '';
            $coin_list->pre_mined_value = array_key_exists("PreMinedValue", $value)?$value['PreMinedValue']: '';
            $coin_list->total_coins_free_float = array_key_exists("TotalCoinsFreeFloat", $value)?$value['TotalCoinsFreeFloat']: '';
            $coin_list->sort_order = array_key_exists("SortOrder", $value)?$value['SortOrder']: '';
            $coin_list->sponsored = (array_key_exists("FullName", $value)? ($value['Sponsored']? true: false): false);

            $coin_list->save();

            echo $i++;
            echo "<br/>";

        }
    }
}
