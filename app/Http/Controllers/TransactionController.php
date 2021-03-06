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
        $user_coin_data_list = UserCoin::with('coinlists','groupInfo')->where([['user_id', '=', $user_id],['status', '=', 1]])->get();
    	return view('frontend.transaction_view')->with('user_coin_data_list', $user_coin_data_list);
    }

    public function previous_transaction() {
        $user_id = Auth::user()->id;
        $user_coin_data_list = UserCoin::with('coinlists','groupInfo')->where([['user_id', '=', $user_id],['status', '=', 0]])->get();
        return view('frontend.previous_transaction_view')->with('user_coin_data_list', $user_coin_data_list);
    }

    public function add_transaction($group_id) {
        $group_id = base64_decode($group_id);
        $coin_list = CoinList::All();
        $user_id = Auth::guard('crypto')->user()->id;
        $tot_longterm_chip = UserCoin::where([['user_id', '=', $user_id],['group_id', '=', $group_id],['transaction_type', '=', '1'],['status', '=', '1']])->sum('chip_value');
        $remain_longterm_chip = 100 - $tot_longterm_chip;
        $tot_trade_chip = UserCoin::where([['user_id', '=', $user_id],['group_id', '=', $group_id],['transaction_type', '=', '2'],['status', '=', '1']])->sum('chip_value');
        $remain_trade_chip = 100 - $tot_trade_chip;
        return view('frontend.transaction_add')->with('coin_list', $coin_list)->with(['group_id' => $group_id, 'tot_longterm_chip' => $tot_longterm_chip, 'remain_longterm_chip' => $remain_longterm_chip, 'tot_trade_chip' => $tot_trade_chip, 'remain_trade_chip' => $remain_trade_chip]);
    }

    public function get_price($coin_name) {
        $url = "https://min-api.cryptocompare.com/data/price?fsym=".$coin_name."&tsyms=USD,BTC";
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
            $user_coin->trade_price_usd = $request->tab1_trade_price_usd;
            $user_coin->trade_price_btc = $request->tab1_trade_price_btc;
            $user_coin->quantity = $request->tab1_qty;
            $user_coin->total_value_usd = $request->tab1_total_val_usd;
            $user_coin->total_value_btc = $request->tab1_total_val_btc;
            $user_coin->trade_date = date('Y-m-d', strtotime($request->tab1_trade_date));
            $user_coin->notes = $request->tab1_notes;
            $user_coin->chip_value = $request->tab1_chip_qty;
            $user_coin->trade_type = 'long_term';
        } else if ($request->tran_type == 2) {
            $user_coin->current_price = $request->tab2_current_price;
            $user_coin->trade_price_usd = $request->tab2_trade_price_usd;
            $user_coin->trade_price_btc = $request->tab2_trade_price_btc;
            $user_coin->quantity = $request->tab2_qty;
            $user_coin->total_value_usd = $request->tab2_total_val_usd;
            $user_coin->total_value_btc = $request->tab2_total_val_btc;
            $user_coin->trade_date = date('Y-m-d', strtotime($request->tab2_trade_date));
            $user_coin->notes = $request->tab2_notes;
            $user_coin->trade_type = 'trade';
            $user_coin->chip_value = $request->tab2_chip_qty;
            $user_coin->target_1 = $request->tab2_target1;
            $user_coin->target_2 = $request->tab2_target2;
            $user_coin->target_3 = $request->tab2_target3;
        } else {
            $user_coin->current_price = $request->tab3_current_price;
            $user_coin->trade_price_usd = $request->tab3_trade_price_usd;
            $user_coin->trade_price_btc = $request->tab3_trade_price_btc;
            $user_coin->quantity = 1;
            $user_coin->total_value_usd = $request->tab3_trade_price_usd;
            $user_coin->total_value_btc = $request->tab3_trade_price_btc;
            $user_coin->notes = $request->tab3_notes;
            $user_coin->trade_date = date('Y-m-d');
        }

        if ($user_coin->save()) {
            $request->session()->flash("submit-status", "Transaction added successfully.");
            return redirect('/group/dashboard/'.$request->group_id);
        } else {
            $request->session()->flash("submit-status", "Transaction addition failed.");
            return redirect('/group/transaction/add/'.$request->group_id);
        }
    }

    public function edit_transaction($group_id, $tran_id) {
        $group_id = base64_decode($group_id);
        $user_id = Auth::user()->id;
        $tran_details = UserCoin::with('coinlists')->where([['id','=',$tran_id],['group_id','=',$group_id]])->get()->toArray();
        $tot_longterm_chip = UserCoin::where([['user_id', '=', $user_id],['group_id', '=', $group_id],['id', '<>', $tran_id],['transaction_type', '=', '1'],['status', '=', '1']])->sum('chip_value');
        $remain_longterm_chip = 100 - $tot_longterm_chip;
        $tot_trade_chip = UserCoin::where([['user_id', '=', $user_id],['group_id', '=', $group_id],['id', '<>', $tran_id],['transaction_type', '=', '2'],['status', '=', '1']])->sum('chip_value');
        $remain_trade_chip = 100 - $tot_trade_chip;
        if (!empty($tran_details)) {
            return view('frontend.transaction_edit')->with(['group_id' => $group_id, 'tran_id' => $tran_id, 'tran_details' => $tran_details, 'tot_longterm_chip' => $tot_longterm_chip, 'remain_longterm_chip' => $remain_longterm_chip, 'tot_trade_chip' => $tot_trade_chip, 'remain_trade_chip' => $remain_trade_chip]);
        } else {
            return redirect('/group/group_transaction/'.base64_encode($group_id));
        }
    }

    public function update_transaction(Request $request) {
        $user_id = base64_decode($request->user_id);
        $user_coin = UserCoin::find($request->tran_id);
        $user_coin->transaction_type = $request->tran_type;
        if ($request->tran_type == 1) {
            $user_coin->quantity = $request->tab1_qty;
            $user_coin->total_value_usd = $request->tab1_total_val_usd;
            $user_coin->total_value_btc = $request->tab1_total_val_btc;
            $user_coin->notes = $request->tab1_notes;
            $user_coin->chip_value = $request->tab1_chip_qty;
            $user_coin->trade_type = 'long_term';
        } else if ($request->tran_type == 2) {
            $user_coin->quantity = $request->tab2_qty;
            $user_coin->total_value_usd = $request->tab2_total_val_usd;
            $user_coin->total_value_btc = $request->tab2_total_val_btc;
            $user_coin->notes = $request->tab2_notes;
            $user_coin->trade_type = 'trade';
            $user_coin->chip_value = $request->tab2_chip_qty;
            $user_coin->target_1 = $request->tab2_target1;
            $user_coin->target_2 = $request->tab2_target2;
            $user_coin->target_3 = $request->tab2_target3;
        } else {
            $user_coin->quantity = 1;
            $user_coin->total_value_usd = $user_coin->trade_price_usd;
            $user_coin->total_value_btc = $user_coin->trade_price_btc;
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
            return redirect('/group/group_transaction/edit/'.$request->group_id.'/'.$tran_id);
        }
    }

    public function remove_transaction($id, Request $request) {
        $user_coin = UserCoin::find($id);
        $user_coin->status = 0;
        if ($user_coin->save()) {
            $request->session()->flash("submit-status", "Transaction moved successfully.");
            return redirect('/transaction');
        } else {
            $request->session()->flash("submit-status", "Transaction movement failed.");
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
            return redirect('/transaction');
        }
    }
}
