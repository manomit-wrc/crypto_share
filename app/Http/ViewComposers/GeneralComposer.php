<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Auth;
use App\User;


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

            $fetch_user_group = \App\Invitation::with('groups')->where([['status','=','1'],['user_id','=',Auth::guard('crypto')->user()->id]])->get()->toArray();

            /*echo "<pre>";
            print_r($fetch_user_group);
            die();*/

            $view->with('details', $tempArray);
            $view->with('total_record', $i);
            $view->with('chatChannel', 'chat');
            $view->with('fetch_user_group', $fetch_user_group);
        }
    }
}