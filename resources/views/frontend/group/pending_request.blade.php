@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li><a href="javascript:;">Pending Groups Request</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Pending Groups Request</h1>
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
                            <h4 class="panel-title">Pending Groups Request Listing</h4>
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
                                    <?php $i=0;?>
                                    @foreach($details as $key => $value)
                                        
                                        <tr class="odd gradeX">
                                            <td><?php echo ++$i; ?></td>
                                            <td>{{$value['groups']['group_name']}}</td>
                                            <td>{{$value['groups']['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
                                            
                                            <td>{{$value['sent_invitation_user_name']}}</td>
                                            <td>{{$value['created_at']}}</td>
                                            <td>
                                                <a href="/group/pending_request_accept/{{base64_encode($value['id'])}}" onclick="return confirm('Do you want to accept the current request from {{$value['sent_invitation_user_name']}} ?');" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-check"></i></a>

                                                <a href="/group/pending_request_decline/{{base64_encode($value['id'])}}" onclick="return confirm('Do you really want to decline the current request from {{$value['sent_invitation_user_name']}} ?');" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
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
			      	<button type="submit" class="btn btn-success m-r-5 m-b-5" id="join_group_submit">Join</button>

			        <button type="button" class="btn btn-success m-r-5 m-b-5" data-dismiss="modal">Close</button>

		      	</div>
            </form>
        </div>
      </div>
      
    </div>

  </div>
</div>

@endsection