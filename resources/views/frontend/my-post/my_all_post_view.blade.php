@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">My Post</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">My Post Listing</h1>
			<!-- end page-header -->

			@if(Session::has('submit-status'))
              	<p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
            @endif

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">My Post Listing</h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Group Name</th>
                                        <th>Group Type</th>
                                        <th>Posts</th>
                                        <th>Post Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;?>
                                	@foreach($fetch_post_from_all_groups as $key => $value)
                                		
                                		<tr class="odd gradeX">
	                                        <td><?php echo ++$i; ?></td>
	                                        <td>{{$value['group_name']['group_name']}}</td>
	                                        <td>{{$value['group_name']['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
                                            <td>{{$value['post']}}</td>
                                            <td><img src="{{url('upload/quick_post/resize/'.$value['post_image'])}}" style="width: 50px; height: 50px;"></td>
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