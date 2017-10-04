@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li class="active">Transaction</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Transaction Lists</h1>

        <!-- end page-header -->
        <div class="row">
        	@if(Session::has('submit-status'))
                <div class="alert alert-success">{{ Session::get('submit-status') }}</div>
            @endif
            <!-- begin col-12 -->
		    <div class="col-md-12">
                <div class="pull-right">
                    <a href="/transaction/add"><button type="button" class="btn btn-success m-b-5"><i class="fa fa-plus"></i> Add</button></a>
                </div>
                <div style="clear: both;"></div>
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">&nbsp;</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Coin Image</th>
                                    <th>Coin Name</th>
                                    <th>Transaction Type</th>
                                    <th style="text-align: right;">Trade Price</th>
                                    <th style="text-align: right;">Current Price</th>
                                    <th style="text-align: right;">Qty.</th>
                                    <th style="text-align: right;">Total Value</th>
                                    <th style="width: 10%;">Date</th>
                                    <th style="text-align: right; width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody><!--  class="even" -->
                            	@foreach ($user_coin_data_list AS $user_coin_data)
                                <tr class="odd">
                                    <td><img class="" width="50" height="50" src="https://www.cryptocompare.com{{$user_coin_data->coinlists->image_url}}" alt="{{$user_coin_data->coinlists->full_name}}"></td>
                                    <td>{{$user_coin_data->coinlists->full_name}}</td>
                                    <td>@if($user_coin_data->transaction_type == 1) Use 100 Chips @elseif($user_coin_data->transaction_type == 2) Input Trade with Targets @else Watch @endif</td>
                                    <td style="text-align: right;">{{$user_coin_data->trade_price}}</td>
                                    <td style="text-align: right;">{{$user_coin_data->current_price}}</td>
                                    <td style="text-align: right;">{{$user_coin_data->quantity}}</td>
                                    <td style="text-align: right;">{{$user_coin_data->total_value}}</td>
                                    <td>{{date('jS M, Y', strtotime($user_coin_data->trade_date))}}</td>
                                    <td style="text-align: right;"><a href="/transaction/delete/{{$user_coin_data->id}}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
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
    </div>
    <!-- end #content -->

<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
	
@endsection
