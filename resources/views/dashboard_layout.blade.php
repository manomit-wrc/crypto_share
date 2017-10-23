<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v3.0/admin/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Sep 2017 12:24:45 GMT -->
<head>
	<meta charset="utf-8" />
  
	<title>CryptShares Admin | Dashboard</title>
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
  {!! Html::style('storage/dashboard/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}
	{!! Html::style('storage/dashboard/assets/plugins/gritter/css/jquery.gritter.css') !!}
  {!! Html::style('storage/dashboard/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') !!}
  {!! Html::style('storage/dashboard/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	{!! Html::script('storage/dashboard/assets/plugins/pace/pace.min.js') !!}
  {!! Html::script('storage/dashboard/assets/plugins/jquery/jquery-1.9.1.min.js') !!}
  
  {!! Html::style('storage/dashboard/assets/css/bootstrap-multiselect.css') !!}
  {!! Html::script('storage/dashboard/assets/js/bootstrap-multiselect.js') !!}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  {!! Html::script('storage/dashboard/assets/plugins/jquery/jquery-migrate-1.1.0.min.js') !!}
  {!! Html::script('storage/dashboard/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') !!}
  {!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.min.js') !!}
  {!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.time.min.js') !!}
  {!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.resize.min.js') !!}
  {!! Html::script('storage/dashboard/assets/plugins/flot/jquery.flot.pie.min.js') !!}
  
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


	
	<!-- ================== BEGIN BASE JS ================== -->

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
    {!! Html::script('storage/dashboard/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/gritter/js/jquery.gritter.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/sparkline/jquery.sparkline.js') !!}

	{!! Html::script('storage/dashboard/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js') !!}
	{!! Html::script('storage/dashboard/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') !!}

	{!! Html::script('storage/dashboard/assets/js/dashboard.min.js') !!}
    {!! Html::script('storage/dashboard/assets/js/form-plugins.demo.min.js') !!}
	{!! Html::script('storage/dashboard/assets/js/apps.min.js') !!}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>

    {!! Html::script('storage/dashboard/assets/js/apps.min.js') !!}

	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
        $('.date').datepicker();
        
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

        $('.open_leave_group_modal').on('click', function(){
            var group_id = $(this).attr('value');
            var group_type = $(this).attr('group_type');
            
            $('#append_group_id').val(group_id);
            $('#append_group_id').attr('group_type',group_type);
        });

        $('#leave_group_form').validate({
            rules:{
                leave_notes:{
                    required: true
                }
            },
            messages:{
                leave_notes: {
                    required: "<font color='red'>Please Enter Notes</font>"
                }
            }
        });

        $('#leave_group_submit').on('click', function(){
          var valid = $('#leave_group_form').valid();
          if(valid){
            $('#leave_group_submit').prop('disabled', false);

            var group_id = $("#append_group_id").val();
            var group_type = $("#append_group_id").attr('group_type');
            var notes = $('#leave_notes').val();
            // alert (group_id);
            // return false;

            $.ajax({
              type: 'POST',
              url: '/group/group-leave',
              data:{
                group_id:group_id,
                notes:notes,
                _token: "{{ csrf_token() }}"
              },
              success: function (data){
                if(data == 1){
                  $('#leave_group_submit').prop('disabled', true);

                  $.confirm({
                      title: 'Confirmation!',
                      content: 'You have successfully leaved from this group.',
                      buttons: {
                          OK: function () {
                            window.location.href='/group';
                          }
                      }
                  });
                }
              }
            });

          }

        });


        $('#quick_post_form').validate({
          rules:{
            post_title:{
              required: true
            },
            quick_post:{
              required: true
            }
          },
          messages:{
            post_title:{
              required: "<font color='red'>Post title can't be left blank.</font>"
            },
            quick_post:{
              required: "<font color='red'>Quick post can't be left blank.</font>"
            }
          }
        });

        $('#quick_post_form_submit').on('click', function(){
          var valid = $('#quick_post_form').valid();
          if(valid){
            $('#quick_post_form').submit();
          }
        });

        $('#feedback_form').validate({
          rules:{
            feedback_msg:{
              required: true
            }
          },
          messages:{
            feedback_msg:{
              required: "<font color='red'>Message can't be left blank.<br /><br /></font>"
            }
          }
        });

        $('#feedback_form_submit').on('click', function(){
          var valid = $('#feedback_form').valid();
          if(valid){
            $('#feedback_form').submit();
          }
        });

        $('.pinned_post').on('click',function(){
          
          var user_id = $(this).attr('user_id');

          $.ajax({
            type: "POST",
            url: '/group/pinned-post',
            data:{
              user_id:user_id,
              _token: '{{csrf_token()}}'
            },
            success: function(data){
              if(data == 1){

                $.confirm({
                    title: 'Confirmation!',
                    content: 'Pinned post successfully',
                    buttons: {
                        OK: function () {
                          window.location.reload();
                        }
                    }
                });
              }
            }
          });
        });

        $('.unpinned').on('click',function (){
          var user_id = $(this).attr('user_id');

          $.ajax({
            type: "POST",
            url: '/group/unpinned-post',
            data:{
              user_id:user_id,
              _token: '{{csrf_token()}}'
            },
            success: function(data){
              if(data == 1){

                $.confirm({
                    title: 'Confirmation!',
                    content: 'Post unpinned successfully',
                    buttons: {
                        OK: function () {
                          window.location.reload();
                        }
                    }
                });
              }
            }
          });
        });

        $('.edit_post').on('click', function(){
          var post_id = $(this).attr('post_id');
          $.ajax({
            type: "POST",
            url: '/group/edit-post',
            data:{
              post_id:post_id,
              _token: '{{csrf_token()}}'
            },
            success: function(response){
              $('#post_title').html(response.fetch_details_of_group_post[0].post_title);
              $('#quick_post').html(response.fetch_details_of_group_post[0].post);

              var res = response.fetch_details_of_group_post[0].post_image;
              var new_url =  '{{url('upload/quick_post/resize')}}/'+res;
              var url_all = '<img src="'+new_url+'"/>';
              $('#quick_post_image_append').html(url_all);

              if (response.fetch_details_of_group_post[0].sticky_to_top == 1) {
                //$('#sticky_to_top').checked = true;
                $('#sticky_to_top').prop("checked", "checked");
              } else {
                $('#sticky_to_top').prop("checked", "");
              }

              $('#edit_post_id').val(response.fetch_details_of_group_post[0].id)

            }
          });
        });

        $('.delete_post').on('click',function(){
          var post_id = $(this).attr('post_id');
          
          $.ajax({
            type: "POST",
            url: '/group/delete-post',
            data:{
              post_id:post_id,
              _token: '{{csrf_token()}}'
            },
            success: function(data){
              if(data == 1){

                $.confirm({
                    title: 'Confirmation!',
                    content: 'Post deleted successfully',
                    buttons: {
                        OK: function () {
                          window.location.reload();
                        }
                    }
                });
              }
            }
          });
        });

        $('.group_invitation_modal').on('click', function(){
          var group_id = $(this).attr('group_id');

          $('.send_group_id').val(group_id);

          $.ajax({
            type: "POST",
            url: '/group/check-user',
            data:{
              group_id: group_id,
              _token: "{{ csrf_token() }}"
            },
            success:function(data) {
              $('#send_group_invitation').empty();
              for(var i=0; i<data.user_list.length; i++) {
                $("#send_group_invitation").append('<option value="'+data.user_list[i].user_id+'">'+data.user_list[i].first_name+" "+data.user_list[i].last_name+'</option>');
              }
              $('#send_group_invitation').multiselect('destroy');
              $('#send_group_invitation').multiselect({
                includeSelectAllOption: false,
                enableFiltering: true,
                numberDisplayed: 4,
                enableCaseInsensitiveFiltering: true,
                maxHeight: 300
            });
              $("#modal_for_send_invitation").modal('show');
            }
          });
        });

        

        $('#group_invitation_form').validate({
          rules:{
            'send_group_invitation[]':{
              required: true
            },
            send_group_invitation_note:{
              required: true
            }
          },
          messages:{
            'send_group_invitation[]':{
              required: "<font color='red'>Please select user."
            },
            send_group_invitation_note:{
              required: "<font color='red'>Note can't be left blank."
            }
          }
        });

        $('#send_invitation').on('click', function(){
          var valid = $('#group_invitation_form').valid();
          var group_id = $('.send_group_id').val();

          var user_ids = $('#send_group_invitation').val();
          var notes = $('#send_group_invitation_note').val();

          if(valid){
            if(user_ids == null){
              $.alert({
                title: 'Confirmation!',
                  content: 'Please select atleast One user.',
                  buttons: {
                      OK: function () {
                      }
                  }
              });
            }else{
              $('.btn').prop('disabled', true);

              $.ajax({
                type: "POST",
                url: '/group/send_invitation/',
                data:{
                  user_ids:user_ids,
                  group_id:group_id,
                  notes:notes,
                  _token: "{{ csrf_token() }}"
                },
                success: function(data){
                  if(data == 1){
                    $('.btn').prop('disabled', false);
                    //$('#modal_for_send_invitation').modal('toggle');

                    jconfirm({
                        title: 'Confirmation!',
                        content: 'Invitation sent successfully',
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
            
          }

        });

        //for auto refresh Transaction Lists div
        // $('#data-table').DataTable( {
        //     stateSave: true
        // } );
        var URL = '<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>';
        setInterval(function()
        {
            $('#data-table_myTransaction').load(document.URL +  ' #data-table_myTransaction');

        }, 3000);
        //end
            
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

</script>

</body>

</html>
