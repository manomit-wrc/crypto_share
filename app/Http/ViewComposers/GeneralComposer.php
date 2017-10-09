<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Auth;
use App\User;


Class GeneralComposer {
 public function compose(View $view)
 {
 	  if(Auth::guard('crypto')->check())
 	  {
 	  	$details = \App\Invitation::with('groups')->where([['read_status','=','1'],['user_id','<>',Auth::guard('crypto')->user()->id]])
        ->get()->toArray();
        // echo "<pre>";
        // print_r($details);
        // die();

        $i = 0;
        $tempArray = array();

        foreach ($details as $key => $value) {
        	$user_id = $value['groups']['user_id'];

        	if(Auth::guard('crypto')->user()->id == $user_id){
        		$i++;
        		$sent_invitation_user_id = $value['user_id'];

                $find_user = User::find($sent_invitation_user_id);
                $sent_invitation_user_name = $find_user['first_name'].' '.$find_user['last_name'];

                $details[$key]['sent_invitation_user_name'] = $sent_invitation_user_name;
                $details[$key]['user_image'] = $find_user['image'];

                if(!empty($sent_invitation_user_name)){
	                $tempArray[] = $details[$key];
	            }
        	}

        }
        // echo "<pre>";
        // print_r($tempArray);
        // die();

        $view->with('details', $tempArray);
        $view->with('total_record', $i);
        $view->with('chatChannel', 'chat');
 	  }
 }
}