@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')
		
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li class="active">Change Password</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Change Password</h1>

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            @if(Session::has('submit-status'))
                <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
            <div class="row text-center">
                <div class="col-md-6 ui-sortable">
                    <form name="profile_change" method="POST" action="/update_password">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" id="user_id" value="{{base64_encode(Auth::guard('crypto')->user()->id)}}" >
                        <div class="input-group">
                            <span class="input-group-addon">Old Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input class="form-control" name="old_pass" placeholder="Old Password" type="password" value="" />
                        </div>
                        @if ($errors->first('old_pass'))<span class="input-group col-md-offset-3 text-danger">{{ $errors->first('old_pass') }}<br /></span>@endif<br />
                        <div class="input-group">
                            <span class="input-group-addon">New Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input class="form-control" name="new_pass" placeholder="New Password" type="password" value="" />
                        </div>
                        @if ($errors->first('new_pass'))<span class="input-group col-md-offset-3 text-danger">{{ $errors->first('new_pass') }}<br /></span>@endif<br />
                        <div class="input-group">
                            <span class="input-group-addon">Re-enter Password</span>
                            <input class="form-control" name="re_pass" placeholder="Re-enter Password" type="password" value="" />
                        </div>
                        @if ($errors->first('re_pass'))<span class="input-group col-md-offset-3 text-danger">{{ $errors->first('re_pass') }}<br /></span>@endif<br />
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                <button type="reset" class="btn btn-sm btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end profile-container -->
    </div>
    <!-- end #content -->
		
	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
	
@endsection
