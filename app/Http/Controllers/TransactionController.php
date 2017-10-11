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
        $user_coin_data_list = UserCoin::with('coinlists','groupInfo')->where('user_id',$user_id)->get();
        //echo "<pre>";
        //print_r($user_coin_data_list); exit;
    	return view('frontend.transaction_view')->with('user_coin_data_list', $user_coin_data_list);
    }

    public function add_transaction($group_id) {
        $group_id = base64_decode($group_id);
        $coin_list = CoinList::All();
        return view('frontend.transaction_add')->with('coin_list', $coin_list)->with('group_id', $group_id);
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
        $user_coin->group_id = base64_decode($request->group_id);
        $user_coin->user_id = $user_id;
        $user_coin->transaction_type = $request->tran_type;
        if ($request->tran_type == 1) {
            $user_coin->current_price = $request->tab1_current_price;
            $user_coin->trade_price = $request->tab1_trade_price;
            $user_coin->quantity = $request->tab1_qty;
            $user_coin->total_value = $request->tab1_total_val;
            $user_coin->trade_date = date('Y-m-d', strtotime($request->tab1_trade_date));
            $user_coin->notes = $request->tab1_notes;
            $user_coin->chip_value = $request->tab1_chip_qty;
            $user_coin->trade_type = 'long_term';
        } else if ($request->tran_type == 2) {
            $user_coin->current_price = $request->tab2_current_price;
            $user_coin->trade_price = $request->tab2_trade_price;
            $user_coin->quantity = $request->tab2_qty;
            $user_coin->total_value = $request->tab2_total_val;
            $user_coin->trade_date = date('Y-m-d', strtotime($request->tab2_trade_date));
            $user_coin->notes = $request->tab2_notes;
            $user_coin->trade_type = $request->trade_type;
            $user_coin->chip_value = $request->tab2_chip_qty;
            $user_coin->target_1 = $request->tab2_target1;
            $user_coin->target_2 = $request->tab2_target2;
            $user_coin->target_3 = $request->tab2_target3;
        } else {
            $user_coin->current_price = $request->tab3_current_price;
            $user_coin->trade_price = $request->tab3_trade_price;
            $user_coin->quantity = 1;
            $user_coin->total_value = $request->tab3_trade_price;
            $user_coin->notes = $request->tab3_notes;
            $user_coin->trade_date = date('Y-m-d');
        }

        if ($user_coin->save()) {
            $request->session()->flash("submit-status", "Transaction added successfully.");
            return redirect('/group/dashboard/'.$request->group_id);
        } else {
            $request->session()->flash("submit-status", "Transaction added failed.");
            return redirect('/group_transaction/add/'.$request->group_id);
        }
    }

    public function edit_transaction($group_id, $tran_id) {
        $group_id = base64_decode($group_id);
        $tran_details = UserCoin::with('coinlists')->where([['id','=',$tran_id],['group_id','=',$group_id]])->get()->toArray();
        if (!empty($tran_details)) {
            return view('frontend.transaction_edit')->with(['group_id' => $group_id, 'tran_id' => $tran_id, 'tran_details' => $tran_details]);
        } else {
            return redirect('/group_transaction/'.base64_encode($group_id));
        }
    }

    public function update_transaction(Request $request) {
        $user_id = base64_decode($request->user_id);
        $user_coin = UserCoin::find($request->tran_id);
        $user_coin->transaction_type = $request->tran_type;
        if ($request->tran_type == 1) {
            $user_coin->quantity = $request->tab1_qty;
            $user_coin->total_value = $request->tab1_total_val;
            $user_coin->notes = $request->tab1_notes;
            $user_coin->chip_value = $request->tab1_chip_qty;
            $user_coin->trade_type = 'long_term';
        } else if ($request->tran_type == 2) {
            $user_coin->quantity = $request->tab2_qty;
            $user_coin->total_value = $request->tab2_total_val;
            $user_coin->notes = $request->tab2_notes;
            $user_coin->trade_type = $request->trade_type;
            $user_coin->chip_value = $request->tab2_chip_qty;
            $user_coin->target_1 = $request->tab2_target1;
            $user_coin->target_2 = $request->tab2_target2;
            $user_coin->target_3 = $request->tab2_target3;
        } else {
            $user_coin->quantity = 1;
            $user_coin->total_value = $user_coin->trade_price;
            $user_coin->notes = $request->tab3_notes;
            $user_coin->trade_type = '';
            $user_coin->chip_value = '';
            $user_coin->target_1 = '';
            $user_coin->target_2 = '';
            $user_coin->target_3 = '';
        }

        if ($user_coin->save()) {
            $request->session()->flash("submit-status", "Transaction updated successfully.");
            return redirect('/group/dashboard/'.$request->group_id);
        } else {
            $request->session()->flash("submit-status", "Transaction updation failed.");
            return redirect('/group_transaction/edit/'.$request->group_id.'/'.$tran_id);
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
