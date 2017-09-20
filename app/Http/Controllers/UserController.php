<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\countries;

class UserController extends Controller
{
    public function index() {
    	$user = User::with('countries')->where('role_code','SITEUSR')->get()->toArray();
    	return view('frontend.user_view')->with('all_users', $user);
    }

    public function deact_user($id, Request $request) {
    	$user = User::find($id);
        $user->status = '0';

    	if ($user->save()) {
    		$request->session()->flash("submit-status", "User de-activated successfully.");
            return redirect('/users');
    	} else {
    		$request->session()->flash("submit-status", "User de-activation failed.");
            return redirect('/users');
    	}
    }

    public function activate_user($id, Request $request) {
    	$user = User::find($id);
    	$user->status = '1';

    	if ($user->save()) {
    		$request->session()->flash("submit-status", "User activated successfully.");
            return redirect('/users');
    	} else {
    		$request->session()->flash("submit-status", "User activation failed.");
            return redirect('/users');
    	}
    }
}