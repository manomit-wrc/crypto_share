@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/transaction">Transaction</a></li>
            <li class="active">Old Transaction</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Old Transaction Lists</h1>

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
                        <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>Coin</th>
                                        <th>Group Name</th>
                                        <th>Transaction Type</th>
                                        <th style="text-align: right;">Buyin Price (BTC)</th>
                                        <th style="text-align: right;">Chips</th>
                                        <th style="width: 9%;">Date</th>
                                        <th style="text-align: right;">Coins</th>
                                        <th style="text-align: right;">Total Amount (BTC)</th>
                                        <th style="text-align: right;">Total Amount (USD)</th>
                                        <th style="text-align: right;">Target 1</th>
                                        <th style="text-align: right;">Target 2</th>
                                        <th style="text-align: right;">Target 3</th>
                                        <th>Notes</th>
                                        <th style="text-align: right; width: 8%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody><!--  class="even" -->
                                    @if (count($user_coin_data_list) > 0)
                                    	@foreach ($user_coin_data_list AS $user_coin_data)
                                        <tr class="odd">
                                            <td><img class="" width="50" height="50" src="https://www.cryptocompare.com{{$user_coin_data->coinlists->image_url}}" alt="{{$user_coin_data->coinlists->full_name}}"><br />{{$user_coin_data->coinlists->full_name}}</td>
                                            <td><a href="group/dashboard/{{base64_encode($user_coin_data->groupInfo->id)}}">{{$user_coin_data->groupInfo->group_name}}</a></td>
                                            <td>@if($user_coin_data->transaction_type == 1) Long Term Hold @elseif($user_coin_data->transaction_type == 2) Trade @else Watch @endif</td>
                                            <td style="text-align: right;">@if($user_coin_data->transaction_type != 3) {{$user_coin_data->current_price}} @endif</td>
                                            <td style="text-align: right;">@if($user_coin_data->transaction_type != 3) {{$user_coin_data->chip_value}} @endif</td>
                                            <td>{{date('jS M, Y', strtotime($user_coin_data->trade_date))}}</td>
                                            <td style="text-align: right;">@if($user_coin_data->transaction_type != 3) {{$user_coin_data->quantity}} @endif</td>
                                            <td style="text-align: right;">@if($user_coin_data->transaction_type != 3) {{$user_coin_data->total_value_btc}} @endif</td>
                                            <td style="text-align: right;">@if($user_coin_data->transaction_type != 3) {{$user_coin_data->total_value_usd}} @endif</td>
                                            <td style="text-align: right;">{{$user_coin_data->target_1}}</td>
                                            <td style="text-align: right;">{{$user_coin_data->target_2}}</td>
                                            <td style="text-align: right;">{{$user_coin_data->target_3}}</td>
                                            <td>@if($user_coin_data->notes > '')<a href="/#notes-{{$user_coin_data->id}}" class="btn btn-primary btn-xs" data-toggle="modal">Notes</a>@endif</td>
                                            <td style="text-align: right;"><a href="/transaction/delete/{{$user_coin_data->id}}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        @if($user_coin_data->notes > '')
                                        <!-- #modal-dialog -->
                                        <div class="modal fade" id="notes-{{$user_coin_data->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">{{$user_coin_data->coinlists->full_name}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{$user_coin_data->notes}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{Auth::guard('crypto')->user()->first_name}} {{Auth::guard('crypto')->user()->last_name}}
                                                        <!-- <a class="btn btn-sm btn-white" data-dismiss="modal">Close</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    @else
                                        <tr class="odd"><td colspan="14">There is no old transaction till now.</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
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