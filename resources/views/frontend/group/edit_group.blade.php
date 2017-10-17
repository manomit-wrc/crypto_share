@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')
		
		<!-- begin #content -->
<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Groups</a></li>
				<li><a href="javascript:;">Edit Groups</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit Groups</h1>
			<!-- end page-header -->
			
			@if(Session::has('submit-status'))
              	<p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
            @endif

            @if(Session::has('error-status'))
            	<p class="login-box-msg" style="color: red;">{{ Session::get('error-status') }}</p>
            @endif

			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Edit Groups</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" data-parsley-validate="true" name="edit_group_form" id="edit_group_form" method="POST" action="/edit-create-groups/{{base64_encode($fetch_details['id'])}}" enctype="multipart/form-data">
                            
                            {{ csrf_field() }}

								<div class="form-group {{ $errors->has('group_name') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Group Name :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="group_name" name="group_name" placeholder="Full Name" value="{{ $fetch_details['group_name'] }}" data-parsley-required="true" />

										<span class="text-danger">{{ $errors->first('group_name') }}</span>
									</div>

									
								</div>

								<div class="form-group {{ $errors->has('group_type') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Group Type :</label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control" id="group_type" name="group_type">
											<option value="">Select Type</option>
											<option value="cg" @if($fetch_details['group_type'] == 'cg') selected="" @endif>Closed Group</option>
											<option value="og" @if($fetch_details['group_type'] == 'og') selected="" @endif>Open Group</option>
										</select>

										<span class="text-danger">{{ $errors->first('group_type') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('group_image') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Group Image :</label>
									<div class="col-md-6 col-sm-6">
										<img src="{{url('upload/group_image/resize/'.$fetch_details['group_image'])}}">
										<br/>
										<br/>
										<input type="hidden" name="exit_group_image" value="{{$fetch_details['group_image']}}">
										<input class="form-control" type="file" id="group_image" name="group_image" placeholder="Group Name" value="" data-parsley-required="true" />

										<span class="text-danger">{{ $errors->first('group_image') }}</span>
									</div>
								</div>

								<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
									<label class="control-label col-md-4 col-sm-4" for="website">Status :</label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control" name="status" id="status">
											<option value="">Select Status</option>
											<option value="1" @if($fetch_details['status'] == 1) selected="" @endif>Active</option>
											<option value="0" @if($fetch_details['status'] == 0) selected="" @endif>Inactive</option>
										</select>

										<span class="text-danger">{{ $errors->first('status') }}</span>
									</div>

									
								</div>

								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Edit</button>
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