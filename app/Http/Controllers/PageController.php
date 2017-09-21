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
use App\Mail\RegistrationEmail;
use Illuminate\Support\Facades\Mail;
use Config;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::guard('crypto')->check()) {
                $this->role_code = Auth::user()->role_code;
                if($this->role_code == "SITEADM" && $request->segment(1) == "group") {
                    echo "Permission Defined";
                    die();
                }
                if($this->role_code == "SITEUSR" && $request->segment(1) == "view-settings") {
                    echo "Permission Defined";
                    die();
                }
            }
            return $next($request);
        });
    }
    
    public function index() {
        $testimonial = Testimonial::All();
        $pricing = Pricing::where('status','1')->get();
        $work = Work::where('status','1')->get();
        $contact_details = Organization::with('countries')->get()->toArray();
        $team = Team::where('status','1')->get();
    	return view('frontend.index')->with(['all_testimonial'=>$testimonial, 'all_pricing'=>$pricing, 'contact_details'=>$contact_details, 'work'=>$work, 'team' => $team]);
    }

    public function login(Request $request) {
        if(Auth::guard('crypto')->check() && $request->segment(1) == 'login') {
            return redirect('/dashboard');
        }
    	return view('frontend.login');
    }

    public function register(Request $request) {
        if(Auth::guard('crypto')->check() && $request->segment(1) == 'register') {
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
            Mail::to($request->input('email'))->send(new RegistrationEmail($activation_link));
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

        if($edit->save()){
            $request->session()->flash("submit-status", "Edit Successfully.");
            return redirect('/view-settings');
        }
    }

    public function add_group_by_user () {
        $fetch_all_group = Group::where('user_id', Auth::guard('crypto')->user()->id)
        ->where('current_status',1)
        ->orderby('id','desc')
        ->get()
        ->toArray();

        $details = \App\Invitation::with('groups')->where([['status','=','2'],['user_id','<>',Auth::guard('crypto')->user()->id]])
        ->get()->toArray();
        // echo "<pre>";
        // print_r($fetch_all_group);
        // echo "<hr>";
        // print_r($details);
        // echo "</pre>";
        // die();

        return view('frontend.group.view_groups')->with('fetch_all_group', $fetch_all_group);
    }

    public function create_group(){
        return view('frontend.group.create_group');
    }

    public function add_create_groups(Request $request){
        Validator::make($request->all(),[
            'group_name' => 'required | unique:groups,group_name',
            'group_type' => 'required',
            'status' => 'required'
        ], [
            'group_name.required' => "Please enter group name.",
            'group_type.required' => "Please select group type.",
            'status.required' => "Please select status."
        ])->validate();

        $add = new Group();
        $add->group_name = ucwords($request->group_name);
        $add->group_type = $request->group_type;
        $add->status = $request->status;
        $add->user_id = Auth::guard('crypto')->user()->id;
        $add->current_status = 1;

        if($add->save()){
            $request->session()->flash("submit-status", "Group added successfully.");
            return redirect('/group');
        }else{
           $request->session()->flash("error-status", "Group added failed.");
            return redirect('/group/add'); 
        }
    }

    public function add_group_edit($group_id){
        $id = base64_decode($group_id);

        $fetch_details = Group::find($id)->toArray();

        return view('frontend.group.edit_group')->with('fetch_details', $fetch_details);

    }

    public function edit_create_groups (Request $request, $group_id){
        $id = base64_decode($group_id);

        Validator::make($request->all(),[
            'group_name' => 'required | unique:groups,group_name,'.$id,
            'group_type' => 'required',
            'status' => 'required'
        ], [
            'group_name.required' => "Please enter group name.",
            'group_type.required' => "Please select group type.",
            'status.required' => "Please select status."
        ])->validate();

        $edit = Group::find($id);
        $edit->group_name = ucwords($request->group_name);
        $edit->group_type = $request->group_type;
        $edit->status = $request->status;

        if($edit->save()){
            $request->session()->flash("submit-status", "Group edited successfully.");
            return redirect('/group');
        }else{
            $request->session()->flash("error-status", "Group added failed.");
            return redirect('/group/edit/{group_id}'); 
        }

    }

    public function add_group_delete(Request $request, $group_id){
        $id = base64_decode($group_id);

        $delete = Group::find($id);
        $delete->current_status = 5;
        if($delete->save()){
            $request->session()->flash("submit-status", "Group deleted successfully.");
            return redirect('/group');
        }

    }

    public function join_group_list (){
        $fetch_group_list = Group::where('status',1)
        ->where('current_status',1)
        ->where('user_id', '!=' , Auth::guard('crypto')->user()->id)
        ->orderby('id','desc')
        ->get()
        ->toArray();

        foreach ($fetch_group_list as $key => $value) {
            $user_id = $value['user_id'];
            $group_id = $value['id'];

            $fetch_user_name = User::find($user_id)->toArray();            
            $group_created_by = $fetch_user_name['first_name'].' '.$fetch_user_name['last_name'];

            $exit_user_in_invitation = Invitation::where('user_id',Auth::guard('crypto')->user()->id)
            ->where('group_id',$group_id)
            ->get()
            ->toArray();

            if(!empty($exit_user_in_invitation)){
                $invitation_status = $exit_user_in_invitation[0]['status'];
            }else{
                $invitation_status = 0;
            }

            $fetch_group_list[$key]['group_created_by'] = $group_created_by;
            $fetch_group_list[$key]['invitation_status'] = $invitation_status;
        }

        return view('frontend.group.join_group')->with('fetch_group_list', $fetch_group_list);

    }

    public function join_group_request_sent(Request $request){

        $group_id = $request->group_id;
        
        $group_type = $request->group_type;
        if($group_type == 'og'){
            $status = 1;
        }else{
            $status = 2;
        }

        $notes = $request->notes;

        $add = new Invitation();
        $add->group_id = $group_id;
        $add->user_id = Auth::guard('crypto')->user()->id;
        $add->status = $status;
        $add->notes = $notes;
        $add->read_status = 1;

        if($add->save()){
            echo 1;
            exit();
        }

    }

    public function group_pending_request () {
        $details = \App\Invitation::with('groups')->where([['status','=','2'],['user_id','<>',Auth::guard('crypto')->user()->id]])
        ->orderby('id','desc')
        ->get()
        ->toArray();

        foreach($details as $key=>$value){
            $id = $value['id'];
            $edit = Invitation::find($id);
            $edit->read_status = 0;
            
            if($edit->save()){
                $sent_invitation_user_id = $value['user_id'];

                $find_user = User::find($sent_invitation_user_id);
                $sent_invitation_user_name = $find_user['first_name'].' '.$find_user['last_name'];

                $details[$key]['sent_invitation_user_name'] = $sent_invitation_user_name;
            }
        }

        return view('frontend.group.pending_request')->with('details', $details);
    }

    public function pending_request_accept(Request $request,$group_id){
        $id = base64_decode($group_id);

        $edit = Invitation::find($id);
        $edit->status = 1;

        if($edit->save()){
            $request->session()->flash("submit-status", "Request accepted successfully.");
            return redirect('/group/pending-request');
        }

    }

    public function pending_request_decline (Request $request,$group_id){
        $id = base64_decode($group_id);

        $edit = Invitation::find($id);
        $edit->status = 5;

        if($edit->save()){
            $request->session()->flash("submit-status", "Request declined successfully.");
            return redirect('/group/pending-request');
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
}
