<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use Auth;


Class GeneralComposer {
 public function compose(View $view)
 {
 	  if(Auth::guard('crypto')->check())
 	  {
 	  	$details = \App\Invitation::with('groups')->where([['status','=','2'],['user_id','<>',Auth::guard('crypto')->user()->id]])
        ->get()->toArray();
        $view->with('total_record', count($details));
 	  }	
 	  
      
 }
}