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
use App\CoinList;
use App\UserCoin;
use App\QuickPost;
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
    	$new_fetch_group = array();
    	
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
            $read_status = 0;
        } else {
            $status = 2;
            $read_status = 1;
        }

        $notes = $request->notes;
        $add = new Invitation();
        $add->group_id = $group_id;
        $add->user_id = Auth::guard('crypto')->user()->id;
        $add->status = $status;
        $add->notes = $notes;
        $add->read_status = $read_status;
        if ($add->save()) {
            echo 1;
            exit();
        }
    }

    public function group_pending_request ($group_id) {
        $details = \App\Invitation::with('groups')->where([['id',$group_id],['status','=','2'],['user_id','<>',Auth::guard('crypto')->user()->id]])
        ->orderby('id','desc')
        ->get()
        ->toArray();

        $id = $details[0]['id'];
        $edit = Invitation::find($id);
        $edit->read_status = 0;
        
        if ($edit->save()) {
            $sent_invitation_user_id = $details[0]['user_id'];

            $find_user = User::find($sent_invitation_user_id);
            $sent_invitation_user_name = $find_user['first_name'].' '.$find_user['last_name'];

            $details['sent_invitation_user_name'] = $sent_invitation_user_name;
        }
        return view('frontend.group.pending_request')->with('details_array', $details);
    }

    public function pending_request_accept(Request $request,$group_id) {
        $id = base64_decode($group_id);
        $edit = Invitation::find($id);
        $edit->status = 1;
        if ($edit->save()) {
            $request->session()->flash("submit-status", "Request accepted successfully.");
            return redirect('/group');
        }
    }

    public function pending_request_decline(Request $request,$group_id) {
        $id = base64_decode($group_id);
        $edit = Invitation::find($id);
        $edit->status = 5;
        if ($edit->save()) {
            $request->session()->flash("submit-status", "Request declined successfully.");
            return redirect('/group');
        }
    }

    public function group_dashboard($group_id) {
    	$fetch_user_details = array();
    	$id = base64_decode($group_id);

    	$fetch_group_details = Group::with('user_info')->where('id',$id)->get()->toArray();
    	$group_name = $fetch_group_details[0]['group_name'];

    	$fetch_member_of_group = Invitation::where([['group_id',$id],['status','1']])->get()->toArray();
    	$total_member_of_group = count($fetch_member_of_group);

    	foreach($fetch_member_of_group as $key => $value){
    		$user_id = $value['user_id'];

    		$fetch_user_details[] = User::find($user_id)->toArray();
    	}
    	$fetch_all_user_of_group = $fetch_user_details;

        $user_coin_group_list = UserCoin::with('coinlists')->where('group_id','=',$id)->with('userInfo')->orderby('coin_list_id','asc')->get()->toArray();
        
        $coin_lists_main = array();
        $new_coin_list_id = '';
        $i = -1;
        $k = 0;
        foreach ($user_coin_group_list as $list) {
            if($list['coin_list_id'] != $new_coin_list_id) {
                $i++;
                $k = 0;
                $coin_lists_main[$i] = $list['coinlists'];
                $coin_lists_main[$i]['user_info'][$k] = $list['user_info'];
                $coin_lists_main[$i]['user_info'][$k]['chip_value'] = $list['chip_value'];
                $coin_lists_main[$i]['user_info'][$k]['transaction_type'] = $list['transaction_type'];
                $new_coin_list_id = $list['coin_list_id'];
            }
            else {
                $coin_lists_main[$i]['user_info'][$k] = $list['user_info'];
                $coin_lists_main[$i]['user_info'][$k]['chip_value'] = $list['chip_value'];
                $coin_lists_main[$i]['user_info'][$k]['transaction_type'] = $list['transaction_type'];
            }
            $k++;
        }

        $fetch_latest_post = QuickPost::with('user_name')->where('group_id', $id )->orderby('id','desc')->get()->toArray();

        $fetch_latest_post_image = QuickPost::where('group_id', $id )->orderby('id','desc')->get()->toArray();

        $fetch_pinned_post = QuickPost::with('user_name')->where([['group_id', $id],['status','1']] )->orderby('id','desc')->get()->toArray();

        $chatArray = array();
        $chats = \App\Message::with('users')->where('group_id', base64_decode($group_id))->get()->toArray();
        
        foreach ($chats as $key => $value) {
            if(!empty($value['users']['image']) && file_exists(public_path()."/upload/profile_image/resize/".$value['users']['image']))
            {
                $image = "/upload/profile_image/resize/".$value['users']['image'];
            }
            else {
                $image = "/upload/profile_image/default.png";   
            }
            
            $chatArray[] = array(
                'username' => $value['users']['first_name']." ".$value['users']['last_name'], 
                'avatar' => $image,
                'text' => $value['chat_text'],
                'timestamp' => $value['created_at']
            );
        }

        $group_status = \App\Invitation::where([['user_id', '=', Auth::guard('crypto')->user()->id],['group_id','=',$id],['status','!=','5']])->get()->toArray();

        $fetch_coin_all_details = UserCoin::with('coinlists')->where([['group_id',$id],['status',1]])->get()->toArray();

    	return view('frontend.group.group_dashboard')->with('fetch_group_details',$fetch_group_details[0])
													->with('total_member_of_group',$total_member_of_group)
													->with('fetch_user_details', $fetch_all_user_of_group)
													->with('group_id',$id)
													->with('fetch_latest_post',$fetch_latest_post)
													->with('coin_user_info', $coin_lists_main)
													->with('fetch_latest_post_image', $fetch_latest_post_image)
													->with('fetch_pinned_post', $fetch_pinned_post)
                                                    ->with('group_id', $group_id)
                                                    ->with('chatArray', $chatArray)
                                                    ->with('group_status',$group_status)
                                                    ->with('fetch_coin_all_details', $fetch_coin_all_details);
    }

    public function quick_post_submit (Request $request, $group_id) {
    	$group_id = base64_decode($group_id);
    	$text = $request->quick_post;
    	$image = $request->quick_post_image;

    	if ($request->hasFile('quick_post_image')) {
            $file = $request->file('quick_post_image');
            $fileName = time().'_'.$file->getClientOriginalName();
            //thumb destination path
            $destinationPath_2 = public_path().'/upload/quick_post/resize';
            $img = Image::make($file->getRealPath());
            $img->resize(200, 150, function ($constraint) {
              $constraint->aspectRatio();
            })->save($destinationPath_2.'/'.$fileName);
            //original destination path
            $destinationPath = public_path().'/upload/quick_post/original/';
            $file->move($destinationPath,$fileName);
        }

    	$add = new QuickPost;
    	$add->group_id = $group_id;
    	$add->user_id = Auth::guard('crypto')->user()->id;
    	$add->post = $text;
    	$add->post_image = $fileName;

    	if($add->save()){
    		$request->session()->flash("submit-status", "Post submited successfully.");
            return redirect('/group/dashboard/'. base64_encode($group_id));
    	}
    }

    public function pinned_post(Request $request) {
    	$user_id = $request->user_id;
    	$edit = QuickPost::find($user_id);
    	$edit->status = 1;
    	if ($edit->save()) {
    		echo 1;
    		exit;
    	}
    }

    public function group_wise_transaction($group_id) {
        $group_id = base64_decode($group_id);
        $group_info = Group::find($group_id)->toArray();
        $fetch_group_wise_coin_list = UserCoin::with('coinlists','userInfo')->where('group_id',$group_id)->get()->toArray();
        return view('frontend.transaction_group_wise_listings')->with('fetch_group_wise_coin_list', $fetch_group_wise_coin_list)->with('group_id', $group_id)->with('group_info', $group_info);
    }
}
