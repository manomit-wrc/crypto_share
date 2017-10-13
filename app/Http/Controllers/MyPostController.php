<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\QuickPost;

class MyPostController extends Controller
{
	public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('crypto')->check()) {
                $this->role_code = Auth::user()->role_code;
                if ($this->role_code == "SITEADM" && $request->segment(1) == "my-post") {
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

    public function index () {
    	$fetch_post_from_all_groups = QuickPost::with('group_name')->where([['user_id',Auth::guard('crypto')->user()->id],['current_status','1']])->orderby('id','desc')->get()->toArray();

    	return view('frontend.my-post.my_all_post_view')->with('fetch_post_from_all_groups',$fetch_post_from_all_groups);
    }
}
