@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/group/dashboard/{{base64_encode($group_id)}}">Group Dashboard</a></li>
            <li class="active">Group Transaction</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Group Wise Transaction Lists ({{$group_info['group_name']}})</h1>

        <!-- end page-header -->
        <div class="row">
        	@if(Session::has('submit-status'))
                <div class="alert alert-success">{{ Session::get('submit-status') }}</div>
            @endif
            <!-- begin col-12 -->
		    <div class="col-md-12">
                <div class="pull-right">
                    <a href="/group/transaction/add/{{base64_encode($group_id)}}"><button type="button" class="btn btn-success m-b-5"><i class="fa fa-plus"></i> Add</button></a>
                </div>
                <div style="clear: both;"></div>
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">&nbsp;</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Coin</th>
                                    <th>Transaction Type</th>
                                    <th>User Name</th>
                                    <th style="text-align: right;">Buyin Price (BTC)</th>
                                    <th style="text-align: right;">Chips</th>
                                    <th style="width: 9%;">Date</th>
                                    <th style="text-align: right;">Coins</th>
                                    <th style="text-align: right;">Total Amount (BTC)</th>
                                    <th style="text-align: right;">Total Amount (USD)</th>
                                    <th>Notes</th>
                                    <th style="text-align: right; width: 11%;">Action</th>
                                </tr>
                            </thead>
                            <tbody><!--  class="even" -->
                                @if (count($fetch_group_wise_coin_list) > 0)
                                	@foreach ($fetch_group_wise_coin_list as $key => $value)
                                    <tr class="odd">
                                        <td><img class="" width="50" height="50" src="https://www.cryptocompare.com{{$value['coinlists']['image_url']}}" alt="{{$value['coinlists']['full_name']}}"><br />{{$value['coinlists']['full_name']}}</td>
                                        <td>@if($value['transaction_type'] == 1) Long Term Hold @elseif($value['transaction_type'] == 2) Trade @else Watch @endif</td>
                                        <td>{{$value['user_info']['first_name'].' '.$value['user_info']['last_name']}}</td>
                                        <td style="text-align: right;">@if($value['transaction_type'] != 3) {{$value['current_price']}} @endif</td>
                                        <td style="text-align: right;">@if($value['transaction_type'] != 3) {{$value['chip_value']}} @endif</td>
                                        <td>{{date('jS M, Y', strtotime($value['trade_date']))}}</td>
                                        <td style="text-align: right;">@if($value['transaction_type'] != 3) {{$value['quantity']}} @endif</td>
                                        <td style="text-align: right;">@if($value['transaction_type'] != 3) {{$value['total_value_btc']}} @endif</td>
                                        <td style="text-align: right;">@if($value['transaction_type'] != 3) {{$value['total_value_usd']}} @endif</td>
                                        <td>@if($value['notes'] > '')<a href="/#notes-{{$value['id']}}" class="btn btn-primary btn-xs" data-toggle="modal">Notes</a>@endif</td>
                                        <td style="text-align: right;">
                                        @if($value['user_info']['id'] == Auth::guard('crypto')->user()->id)
                                            <a title="Edit" href="/group/group_transaction/edit/{{base64_encode($group_id)}}/{{$value['id']}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="/transaction/remove/{{$value['id']}}" onclick="return confirm('Do you want to move the current record to previous transaction ?');" title="Move to Previous Transaction" class="btn btn-warning btn-sm"><i class="fa fa-eraser"></i></a>
                                            <a href="/transaction/delete/{{$value['id']}}" onclick="return confirm('Do you really want to delete the current record ?');" title="Delete the Transaction" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        @endif
                                        </td>
                                    </tr>
                                    @if($value['notes'] > '')
                                    <!-- #modal-dialog -->
                                    <div class="modal fade" id="notes-{{$value['id']}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">{{$value['coinlists']['full_name']}}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {{$value['notes']}}
                                                </div>
                                                <div class="modal-footer">
                                                    {{$value['user_info']['first_name']}} {{$value['user_info']['last_name']}}
                                                    <!-- <a class="btn btn-sm btn-white" data-dismiss="modal">Close</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                @else
                                    <tr class="odd"><td colspan="11">There is no transaction for this group till now.</td></tr>
                                @endif
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