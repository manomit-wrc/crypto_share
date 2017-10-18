@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Groups Invitation</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Groups Invitation</h1>
			<!-- end page-header -->

			@if(Session::has('submit-status'))
              	<p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
            @endif
			
		    <br>

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Groups Invitation Listing</h4>
                        </div>
                        <div class="panel-body">
                        
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Group Name</th>
                                        <th>Group Type(s)</th>
                                        <th>Request From</th>
                                        <th>Request Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr class="odd gradeX">
                                            <td>1</td>
                                            <td>{{$details_array[0]['groups']['group_name']}}</td>
                                            <td>{{$details_array[0]['groups']['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
                                            
                                            <td>{{$details_array['sent_invitation_user_name']}}</td>
                                            <td>{{$details_array[0]['created_at']}}</td>
                                            <td>
                                                <a href="/group/group_invitation_accept/{{base64_encode($details_array[0]['id'])}}" onclick="return confirm('Do you want to accept the current request from {{$details_array['sent_invitation_user_name']}} ?');" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-check"></i></a>

                                                <a href="/group/group_invitation_decline/{{base64_encode($details_array[0]['id'])}}" onclick="return confirm('Do you really want to decline the current request from {{$details_array['sent_invitation_user_name']}} ?');" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>

@endsection