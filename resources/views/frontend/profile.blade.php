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
              <p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
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

                                <?php if(empty(Auth::guard('crypto')->user()->image)){?>
                                    <img class="form-group image_preview" width="200" height="175" src="{{ url('/upload/profile_image/default.png')}}" alt="User profile picture">
                                <?php }else{?>
                                    <img class="form-group image_preview" width="200" height="175" src="{{url('upload/profile_image/resize/'.Auth::guard('crypto')->user()->image)}}">

                                    <input class="form-group" type="hidden" name="exiting_profile_image" id="exiting_profile_image" value="{{Auth::guard('crypto')->user()->image}}">
                                <?php } ?>

                            </div>
                            <!-- end profile-image -->
                            <div class="m-b-10">
                                <input type="file" name="profile_image" class="profile_image">

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
                                                <td class="field">Country/Region</td>
                                                <td>
                                                    <select name="country">
                                                        <option value="">Select Country</option>
                                                        @foreach($fetch_all_countries as $value)

                                                            <option value="{{$value['id']}}" @if(Auth::guard('crypto')->user()->country_id == $value['id']) selected @endif>
                                                                {{$value['name']}}
                                                            </option>

                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger">{{ $errors->first('country') }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="field">City</td>
                                                <td><input type="text" name="city" value="{{Auth::guard('crypto')->user()->city}}">

                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
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
                              <button id="submit" name="submit" type="submit" class="btn btn-primary" style="margin-left: 100px;">Edit</button>
                              <input type="hidden" name="user_id" id="user_id" value="{{base64_encode(Auth::guard('crypto')->user()->id)}}">
                            </div>
                        </div>
                        <br>
                        <div></div>

                    </form>

                    <br>
                    <div></div>

                    <!-- begin row -->
                    

                </div>
                <!-- end profile-section -->


                <div class="row">
                    <div class="form-group">
                        <label class="col-md-3 control-label ui-sortable">My Groups:</label>
                    </div>
                            <!-- begin col-6 -->
                    <div class="col-md-12">
                        <ul class="nav nav-tabs">
                            @foreach($fetch_all_group_name as $key => $value)
                                <li class=""><a href="#default-tab-{{$value['groups']['id']}}" data-toggle="tab">{{$value['groups']['group_name']}}</a></li>
                            @endforeach
                            {{-- <li class="active"><a href="#default-tab-1" data-toggle="tab">Default Tab 1</a></li> --}}
                            {{-- <li class=""><a href="#default-tab-2" data-toggle="tab">Default Tab 2</a></li> --}}
                            {{-- <li class=""><a href="#default-tab-3" data-toggle="tab">Default Tab 3</a></li> --}}
                        </ul>
                        <div class="tab-content">
                            @foreach($fetch_all_group_name as $key => $value)
                                <div class="tab-pane fade in" id="default-tab-{{$value['groups']['id']}}">
                                    <h3 class="m-t-10"><i class="fa fa-cog"></i> Lorem ipsum dolor sit amet</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                        Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
                                        est diam sagittis orci, a ornare nisi quam elementum tortor. Proin interdum ante porta est convallis 
                                        dapibus dictum in nibh. Aenean quis massa congue metus mollis fermentum eget et tellus. 
                                        Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, nec eleifend orci eros id lectus.
                                    </p>
                                    
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <!-- end col-6 -->
                </div>
            </div>

            


                    <!-- end row -->
			<!-- end profile-container -->
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
    @endsection
