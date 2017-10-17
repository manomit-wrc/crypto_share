<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Auth;
use App\User;
use App\Group;
use App\Invitation;


Class GeneralComposer {
    public function compose(View $view) {
        if (Auth::guard('crypto')->check()) {

     	  	$details_for_count = \App\Invitation::with('groups')->where([['read_status','=','1'],['user_id','<>',Auth::guard('crypto')->user()->id]])->get()->toArray();

            $details_for_list = \App\Invitation::with('groups')->where([['status','=','2'],['user_id','<>',Auth::guard('crypto')->user()->id]])->orderby('id','desc')->get()->toArray();

            $i = 0;
            $tempArray = array();

            foreach ($details_for_count as $key => $value) {
                $user_id = $value['groups']['user_id'];
                if (Auth::guard('crypto')->user()->id == $user_id) {
                    $i++;   
                }
            }

            foreach ($details_for_list as $key => $value) {
                $user_id = $value['groups']['user_id'];
                if (Auth::guard('crypto')->user()->id == $user_id) {
                    $sent_invitation_user_id = $value['user_id'];

                    $find_user = User::find($sent_invitation_user_id);
                    $sent_invitation_user_name = $find_user['first_name'].' '.$find_user['last_name'];

                    $details_for_list[$key]['sent_invitation_user_name'] = $sent_invitation_user_name;
                    $details_for_list[$key]['user_image'] = $find_user['image'];

                    if (!empty($sent_invitation_user_name)) {
                        $tempArray[] = $details_for_list[$key];
                    }
                }
            }

            
            //for group name fetch
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
            //end

            // echo "<pre>";
            // print_r($fetch_all_group1);
            // die();

            $fetch_all_user = User::where([['role_code','SITEUSR'],['id','!=',Auth::guard('crypto')->user()->id]])->get()->toArray();


            $view->with('details', $tempArray);
            $view->with('total_record', $i);
            $view->with('chatChannel', 'chat');
            $view->with('fetch_user_group', $fetch_all_group1);
            $view->with('fetch_all_user',$fetch_all_user);
        }
    }
}