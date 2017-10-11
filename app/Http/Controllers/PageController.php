<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Auth;
use App\countries;
use Image;
use Hash;
use App\Organization;
use App\Testimonial;
use App\Pricing;
use App\Work;
use App\Group;
use App\Invitation;
use App\Team;
use App\ContactUs;
use App\CoinList;
use App\UserCoin;
use Mail;
use App\Mail\contact_us_email;
use App\Mail\RegistrationEmail;
// use Illuminate\Support\Facades\Mail;
use Config;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('crypto')->check()) {
                $this->role_code = Auth::user()->role_code;
                if ($this->role_code == "SITEADM" && $request->segment(1) == "group") {
                    echo "Permission Denied";
                    die();
                }
                if ($this->role_code == "SITEUSR" && $request->segment(1) == "view-settings") {
                    echo "Permission Denied";
                    die();
                }
            }
            return $next($request);
        });
    }
    
    public function index() {
        $testimonial = Testimonial::all();
        $pricing = Pricing::where('status','1')->get();
        $work = Work::where('status','1')->get();
        $contact_details = Organization::with('countries')->get()->toArray();
        $team = Team::where('status','1')->get();
    	return view('frontend.index')->with(['all_testimonial'=>$testimonial, 'all_pricing'=>$pricing, 'contact_details'=>$contact_details, 'work'=>$work, 'team' => $team]);
    }

    public function explore_group() {
        //$all_groups = Group::with('user_info')->where('status','1')->get()->toArray();
        $all_groups = Group::with('user_info')->where([['status','1'],['current_status','1']])->paginate(5);
        
        foreach($all_groups as $key => $value){
            $group_id = $value['id'];
            $fetch_member_of_group = Invitation::where([['group_id','=',$group_id],['status','=',1]])->get()->toArray();
            $total_member_of_group = count($fetch_member_of_group);
            $all_groups[$key]['total_member_of_group'] = $total_member_of_group;
        }
        $temp_array = $all_groups->toArray();
        $from_page = $temp_array['from'];
        
        //echo "<pre>";
        //print_r($all_groups); exit;
        return view('frontend.explore_group')->with('all_groups', $all_groups)->with('from_page', $from_page);
    }

    public function contact_us_submit(Request $request) {
        $name = $request->name;
        $email = $request->email;
        $msg = $request->msg;

        $add = new ContactUs();
        $add->name = $name;
        $add->email = $email;
        $add->msg = $msg;

        if ($add->save()) {
            $to_email = 'sobhandas30@gmail.com';
            try{
                Mail::to($to_email)->send(new contact_us_email($name,$email,$msg));
                echo 1;
            }catch(Exception $e){
                echo "<pre>";
                print_r($e);
                die();
                return response()->json(['code'=>500,'message'=>$e]);
            }
        }
    }

    public function login(Request $request) {
        if (Auth::guard('crypto')->check() && $request->segment(1) == 'login') {
            return redirect('/dashboard');
        }
    	return view('frontend.login');
    }

    public function register(Request $request) {
        if (Auth::guard('crypto')->check() && $request->segment(1) == 'register') {
            return redirect('/dashboard');
        }
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

        $config_details = Organization::all()->toArray();

    	$user = new User();
    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
        $user->role_code = "SITEUSR";
        $user->status = "2";

        $user->active_token = str_replace("/", "", Hash::make(str_random(30)));

    	if ($user->save()) {
            $activation_link = config('app.url').'activate/'.$user->active_token."/".time();
            Mail::to($request->email)->send(new RegistrationEmail($activation_link, $config_details[0]['email']));
    		$request->session()->flash("message", "Registration completed successfully. One activation link has been sent to your email to activate your account.");
    	}
    	else {
    		$request->session()->flash("error_message", "There are some problem occured in registration process. Please try again!");
    	}
    	return redirect('/register');
    }

    public function activate_reg($token, $activate_time, Request $request) {
        $user = User::where('active_token', '=', $token);
        if ($user->update(['status' => '1'])) {
            $request->session()->flash("message", "You are now active and can log in with your credentials.");
            return redirect('/register');
        } else {
            $request->session()->flash("error_message", "User activation failed.");
            return redirect('/register');
        }
    }

    public function submit_login(Request $request) {
        Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Enter username',
            'password.required' => 'Enter password'
        ])->validate();

        if (Auth::guard('crypto')->attempt(['email'=>$request->email, 'password'=>$request->password, 'status'=>'1'], $request->remember)) {
            return redirect('/dashboard');
        }
        else if (Auth::guard('crypto')->attempt(['email'=>$request->email, 'password'=>$request->password, 'status'=>'2'], $request->remember)) {
            $request->session()->flash("login-status", "User is not active. Please activate your account to log in!");
            return redirect('/login');
        }
        else {
            $request->session()->flash("login-status", "Email Address or Password didn't matched!");
            return redirect('/login');
        }
    }

    public function edit_profile_view () {
        $fetch_all_countries = countries::all()->toArray();
        return view('frontend.profile')->with('fetch_all_countries', $fetch_all_countries);
    }

    public function profile_edit(Request $request) {
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


        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time().'_'.$file->getClientOriginalName();
            //thumb destination path
            $destinationPath_2 = public_path().'/upload/profile_image/resize/';
            $img = Image::make($file->getRealPath());
            $img->resize(175, 175, function ($constraint) {
              $constraint->aspectRatio();
            })->save($destinationPath_2.'/'.$fileName);
            //original destination path
            $destinationPath = public_path().'/upload/profile_image/original/';
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

        if ($obj->save()) {
            $request->session()->flash("submit-status", "Profile edited successfully.");
            return redirect('/dashboard');
        } else {
            $request->session()->flash("submit-status", "Profile edit failed.");
            return redirect('/edit_profile');
        }
    }

    public function view_settings () {
        $fetch_details = Organization::all()->toArray();
        $fetch_all_countries = countries::all()->toArray();

        return view('frontend.settings')->with('fetch_details' , $fetch_details[0])
                                        ->with('fetch_all_countries', $fetch_all_countries);
    }

    public function edit_settings (Request $request) {
        Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_number' => 'required | max:10 | regex:/^[0-9]*$/',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'fb_link' => 'required',
            'tw_link' => 'required',
            'linkedin_link' => 'required'
        ], [
            'fullname.required' => "Full Name can't be left blank",
            'email.required' => "Email can't be left blank",
            'address.required' => "Address can't be left blank",
            'phone_number.required' => "Phone number can't be left blank",
            'country.required' => "Country can't be left blank",
            'state.required' => "State can't be left blank",
            'city.required' => "City can't be left blank",
            'pincode.required' => "Pincode can't be left blank",
            'fb_link.required' => "Facebook link can't be left blank",
            'tw_link.required' => "Twitter link can't be left blank",
            'linkedin_link.required' => "Linkedin link can't be left blank"
        ])->validate();

        $edit = Organization::find('1');
        $edit->name = $request->fullname;
        $edit->email = $request->email;
        $edit->address = $request->address;
        $edit->phone_no = $request->phone_number;
        $edit->country_id = $request->country;
        $edit->state_name = $request->state;
        $edit->city_name = $request->city;
        $edit->pincode = $request->pincode;
        $edit->facebook = $request->fb_link;
        $edit->twitter = $request->tw_link;
        $edit->linkedin = $request->linkedin_link;

        if ($edit->save()) {
            $request->session()->flash("submit-status", "Edit Successfully.");
            return redirect('/view-settings');
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
        return redirect('/');
    }

    public function coin_property_update(Request $request){
        $fetch_user_coin_list = UserCoin::with('coinlists')->get()->toArray();

        foreach ($fetch_user_coin_list as $key => $value) {
            $user_coin_list_id = $value['id'];
            $coin_name = $value['coinlists']['name'];

            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "https://min-api.cryptocompare.com/data/histominute?fsym=".$coin_name."&tsym=USD&limit=1"); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            $json = curl_exec($ch); 
            $json_data = json_decode($json,true);

            $edit = UserCoin::find($user_coin_list_id);
            $edit->close = $json_data['Data'][0]['close'];
            $edit->high = $json_data['Data'][0]['high'];
            $edit->low = $json_data['Data'][0]['low'];
            $edit->open = $json_data['Data'][0]['open'];
            $edit->volumefrom = $json_data['Data'][0]['volumefrom'];
            $edit->volumeto = $json_data['Data'][0]['volumeto'];

            $save = $edit->save();

            curl_close ($ch);           
        }
        if($save){
            echo "update successfully";
        }
    }
}
