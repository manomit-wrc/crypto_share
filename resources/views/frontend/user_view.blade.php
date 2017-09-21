@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li class="active">Users</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">User Lists</h1>

        <!-- end page-header -->
        <div class="row">
        	@if(Session::has('submit-status'))
                <div class="alert alert-success">{{ Session::get('submit-status') }}</div>
            @endif
            <!-- begin col-12 -->
		    <div class="col-md-12">
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">&nbsp;</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>User Name</th>
                                    <th>Email Address</th>
                                    <th>Address</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Pincode</th>
                                    <th>Status</th>
                                    <th style="text-align: right; width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody><!--  class="even" -->
                            	@foreach ($all_users AS $user)
                                <tr class="odd">
                                    <td>
                                        @if($user['image'] && file_exists(public_path() ."/upload/profile_image/resize/".$user['image']))
                                        <img src="{{url('/upload/profile_image/resize/'.$user['image'])}}" alt="{{$user['first_name']}} {{$user['last_name']}}" height="50" width="50" class="img-responsive">
                                        @else
                                        <img src="{{ url('upload/profile_image/default.png') }}" height="50" width="50" class="img-responsive">
                                        @endif
                                    </td>
                                    <td>{{$user['first_name']}} {{$user['last_name']}}</td>
                                    <td>{{$user['email']}}</td>
                                    <td>{{$user['street_address']}}</td>
                                    <td>{{$user['countries']['name']}}</td>
                                    <td>{{$user['state']}}</td>
                                    <td>{{$user['city']}}</td>
                                    <td>{{$user['pincode']}}</td>
                                    <td>@if($user['status'] == '1') Active @else In-Active @endif</td>
                                    <td style="text-align: right;">@if($user['status'] == '1')<a href="/users/deact_user/{{$user['id']}}" onclick="return confirm('Do you really want to de-activate the current user ?');" title="De-activate User" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a> @else <a href="/users/activate_user/{{$user['id']}}" onclick="return confirm('Do you really want to activate the current user ?');" title="Activate User" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></a>@endif&nbsp;<a href="/users/change_access/{{$user['id']}}" onclick="return confirm('Do you really want to change the current user to admin ?');" title="Change Permission" class="btn btn-primary btn-sm"><i class="fa fa-key"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
    </div>
    <!-- end #content -->

<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
	
@endsection
