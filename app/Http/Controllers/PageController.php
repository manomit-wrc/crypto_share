<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;
use App\countries;
use Image;
use Hash;

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

    public function edit_profile_view (){
        $fetch_all_countries = countries::all()->toArray();
        return view('frontend.profile')->with('fetch_all_countries', $fetch_all_countries);
    }

    public function profile_edit(Request $request){
        $id = base64_decode($request->user_id);

        Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'profile_image' => 'required_with|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'first_name.required' => "First name can't be left blank.",
            'last_name.required' => "Last name can't be left blank.",
            'address.required' => "Address can't be left blank.",
            'state.required' => "State name can't be left blank.",
            'country.required' => "Country name can't be left blank.",
            'city.required' => "City name can't be left blank.",
            'pincode.required' => "Pincode can't be left blank.",
            'profile_image.required_with' => "Profile image can't be left blank.",
            'profile_image.image|mimes:jpeg,png,jpg,gif,svg' => 'Please choose proper image type',
            'profile_image.max:2048' => 'Maximum file size should be 2 MB'
        ])->validate();


        if($request->hasFile('profile_image')) {
          $file = $request->file('profile_image') ;

          $fileName = time().'_'.$file->getClientOriginalName() ;

          //thumb destination path
          
          $destinationPath_2 = public_path().'/upload/profile_image/resize' ;

          $img = Image::make($file->getRealPath());

          
          $img->resize(175, 175, function ($constraint){
              $constraint->aspectRatio();
          })->save($destinationPath_2.'/'.$fileName);

          //original destination path
          $destinationPath = public_path().'/upload/profile_image/original/' ;
          $file->move($destinationPath,$fileName);
        }
        else {
          $fileName = $request->exiting_profile_image;
        }

        $obj = User::find($id);
        $obj->first_name = $request->first_name;
        $obj->last_name = $request->last_name;
        $obj->street_address = $request->address;
        $obj->country_id = $request->country;
        $obj->state = $request->state;
        $obj->city = $request->city;
        $obj->pincode = $request->pincode;
        $obj->image = $fileName;

        if($obj->save()){
            $request->session()->flash("submit-status", "Profile eidt successfully.");
            return redirect('/dashboard');
        }else{
            $request->session()->flash("submit-status", "Profile eidt failed.");
            return redirect('/edit_profile');
        }
    }

    public function change_pass() {
        return view('frontend.change_pass');
    }

    public function update_password(Request $request) {
        $id = base64_decode($request->user_id);
        Validator::make($request->all(),[
            'old_pass' => 'required',
            'new_pass' => 'required|different:old_pass|min:6',
            're_pass' => 'required|same:new_pass'
        ])->validate();

        $obj = User::find($id);

        if (Hash::check($request->old_pass, $obj->password)) {
            $obj->password = bcrypt($request->new_pass);
            if ($obj->save()) {
                $request->session()->flash("submit-status", "Password changed successfully.");
                return redirect('/dashboard');
            } else {
                $request->session()->flash("submit-status", "Password change failed.");
                return redirect('/change_pass');
            }
        }
        else {
            $request->session()->flash("submit-status", "Old password does not match the database password");
            return redirect('/change_pass');
        }
    }

    public function logout() {
        Auth::guard('crypto')->logout();
        return redirect('/login');
    }
}
