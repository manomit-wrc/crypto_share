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
                                        <th>Group Type</th>
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
	                                        <td>{{$value['groups']['group_name']}}</td>
	                                        <td>{{$value['groups']['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
                                            <td>{{$value['groups']['group_admin_name']}}</td>
	                                        <td>{{$value['groups']['status'] == 1 ? 'Active' : 'Inactive'}}</td>
	                                        <td>
                                                @if($value['groups']['user_id'] == Auth::guard('crypto')->user()->id)

                                                    <a title="Edit" href="/group/edit/{{base64_encode($value['groups']['id'])}}" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-pencil"></i></a>

    												<a title="Delete" href="/add_group_delete/{{base64_encode($value['groups']['id'])}}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm m-r-5"><i class="fa fa-trash"></i></a>

                                                    <a title="View Dashboard" href="/group/dashboard/{{base64_encode($value['groups']['id'])}}" class="btn btn-inverse btn-sm m-r-5"><i class="fa fa-tachometer"></i></a>

                                                    <a title="Send Invitation" href="#modal_for_send_invitation" class="btn btn-inverse btn-sm m-r-5 group_invitation_modal" data-toggle="modal" group_id="{{$value['groups']['id']}}"><i class="fa fa-user-plus" aria-hidden="true"></i></a>

                                                @else

                                                    <a title="Dashboard" href="/group/dashboard/{{base64_encode($value['groups']['id'])}}" class="btn btn-inverse btn-sm m-r-5"><i class="fa fa-tachometer"></i></a>

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

        <div class="modal fade" id="modal_for_send_invitation" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Send Group Invitation</h4>
                    </div>

                    <div class="modal-body">
                        <div class="panel-body">
                            <form name="group_invitation_form" id="group_invitation_form" action="javascript:void(0)">
                            
                                <fieldset>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select User:</label>
                                        <br>
                                        <select class="form-control" multiple="multiple" name="send_group_invitation[]" id="send_group_invitation">
                                            @foreach($fetch_all_user as $key=>$value)
                                                <option value="{{$value['id']}}">{{$value['first_name'].' '.$value['last_name']}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Note:</label>
                                        <textarea class="form-control" rows="" cols="" name="send_group_invitation_note" id="send_group_invitation_note"></textarea>
                                    </div>
                                </fieldset>

                                <div class="">
                                    <input type="hidden" name="send_group_id" class="send_group_id" value="">
                                    <a href="javascript:void(0);" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-success" id="send_invitation">Send</a>

                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


@endsection