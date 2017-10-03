@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Dashboard</a></li>
            <li class="active">Chat</li>
            
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            
            <div class="row">
                <style>
        .chat-app {
            margin: 50px;
            padding-top: 10px;
        }

        .chat-app .message:first-child {
            margin-top: 15px;
        }

        #messages {
            height: 300px;
            overflow: auto;
            padding-top: 5px;
        }
    </style>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>

    <script>
        // Ensure CSRF token is sent with AJAX requests
        

        // Added Pusher logging
        Pusher.log = function(msg) {
            console.log(msg);
        };
    </script>


<div class="stripe no-padding-bottom numbered-stripe">
    <div class="fixed wrapper">
        <ul class="strong">
            <li>
                <div class="hexagon"></div>
                <h2><b>Real-Time Chat</b> <small>Fundamental real-time communication.</small></h2>
            </li>
        </ul>
    </div>
</div>

<section class="blue-gradient-background">
    <div class="container">
        <div class="row light-grey-blue-background chat-app">

            <div id="messages">
                <div class="time-divide">
                    <span class="date">Today</span>
                </div>
            </div>
            <div>
                <label id="isTyping"></label>
            </div>
            <div class="action-bar">

                <textarea class="input-message col-xs-10" placeholder="Your message"></textarea>
                
            </div>

        </div>
    </div>
</section>

<script id="chat_message_template" type="text/template">
    <div class="message">
        <div class="avatar">
            <img src="" class="img-responsive" width="50px" height="50px">
        </div>
        <div class="text-display">
            <div class="message-data">
                <span class="author"></span>
                <span class="timestamp"></span>
                <span class="seen"></span>
            </div>
            <p class="message-body"></p>
        </div>
    </div>
</script>

<script>
    function init() {
        // send button click handling
        $('.send-message').click(sendMessage);
        $('.input-message').keypress(checkSend);
        $.get( "/chat/load-message", function( data ) {
            
            for(var i=0;i<data[0].length;i++)
            {
                addMessage(data[0][i]);
            }
        });
    }

    // Send on enter/return key
    function checkSend(e) {
        if (e.keyCode === 13) {
            return sendMessage();
        }
        else {
            var data = {_token: "{{ csrf_token() }}"};
            $.post('/chat/user-typing', data);
        }
    }

    // Handle the send button being clicked
    function sendMessage() {
        var messageText = $('.input-message').val();
        if(messageText.length < 3) {
            return false;
        }

        // Build POST data and make AJAX request
        var data = {chat_text: messageText, _token: "{{ csrf_token() }}"};
        $.post('/chat/message', data).success(sendMessageSuccess);

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function sendMessageSuccess() {
        $('.input-message').val('')
        console.log('message sent successfully');
    }

    // Build the UI for a new message and add to the DOM
    function addMessage(data) {
        // Create element from template and set values
        var el = createMessageEl();
        el.find('.message-body').html(data.text);
        el.find('.author').text(data.username);
        el.find('.avatar img').attr('src', data.avatar)
        
        // Utility to build nicely formatted time
        el.find('.timestamp').text(strftime('%H:%M:%S %P', new Date(data.timestamp)));
        
        var messages = $('#messages');
        messages.append(el)
        
        // Make sure the incoming message is shown
        messages.scrollTop(messages[0].scrollHeight);
        $('#isTyping').html('');
    }

    // Creates an activity element from the template
    function createMessageEl() {
        var text = $('#chat_message_template').text();
        var el = $(text);
        return el;
    }

    $(init);

    /***********************************************/

    var pusher = new Pusher('397f69f15f677e2fd465', {
              cluster: 'ap2',
              encrypted: true
    });

    var channel = pusher.subscribe('{{$chatChannel}}');
    channel.bind('new-message', addMessage);

    channel.bind("type-message", function(data) {
        var current_user_id = "{{Auth::guard('crypto')->user()->id}}";
        if(current_user_id != data.user_id) {
            $('#isTyping').html(data.username + ' is typing...');
        }
      
    });

</script>
            </div>
        </div>
        <!-- end profile-container -->
    </div>
    <!-- end #content -->
@endsection