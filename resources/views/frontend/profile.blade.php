@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="/dashboard">Home</a></li>
				<li class="active">Profile Page</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">My Profile</h1>

            @if(Session::has('submit-status'))
              <p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
            @endif
			
            <!-- end page-header -->
            <!-- begin profile-container -->
            <div class="profile-container">
                <!-- begin profile-section -->
                <div class="profile-section">
                    <!-- begin profile-left -->
                    <div class="profile-left">
                        <!-- begin profile-image -->
                        <div class="profile-image">
                            <?php if(empty(Auth::guard('crypto')->user()->image)){?>
                                <img class="form-group image_preview" width="200" height="175" src="{{ url('/upload/profile_image/default.png')}}" alt="User profile picture">
                            <?php }else{?>
                                <img class="form-group image_preview" width="200" height="175" src="{{url('upload/profile_image/resize/'.Auth::guard('crypto')->user()->image)}}">

                                <input class="form-group" type="hidden" name="exiting_profile_image" id="exiting_profile_image" value="{{Auth::guard('crypto')->user()->image}}">
                            <?php } ?>
                        </div>
                        <!-- end profile-image -->
                    </div>
                    <!-- end profile-left -->
                    <!-- begin profile-right -->
                    <div class="profile-right">
                        <!-- begin profile-info -->
                        <div class="profile-info">
                            <!-- begin table -->
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <h4>{{Auth::guard('crypto')->user()->first_name}} {{Auth::guard('crypto')->user()->last_name}}</h4>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="highlight">
                                            <td class="field">Email</td>
                                            <td>{{Auth::guard('crypto')->user()->email}}</td>
                                        </tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Country/Region</td>
                                            <td>{{$fetch_country[0]['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="field">City</td>
                                            <td>{{Auth::guard('crypto')->user()->city}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <!-- end profile-right -->
                </div>
                <!-- end profile-section -->
            </div>
            <!-- end profile-container -->
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
    @endsection
