<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;

class PageController extends Controller
{
    public function index() {
    	return view('frontend.index');
    }

    public function login() {
    	return view('frontend.login');	
    }

    public function register() {
    	return view('frontend.register');		
    }

    public function submit_registration(Request $request) {
    	Validator::make($request->all(),[
    		'first_name' => 'required|max:50',
    		'last_name' => 'required|max:50',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required|min:6|max:32',
    		'confirm_password' => 'required||min:6|max:32|same:password',
    		'aggrement' => 'required'
		],[
			'first_name.required' => 'Enter first name',
			'first_name.max:50' => 'Too long first name',
			'last_name.required' => 'Enter last name',
			'last_name.max:50' => 'Too long last name',
			'email.required' => 'Enter email address',
			'email.email' => 'Enter valid email address',
			'password.required' => 'Enter password',
			'password.min:6' => 'Minimum 6 character long',
			'password.min:32' => 'Maximum 32 character long',
			'confirm_password.required' => 'Enter confirm password',
			'aggrement.required' => 'Select aggrement'
		])->validate();

    	$user = new User();
    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
        $user->role_code = "SITEUSR";

    	if($user->save()) {
    		$request->session()->flash("message", "Registration completed successfully");
    	}
    	else {
    		$request->session()->flash("error_message", "Please try again");
    	}
    	return redirect('/register');
    }

    public function submit_login(Request $request) {
        Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Enter username',
            'password.required' => 'Enter password'
        ])->validate();

        if(Auth::guard('crypto')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            
            return redirect('/dashboard');
        }
        else {
            $request->session()->flash("login-status", "Email ID Or Password Didn't Matched");
            return redirect('/login');
        }
    }

    public function logout() {
        Auth::guard('crypto')->logout();
        return redirect('/login');
    }
}
