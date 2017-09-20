@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Join Groups</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Join Groups Listing</h1>
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
                            <h4 class="panel-title">Join Groups Listing</h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Group Name</th>
                                        <th>Group Type(s)</th>
                                        <th>Group Admin Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;?>
                                	@foreach($fetch_group_list as $key => $value)
                                		
                                		<tr class="odd gradeX">
	                                        <td><?php echo ++$i; ?></td>
	                                        <td>{{$value['group_name']}}</td>
	                                        <td>{{$value['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
	                                        
	                                        <td>{{$value['group_created_by'] }}</td>
	                                        <td>{{$value['status'] == 1 ? 'Active' : 'Inactive'}}</td>
	                                        <td>
	                                        	@if($value['invitation_status'] == 1)
	                                        		<div><i class="fa fa-2x fa-check"></i></div>
                                        		@elseif($value['invitation_status'] == 2)
                                        			<button type="button" class="btn btn-info m-r-5 m-b-5" disabled="">Pending</button>
	                                        	@elseif($value['invitation_status'] == 0)
	                                        		<button type="button" class="btn btn-info m-r-5 m-b-5 open_join_group_modal" data-toggle="modal" data-target="#myModal" value="{{$value['id']}}" group_type="{{$value['group_type']}}">Join Group</button>
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Join Group</h4>
      </div>
      <div class="modal-body">
        <div class="panel-body">
            <form action="javascript:void(0)" id="join_group_form" name="join_group_form">
            <input type="hidden" name="user_id" id="append_group_id" value="" group_type="">
                <fieldset>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Notes</label>
                        <textarea style="height: 150px;" cols="" rows="" class="form-control" id="notes" name="notes"></textarea>
                    </div>
                </fieldset>

                <div class="">
			      	<button type="submit" class="btn btn-default" id="join_group_submit">Join</button>

			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

		      	</div>
            </form>
        </div>
      </div>
      
    </div>

  </div>
</div>

@endsection