<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use App\User;
use Auth;
use Image;
use Hash;
use App\Group;
use App\Invitation;

use Illuminate\Support\Facades\App;

class GroupController extends Controller
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


    public function add_group_by_user () {
        $fetch_all_group = Group::where('user_id', Auth::guard('crypto')->user()->id)
        ->where('current_status',1)
        ->orderby('id','desc')
        ->get()
        ->toArray();

        foreach($fetch_all_group as $key=>$value){

            $new_fetch_group[$key]['groups'] = $value;
            $new_fetch_group[$key]['groups']['group_admin_name'] = Auth::guard('crypto')->user()->first_name.' '.Auth::guard('crypto')->user()->last_name;

        }

        $fetch_my_join_group_list = Invitation::with('groups')->where([['status','=','1'],['user_id',Auth::guard('crypto')->user()->id]])
            ->orderby('id','desc')
            ->get()
            ->toArray();

        foreach ($fetch_my_join_group_list as $key => $value) {

            $user_id_of_group_admin = $value['groups']['user_id'];

            $find_user = User::find($user_id_of_group_admin);
            $user_id_of_group_admin_name = $find_user['first_name'].' '.$find_user['last_name'];

            $fetch_my_join_group_list[$key]['groups']['group_admin_name'] = $user_id_of_group_admin_name;
        }

        $fetch_all_group1 = array_merge($new_fetch_group,$fetch_my_join_group_list);
        
        return view('frontend.group.view_groups')->with('fetch_all_group', $fetch_all_group1);
    }

    public function create_group(){
        return view('frontend.group.create_group');
    }

    public function add_create_groups(Request $request) {
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

        if ($add->save()) {
            $request->session()->flash("submit-status", "Group added successfully.");
            return redirect('/group');
        } else {
           $request->session()->flash("error-status", "Group added failed.");
            return redirect('/group/add'); 
        }
    }

    public function add_group_edit($group_id) {
        $id = base64_decode($group_id);
        $fetch_details = Group::find($id)->toArray();
        return view('frontend.group.edit_group')->with('fetch_details', $fetch_details);
    }

    public function edit_create_groups (Request $request, $group_id) {
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

        if ($edit->save()) {
            $request->session()->flash("submit-status", "Group edited successfully.");
            return redirect('/group');
        } else {
            $request->session()->flash("error-status", "Group added failed.");
            return redirect('/group/edit/{group_id}'); 
        }
    }

    public function add_group_delete(Request $request, $group_id){
        $id = base64_decode($group_id);

        $delete = Group::find($id);
        $delete->current_status = 5;
        if ($delete->save()) {
            $request->session()->flash("submit-status", "Group deleted successfully.");
            return redirect('/group');
        }
    }

    public function join_group_list () {
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

            if (!empty($exit_user_in_invitation)) {
                $invitation_status = $exit_user_in_invitation[0]['status'];
            } else {
                $invitation_status = 0;
            }

            $fetch_group_list[$key]['group_created_by'] = $group_created_by;
            $fetch_group_list[$key]['invitation_status'] = $invitation_status;
        }

        return view('frontend.group.join_group')->with('fetch_group_list', $fetch_group_list);
    }

    public function join_group_request_sent(Request $request) {
        $group_id = $request->group_id;
        
        $group_type = $request->group_type;
        if ($group_type == 'og') {
            $status = 1;
        } else {
            $status = 2;
        }

        $notes = $request->notes;
        $add = new Invitation();
        $add->group_id = $group_id;
        $add->user_id = Auth::guard('crypto')->user()->id;
        $add->status = $status;
        $add->notes = $notes;
        $add->read_status = 1;
        if ($add->save()) {
            echo 1;
            exit();
        }
    }

    public function group_pending_request () {
        $details = \App\Invitation::with('groups')->where([['status','=','2'],['user_id','<>',Auth::guard('crypto')->user()->id]])
        ->orderby('id','desc')
        ->get()
        ->toArray();

        foreach ($details as $key=>$value) {
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

    public function pending_request_accept(Request $request,$group_id) {
        $id = base64_decode($group_id);

        $edit = Invitation::find($id);
        $edit->status = 1;

        if ($edit->save()) {
            $request->session()->flash("submit-status", "Request accepted successfully.");
            return redirect('/group/pending-request');
        }
    }

    public function pending_request_decline(Request $request,$group_id) {
        $id = base64_decode($group_id);

        $edit = Invitation::find($id);
        $edit->status = 5;

        if ($edit->save()) {
            $request->session()->flash("submit-status", "Request declined successfully.");
            return redirect('/group/pending-request');
        }
    }

    public function group_dashboard($group_id){

    	$id = base64_decode($group_id);

    	$fetch_group_details = Group::find($id)->toArray();
    	$group_name = $fetch_group_details['group_name'];

    	$fetch_member_of_group = Invitation::where('group_id',$id)->get()->toArray();
    	$total_member_of_group = count($fetch_member_of_group);

    	return view('frontend.group.group_dashboard')->with('group_name',$group_name)
													->with('total_member_of_group',$total_member_of_group);

    }
}
