<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Sep 2017 12:24:45 GMT -->
<head>
	<meta charset="utf-8" />
  
	<title>Crypto Share Admin | Dashboard</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	{!! Html::style('storage/dashboard/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') !!}
	{!! Html::style('storage/dashboard/assets/plugins/bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('storage/dashboard/assets/plugins/font-awesome/css/font-awesome.min.css') !!}
	{!! Html::style('storage/dashboard/assets/css/animate.min.css') !!}
	{!! Html::style('storage/dashboard/assets/css/style.min.css') !!}
	{!! Html::style('storage/dashboard/assets/css/style-responsive.min.css') !!}
	{!! Html::style('storage/dashboard/assets/css/theme/default.css') !!}

  {!! Html::style('storage/dashboard/assets/css/chats.css') !!}
	
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	{!! Html::style('storage/dashboard/assets/plugins/jquery-jvectormap/jquery-jvectormap.css') !!}
	{!! Html::style('storage/dashboard/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') !!}
	{!! Html::style('storage/dashboard/assets/plugins/gritter/css/jquery.gritter.css') !!}
    {!! Html::style('storage/dashboard/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') !!}
    {!! Html::style('storage/dashboard/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	{!! Html::script('storage/dashboard/assets/plugins/pace/pace.min.js') !!}
  {!! Html::script('storage/dashboard/assets/plugins/jquery/jquery-1.9.1.min.js') !!}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		@include('partial/dashboard_header')
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		@include('partial/dashboard_sidebar')
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		@yield('content')
		<!-- end #content -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

  <div class="container">
  <div class="row">
      <div class="panel panel-chat">
        <div class="panel-heading">
            <a href="#" class="chatMinimize" onclick="return false"><span>Group Chat</span></a>
            
            <div class="clearFix"></div>
        </div>
        <div class="panel-bodyy">
            
            <div class="clearFix"></div>
        </div>
        <div class="panel-footer">
            <textarea name="textMessage" id="textMessage" cols="0" rows="0"></textarea>
        </div>
    </div>
  </div>
</div>
	
	<!-- ================== BEGIN BASE JS ================== -->
	{!! Html::script('storage/dashboard/assets/plugins/jquery/jquery-migrate-1.1.0.min.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/bootstrap/js/bootstrap.min.js') !!}

    {!! Html::script('storage/dashboard/assets/plugins/DataTables/media/js/jquery.dataTables.js') !!}
    {!! Html::script('storage/dashboard/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') !!}
    {!! Html::script('storage/dashboard/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') !!}
    {!! Html::script('storage/dashboard/assets/js/table-manage-default.demo.min.js') !!}
	
	<!--[if lt IE 9]>
		<script src="storage/dashboard/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="storage/dashboard/assets/crossbrowserjs/respond.min.js"></script>
		<script src="storage/dashboard/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	{!! Html::script('storage/dashboard/assets/plugins/slimscroll/jquery.slimscroll.min.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/jquery-cookie/jquery.cookie.js') !!}
	
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->

	{!! Html::script('storage/dashboard/assets/plugins/gritter/js/jquery.gritter.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.min.js') !!}

	{!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.time.min.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.resize.min.js') !!}

	{!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.pie.min.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/sparkline/jquery.sparkline.js') !!}

	{!! Html::script('storage/dashboard/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') !!}

	{!! Html::script('storage/dashboard/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
	{!! Html::script('storage/dashboard/assets/js/dashboard.min.js') !!}
	{!! Html::script('storage/dashboard/assets/js/apps.min.js') !!}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>

    {!! Html::script('storage/dashboard/assets/js/apps.min.js') !!}

	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Dashboard.init();
            TableManageDefault.init();


            $('.open_join_group_modal').on('click', function(){
                var group_id = $(this).attr('value');
                var group_type = $(this).attr('group_type');
                
                $('#append_group_id').val(group_id);
                $('#append_group_id').attr('group_type',group_type);
            });

            $('#join_group_form').validate({
                rules:{
                    notes:{
                        required: true
                    }
                },
                messages:{
                    notes: {
                        required: "<font color='red'>Please Enter Notes</font>"
                    }
                }
            });

            $('#join_group_submit').on('click', function(){
                var valid = $('#join_group_form').valid();
                if(valid){
                    $('#join_group_submit').prop('disabled', false);

                    var group_id = $("#append_group_id").val();
                    var group_type = $("#append_group_id").attr('group_type');
                    var notes = $('#notes').val();

                    $.ajax({
                        type: "POST",
                        url: '/join_group_request_sent',
                        data:{
                            group_id: group_id,
                            group_type: group_type,
                            notes: notes,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data){
                            if(data == 1){
                              $('#join_group_submit').prop('disabled', true);

                              $.confirm({
                                  title: 'Confirmation!',
                                  content: 'Applied successfully',
                                  buttons: {
                                      OK: function () {
                                        window.location.reload();
                                      }
                                  }
                              });
                            }
                        }

                    });
                }
            });



            $(".panel.panel-chat > .panel-heading > .chatMinimize").click(function(){
                if($(this).parent().parent().hasClass('mini'))
                {
                    $(this).parent().parent().removeClass('mini').addClass('normal');

                    $('.panel.panel-chat > .panel-bodyy').animate({height: "250px"}, 500).show();

                    $('.panel.panel-chat > .panel-footer').animate({height: "75px"}, 500).show();
                }
                else
                {
                    $(this).parent().parent().removeClass('normal').addClass('mini');

                    $('.panel.panel-chat > .panel-bodyy').animate({height: "0"}, 500);

                    $('.panel.panel-chat > .panel-footer').animate({height: "0"}, 500);

                    setTimeout(function() {
                        $('.panel.panel-chat > .panel-bodyy').hide();
                        $('.panel.panel-chat > .panel-footer').hide();
                    }, 500);


                }

            });
            
		});
	</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');


//for profile image preview & size validation

	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.image_preview').attr('src', e.target.result);
                $('.header_image_preview').attr('src', e.target.result);
                $('.sidebar_image_preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $(".profile_image").change(function(){
        readURL(this);
    });

    $("#image").change(function(){
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.img-team').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    });

     $(document).on('change','.profile_image',function(){
          files = this.files;
          size = files[0].size;
          //max size 50kb => 50*1000
          if( size > 2000000){
             alert('Please upload less than 2MB file');
             return false;
          }
          return true;
     });

//end

</script>
<script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script>  
    Pusher.log = function(msg) {
        console.log(msg);
    };
</script>
<script>
    function init() {
        // send button click handling
        $('.send-message').click(sendMessage);
        $('#textMessage').keypress(checkSend);
        $.get( "/chat/load-message", function( data ) {
            
            for(var i=0;i<data[0].length;i++)
            {
                $(".panel-bodyy").append('<div class="'+data[0][i].className+'"><img src="'+data[0][i].avatar+'" alt=""/><span>'+data[0][i].text+'</span><div class="clearFix"></div></div>');
            }
        });
    }

    // Send on enter/return key
    function checkSend(e) {
        if (e.keyCode === 13) {
            return sendMessage();
        }
        
    }

    // Handle the send button being clicked
    function sendMessage() {
        var messageText = $('#textMessage').val();
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
        $('#textMessage').val('')
        console.log('message sent successfully');
    }

    // Build the UI for a new message and add to the DOM
    function addMessage(data) {
        var current_user_id = "{{Auth::guard('crypto')->user()->id}}";
        var className = '';
        if(current_user_id != data.user_id) {
            className = 'messageHer';
        }
        else {
            className = 'messageMe';
        }
        $(".panel-bodyy").append('<div class="'+className+'"><img src="'+data.avatar+'" alt=""/><span>'+data.text+'</span><div class="clearFix"></div></div>');
        var messages = $(".panel-bodyy");
        messages.scrollTop(messages[0].scrollHeight);
    }

    // Creates an activity element from the template
    /*function createMessageEl() {
        var text = $('#chat_message_template').text();
        var el = $(text);
        return el;
    }*/

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
</body>

</html>
