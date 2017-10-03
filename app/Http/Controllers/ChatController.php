<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

use Auth;

class ChatController extends Controller
{
    protected $pusher;
    protected $user;
    protected $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct() {
        $this->pusher = App::make('pusher');
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
    }

    public function index() {
        return view('frontend.chat.index', ['chatChannel' => $this->chatChannel]);
    }

    public function postMessage(Request $request) {
        $message = new \App\Message();
        $message->user_id = Auth::guard('crypto')->user()->id;
        $message->chat_text = e($request->input('chat_text'));
        $message->save();

        if(!empty(Auth::guard('crypto')->user()->image) && file_exists(public_path()."/upload/profile_image/resize/".Auth::guard('crypto')->user()->image))
        {
            $image = "/upload/profile_image/resize/".Auth::guard('crypto')->user()->image;
        }
        else {
            $image = "/upload/profile_image/default.png";   
        }
        $message = [
            'text' => e($request->input('chat_text')),
            'username' => Auth::guard('crypto')->user()->first_name,
            'avatar' => $image,
            'timestamp' => (time()*1000)
        ];
        $this->pusher->trigger($this->chatChannel, 'new-message', $message);
    }

    public function user_typing(Request $request) {
        $message = [
            'user_id' => Auth::guard('crypto')->user()->id,
            'username' => Auth::guard('crypto')->user()->first_name
        ];
        $this->pusher->trigger($this->chatChannel, 'type-message', $message);
    }

    public function loadMessage() {
        $chatArray = array();
        $chats = \App\Message::all();
        foreach ($chats as $key => $value) {
            if(!empty($value['users']['image']) && file_exists(public_path()."/upload/profile_image/resize/".$value['users']['image']))
            {
                $image = "/upload/profile_image/resize/".$value['users']['image'];
            }
            else {
                $image = "/upload/profile_image/default.png";   
            }
            $chatArray[] = array(
                'username' => $value['users']['first_name'], 
                'avatar' => $image,
                'text' => $value['chat_text'],
                'timestamp' => $value['created_at']
            );
        }
        return response()->json([$chatArray]);
    }
}