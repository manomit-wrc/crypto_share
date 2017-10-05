<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\CoinList;
use App\UserCoin;
use Validator;

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
        $user_id = Auth::user()->id;
        $user_coin_data_list = UserCoin::with('coinlists')->where('user_id',$user_id)->get();
        //echo "<pre>";
        //print_r($user_coin_data_list); exit;
    	return view('frontend.transaction_view')->with('user_coin_data_list', $user_coin_data_list);
    }

    public function add_transaction() {
        $coin_list = CoinList::All();
        return view('frontend.transaction_add')->with('coin_list', $coin_list);
    }

    public function get_price($coin_name) {
        $url = "https://min-api.cryptocompare.com/data/price?fsym=".$coin_name."&tsyms=USD";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close ($ch);
        echo $json;
    }

    public function insert_transaction(Request $request) {
        $user_id = base64_decode($request->user_id);
        Validator::make($request->all(),[
            'coin_full_name' => 'required'
        ])->validate();

        $user_coin = new UserCoin();
        $user_coin->coin_list_id = $request->coin_id;
        $user_coin->user_id = $user_id;
        $user_coin->transaction_type = $request->tran_type;
        if ($request->tran_type == 1) {
            $user_coin->current_price = $request->tab1_current_price;
            $user_coin->trade_price = $request->tab1_trade_price;
            $user_coin->quantity = $request->tab1_qty;
            $user_coin->total_value = $request->tab1_total_val;
            $user_coin->trade_date = date('Y-m-d');
            $user_coin->notes = $request->tab1_notes;
            $user_coin->chip_value = $request->tab1_chip_qty;
            $user_coin->trade_type = 'long_term';
        } else if ($request->tran_type == 2) {
            $user_coin->current_price = $request->tab2_current_price;
            $user_coin->trade_price = $request->tab2_trade_price;
            $user_coin->quantity = $request->tab2_qty;
            $user_coin->total_value = $request->tab2_total_val;
            $user_coin->trade_date = date('Y-m-d');
            $user_coin->notes = $request->tab2_notes;
            $user_coin->trade_type = 'trade';
            $user_coin->target_1 = $request->tab2_target1;
            $user_coin->target_2 = $request->tab2_target2;
            $user_coin->target_3 = $request->tab2_target3;
        } else {
            $user_coin->current_price = $request->tab3_current_price;
            $user_coin->trade_price = $request->tab3_trade_price;
            $user_coin->quantity = $request->tab3_qty;
            $user_coin->total_value = $request->tab3_total_val;
            $user_coin->notes = '';
            $user_coin->trade_date = date('Y-m-d');
        }

        if ($user_coin->save()) {
            $request->session()->flash("submit-status", "Transaction added successfully.");
            return redirect('/transaction');
        } else {
            $request->session()->flash("submit-status", "Transaction added failed.");
            return redirect('/transaction');
        }
    }

    public function delete_transaction($id, Request $request) {
        $user_coin = UserCoin::find($id);
        if ($user_coin->delete()) {
            $request->session()->flash("submit-status", "Transaction deleted successfully.");
            return redirect('/transaction');
        } else {
            $request->session()->flash("submit-status", "Transaction delete failed.");
            return redirect('/transaction/');
        }
    }
}