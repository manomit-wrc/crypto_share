<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v3.0/frontend/one-page-parallax/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Sep 2017 04:21:06 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Crypto Share</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    {!! Html::style('storage/frontend/assets/plugins/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('storage/frontend/assets/plugins/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('storage/frontend/assets/css/animate.min.css') !!}
    {!! Html::style('storage/frontend/assets/css/style.min.css') !!}
    {!! Html::style('storage/frontend/assets/css/style-responsive.min.css') !!}
    {!! Html::style('storage/frontend/assets/css/theme/default.css') !!}
    
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    {!! Html::script('storage/frontend/assets/plugins/pace/pace.min.js') !!}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    
    <!-- ================== END BASE JS ================== -->
</head>
<body data-spy="scroll" data-target="#header-navbar" data-offset="51">
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        @include('partial/header')
        <!-- end #header -->
        
        @yield('content')
        
        <!-- begin #footer -->
        @if(Request::segment(1) != "explore")
        @include('partial/footer')
        @endif
        <!-- end #footer -->
    </div>
    <!-- end #page-container -->
    
    @include('partial/footer_script')
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('397f69f15f677e2fd465', {
      cluster: 'ap2',
      encrypted: true
    });

    var channel = pusher.subscribe('test-channel');
    channel.bind('test-event', function(data) {
      console.log(data.text);
    });
  </script>
</body>

</html>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        //contact us form validation & submit
        $('#contact_us_form').validate({
          rules:{
            contact_us_name:{
              required: true
            },
            contact_us_email:{
              required: true,
              email: true
            },
            contact_us_msg:{
              required: true
            }
          },
          messages:{
            contact_us_name:{
              required: "<font color='red'>Please enter your name</font>"
            },
            contact_us_email:{
              required: "<font color='red'>Please enter your email</font>",
              email: "<font color='red'>Please enter your valid email</font>",
            },
            contact_us_msg:{
              required: "<font color='red'>Please enter your messages</font>"
            }
          }
        });

        $('#contact_us_submit').on('click', function(){
          var valid = $('#contact_us_form').valid();

          if(valid){
            $('#contact_us_submit').prop('disabled', false);

            var name = $('#contact_us_name').val();
            var email = $('#contact_us_email').val();
            var msg = $('#contact_us_msg').val();

            $.ajax({
                type:"POST",
                url: '/contact-us-form',
                data:{
                    name:name,
                    email:email,
                    msg:msg,
                    _token: '{{csrf_token()}}'
                },
                async: false,
                success: function(data){
                    if(data == 1){
                        $('#contact_us_submit').prop('disabled', true);

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
        //end
    });  
</script>