@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')
	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li><a href="/dashboard">Home</a></li>
			<li><a href="/group">Groups</a></li>
			<li class="active">Create Group</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">Create New Group</h1>
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
	                    <h4 class="panel-title">Create Group</h4>
	                </div>
	                <div class="panel-body panel-form">
	                    <form class="form-horizontal form-bordered" data-parsley-validate="true" name="create_group_edit_form" id="create_group_edit_form" method="POST" action="/add-create-groups" enctype="multipart/form-data">
	                    {{ csrf_field() }}
							<div class="form-group {{ $errors->has('group_name') ? 'has-error' : '' }}">
								<label class="control-label col-md-4 col-sm-4" for="group_name">Group Name :</label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="text" id="group_name" name="group_name" placeholder="Group Name" value="{{ old('group_name') }}" data-parsley-required="true" />
									<span class="text-danger">{{ $errors->first('group_name') }}</span>
								</div>
							</div>

							<div class="form-group {{ $errors->has('group_type') ? 'has-error' : '' }}">
								<label class="control-label col-md-4 col-sm-4" for="group_type">Group Type :</label>
								<div class="col-md-6 col-sm-6">
									<select class="form-control" id="group_type" name="group_type">
										<option>Select Type</option>
										<option value="cg">Closed Group</option>
										<option value="og">Open Group</option>
									</select>
									<span class="text-danger">{{ $errors->first('group_type') }}</span>
								</div>
							</div>

							<div class="form-group {{ $errors->has('group_image') ? 'has-error' : '' }}">
								<label class="control-label col-md-4 col-sm-4" for="group_image">Group Image :</label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="file" id="group_image" name="group_image" data-parsley-required="true" />
									<span class="text-danger">{{ $errors->first('group_image') }}</span>
								</div>
							</div>

							<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
								<label class="control-label col-md-4 col-sm-4" for="description">Group Description :</label>
								<div class="col-md-6 col-sm-6">
									<textarea class="form-control" name="description" id="description" placeholder="Description" data-parsley-required="true"></textarea>
									<span class="text-danger">{{ $errors->first('description') }}</span>
								</div>
							</div>

							<div class="form-group {{ $errors->has('activity_status') ? 'has-error' : '' }}">
								<label class="control-label col-md-4 col-sm-4 p-t-15" for="activity_status">User can access all the features ?</label>
								<div class="col-md-6 col-sm-6">
									<input type="checkbox" name="activity_status" id="activity_status" value="1">
									<span class="text-danger">{{ $errors->first('activity_status') }}</span>
								</div>
							</div>

							<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
								<label class="control-label col-md-4 col-sm-4" for="status">Status :</label>
								<div class="col-md-6 col-sm-6">
									<select class="form-control" name="status" id="status">
										<option disabled="true">Select Status</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
									<span class="text-danger">{{ $errors->first('status') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-primary">Submit</button>
									<button type="reset" class="btn btn-default">Cancel</button>
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