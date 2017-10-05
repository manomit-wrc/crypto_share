@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Groups</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Groups Listing</h1>
			<!-- end page-header -->

			@if(Session::has('submit-status'))
              	<p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
            @endif
			
			<div class="box-footer">
		      <a href="/group/add"><button type="button" class="btn btn-success m-r-5 m-b-5">Create Group</button></a>

		      <a href="/group/join-groups-list"><button type="button" class="btn btn-success m-r-5 m-b-5">Join Groups</button></a>
		    </div>
		    <br>

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Groups Listing</h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Group Name</th>
                                        <th>Group Type(s)</th>
                                        <th>Group Owner</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;?>
                                	@foreach($fetch_all_group as $key => $value)
                                		
                                		<tr class="odd gradeX">
	                                        <td><?php echo ++$i; ?></td>
	                                        <td><a href="/group_dashboard/{{base64_encode($value['groups']['id'])}}">{{$value['groups']['group_name']}}</a></td>
	                                        <td>{{$value['groups']['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
                                            <td>{{$value['groups']['group_admin_name']}}</td>
	                                        <td>{{$value['groups']['status'] == 1 ? 'Active' : 'Inactive'}}</td>
	                                        <td>
                                                @if($value['groups']['user_id'] == Auth::guard('crypto')->user()->id)
    												
                                                    <a href="/group/edit/{{base64_encode($value['groups']['id'])}}" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-pencil"></i></a>

    												<a href="/add_group_delete/{{base64_encode($value['groups']['id'])}}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm m-r-5"><i class="fa fa-trash"></i></a>

                                                    <a href="/group/dashboard/{{base64_encode($value['groups']['id'])}}" class="btn btn-inverse btn-sm m-r-5"><i class="fa fa-tachometer"></i></a>

                                                @else

                                                    <a href="/group/dashboard/{{base64_encode($value['groups']['id'])}}" class="btn btn-inverse btn-sm m-r-5"><i class="fa fa-tachometer"></i></a>

                                                @endif
                                                
	                                        </td>
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
            <!-- end row -->
		</div>


@endsection