@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')
		
		<!-- begin #content -->
<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Organization</a></li>
				<li class="active">Edit</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Website Settings</h1>
			<!-- end page-header -->
			
			@if(Session::has('submit-status'))
              <p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
            @endif

			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-6">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Website Settings Edit</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="settings_edit_form" id="settings_edit_form" method="POST" action="/edit_settings" enctype="multipart/form-data">
                            
                            {{ csrf_field() }}

								<div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Full Name :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="fullname" name="fullname" placeholder="Full Name" value="{{$fetch_details['name']}}" data-parsley-required="true" />

										<span class="text-danger">{{ $errors->first('fullname') }}</span>
									</div>

									
								</div>

								<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="email">Email :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email" value="{{$fetch_details['email']}}" data-parsley-required="true" />

										<span class="text-danger">{{ $errors->first('email') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="email">Address :</label>
									<div class="col-md-6 col-sm-6">

										<textarea class="form-control" cols="" rows="" id="address" name="address" placeholder="Address" data-parsley-required="true" >{{$fetch_details['address']}}</textarea>

										<span class="text-danger">{{ $errors->first('address') }}</span>

									</div>
								</div>

								<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="message">Phone Number :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="data-phone" name="phone_number" data-parsley-type="number" placeholder="(XXX) XXXX XXX" value="{{$fetch_details['phone_no']}}" />

										<span class="text-danger">{{ $errors->first('phone_number') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Country :</label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control" id="country" name="country">
											<option>Select Country</option>
											@foreach ($fetch_all_countries as $value)
												<option value="{{$value['id']}}" @if($fetch_details['country_id']==$value['id']) selected="" @endif>{{$value['name']}}</option>
											@endforeach
										</select>

										<span class="text-danger">{{ $errors->first('country') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">State :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="state" name="state" data-parsley-type="true" placeholder="State" value="{{$fetch_details['state_name']}}" />

										<span class="text-danger">{{ $errors->first('state') }}</span>
									</div>

									
								</div>

								<div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">City :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="city" name="city" data-parsley-type="true" placeholder="City" value="{{$fetch_details['city_name']}}" />

										<span class="text-danger">{{ $errors->first('city') }}</span>
									</div>

									
								</div>

								<div class="form-group {{ $errors->has('pincode') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Pincode :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="pincode" name="pincode" data-parsley-type="true" placeholder="Pincode" value="{{$fetch_details['pincode']}}" />

										<span class="text-danger">{{ $errors->first('pincode') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('fb_link') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Facebook Link :</label>
									<div class="col-md-6 col-sm-6">
										<textarea class="form-control" cols="" rows="" type="url" id="fb_link" name="fb_link" data-parsley-type="url" placeholder="Facebook Link">{{$fetch_details['facebook']}}</textarea>

										<span class="text-danger">{{ $errors->first('fb_link') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('tw_link') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Twitter Link :</label>
									<div class="col-md-6 col-sm-6">
										<textarea class="form-control" cols="" rows="" type="url" id="tw_link" name="tw_link" data-parsley-type="url" placeholder="Twitter Link">{{$fetch_details['twitter']}}</textarea>

										<span class="text-danger">{{ $errors->first('tw_link') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('linkedin_link') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Linkedin Link :</label>
									<div class="col-md-6 col-sm-6">
										<textarea class="form-control" cols="" rows="" type="url" id="linkedin_link" name="linkedin_link" data-parsley-type="url" placeholder="Linkedin Link">{{$fetch_details['linkedin']}}</textarea>

										<span class="text-danger">{{ $errors->first('linkedin_link') }}</span>
									</div>

									

								</div>

								
								
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
            </div>
            <!-- end row -->
</div>

@endsection