@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="/dashboard">Dashboard</a></li>
				<li><a href="javascript:;">Teams</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			
			<!-- end page-header -->

			@if(Session::has('submit-status'))
              	<p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
            @endif
			
			<div class="box-footer">
		      <a href="/teams/create"><button type="button" class="btn btn-success m-r-5 m-b-5">Add Team</button></a>
		    </div>
		    <br>

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Teams</h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Designation</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($teams as $key => $value)
                                		
                                		<tr class="odd gradeX">
	                                        <td>{{ ++$key }}</td>
	                                        <td>{{ $value->first_name }}</td>
	                                        <td>{{ $value->last_name }}</td>
                                            <td>{{ str_replace("-", " ", $value->designation )}}</td>
                                            
                                            <td>
                                                @if($value->image && file_exists(public_path() ."/upload/teams/".$value->image))
                                                    <img src="{{ url('upload/teams/'.$value->image) }}" height="100" width="100" class="img-responsive">
                                                @else
                                                    <img src="{{ url('upload/teams/default.png') }}" height="100" width="100" class="img-responsive">
                                                @endif
                                            </td>
	                                        <td>{{ $value->status == '1' ? 'Active' : 'Inactive' }}</td>
	                                        <td>
												<a href="/teams/{{ $value->id }}/edit" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-pencil"></i></a>

												<a href="/teams/delete/{{ $value->id }}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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