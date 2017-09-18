@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Extra</a></li>
				<li class="active">Profile Page</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Profile Page</h1>

            @if(Session::has('submit-status'))
              <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
			
            <!-- end page-header -->
			<!-- begin profile-container -->
            <div class="profile-container">
                <!-- begin profile-section -->
                <div class="profile-section">
                    <form name="profile_edit" method="POST" action="/profile_edit" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!-- begin profile-left -->
                        <div class="profile-left">
                            <!-- begin profile-image -->
                            <div class="profile-image">
                                <img class="form-group" id="image" width="200" height="175" src="{{url('upload/profile_image/resize/'.Auth::guard('crypto')->user()->image)}}">

                                <input class="form-group" type="hidden" name="exiting_profile_image" id="exiting_profile_image" value="{{Auth::guard('crypto')->user()->image}}">
                            </div>
                            <!-- end profile-image -->
                            <div class="m-b-10">
                                <input type="file" name="profile_image" id="profile_image">

                                <span class="text-danger">{{ $errors->first('profile_image') }}</span>
                            </div>
                            <!-- end profile-highlight -->
                        </div>
                        <!-- end profile-left -->
                        <!-- begin profile-right -->
                        <div class="profile-right">
                            <!-- begin profile-info -->
                            <div class="profile-info">
                                <!-- begin table -->
                                <div class="table-responsive">
                                    <table class="table table-profile">
                                        <tbody>
                                            <tr>
                                                <td class="field {{ $errors->has('first_name') ? 'has-error' : '' }}">First Name</td>
                                                <td><input type="text" name="first_name" value="{{Auth::guard('crypto')->user()->first_name}}"> 

                                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="field">Last Name</td>
                                                <td><input type="text" name="last_name" value="{{Auth::guard('crypto')->user()->last_name}}">

                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="field">Email</td>
                                                <td><input type="email" name="email" value="{{Auth::guard('crypto')->user()->email}}" readonly=""></td>
                                            </tr>

                                            <tr>
                                                <td class="field">Address</td>
                                                <td><textarea cols="" rows="" name="address">{{Auth::guard('crypto')->user()->street_address}}</textarea>

                                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                                </td>
                                            </tr>

                                            <tr class="divider">
                                                <td colspan="2"></td>
                                            </tr>

                                            <tr>
                                                <td class="field">Country/Region</td>
                                                <td>
                                                    <select name="country">
                                                        <option value="">Select Country</option>
                                                        @foreach($fetch_all_countries as $value)

                                                            <option value="{{$value['id']}}" @if((Auth::guard('crypto')->user()->country_id)==$value['id']) selected @endif>
                                                                {{$value['name']}}
                                                            </option>

                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger">{{ $errors->first('country') }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="field">State</td>
                                                <td><input type="text" name="state" value="{{Auth::guard('crypto')->user()->state}}">

                                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                                </td>
                                            
                                            </tr>

                                            <tr>
                                                <td class="field">City</td>
                                                <td><input type="text" name="city" value="{{Auth::guard('crypto')->user()->city}}">

                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="field">Pincode</td>
                                                <td><input type="text" name="pincode" value="{{Auth::guard('crypto')->user()->pincode}}">

                                                    <span class="text-danger">{{ $errors->first('pincode') }}</span>
                                                </td>
                                            
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table -->
                            </div>
                            <!-- end profile-info -->
                        </div>
                        <!-- end profile-right -->

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button id="submit" name="submit" type="submit" class="btn btn-primary" style="    margin-left: 100px;">Edit</button>
                              <input type="hidden" name="user_id" id="user_id" value="{{base64_encode(Auth::guard('crypto')->user()->id)}}" >
                            </div>
                        </div>

                    </form>
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
