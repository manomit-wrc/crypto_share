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
		      <a href="/create-group"><button type="submit" class="btn btn-primary">Create Group</button></a>
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;?>
                                	@foreach($fetch_all_group as $key => $value)
                                		
                                		<tr class="odd gradeX">
	                                        <td><?php echo ++$i; ?></td>
	                                        <td>{{$value['group_name']}}</td>
	                                        <td>{{$value['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
	                                        <td>{{$value['status'] == 1 ? 'Active' : 'Inactive'}}</td>
	                                        <td>
	                                        	<div class="btn-group m-r-5 m-b-5">
													<a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">Action <span class="caret"></span></a>
													<ul class="dropdown-menu">
														<li><a href="/add_group_edit/{{base64_encode($value['id'])}}">Edit</a></li>
														<li><a href="/add_group_delete/{{base64_encode($value['id'])}}" onclick="return confirm('Are you sure?')">Delete</a></li>
													</ul>
												</div>
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