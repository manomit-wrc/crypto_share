<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\countries;
use App\Group;
use App\Invitation;
use App\UserConvert;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role_code = Auth::user()->role_code;
            if($this->role_code == "SITEUSR") {
                echo "Permission Defined";
                die();
            }
            return $next($request);
        });
    }
    
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

    public function change_access($id, Request $request) {
        $user = User::find($id);
        $user->role_code = 'SITEADM';
        $user_exist_in_group = Group::where('user_id', $id)->get()->toArray();
        $user_exist_in_invitation = Invitation::where('user_id', $id)->get()->toArray();
        $count_group = count($user_exist_in_group);
        $count_invitation = count($user_exist_in_invitation);

        if ($count_group > 0 || $count_invitation > 0) {
            $request->session()->flash("submit-status", "User access changed can't be possible because there are some activity associated with this user.");
            return redirect('/users');
        } else {
            $user_convert = new UserConvert();
            $user_convert->user_id = $id;
            if ($user->save() && $user_convert->save()) {
                $request->session()->flash("submit-status", "User access changed successfully.");
                return redirect('/users');
            } else {
                $request->session()->flash("submit-status", "User access changed failed.");
                return redirect('/users');
            }
        }
    }
}
