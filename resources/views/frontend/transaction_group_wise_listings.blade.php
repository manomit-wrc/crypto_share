@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li class="active">Group Wise Transaction</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Group Wise Transaction Lists</h1>

        <!-- end page-header -->
        <div class="row">
        	@if(Session::has('submit-status'))
                <div class="alert alert-success">{{ Session::get('submit-status') }}</div>
            @endif
            <!-- begin col-12 -->
		    <div class="col-md-12">
                <!-- <div class="pull-right">
                    <a href="/transaction/add"><button type="button" class="btn btn-success m-b-5"><i class="fa fa-plus"></i> Add</button></a>
                </div> -->
                <div style="clear: both;"></div>
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">&nbsp;</h4>
                    </div>
                    <div class="panel-body">
                        <table id="data-table_myTransaction" class="table table-striped table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Coin Image</th>
                                    <th>Coin Name</th>
                                    <th>Transaction Type</th>
                                    <th>User Name</th>
                                    <th style="text-align: right;">Trade Price</th>
                                    <th style="text-align: right;">High</th>
                                    <th style="text-align: right;">Low</th>
                                    <th style="text-align: right;">Qty.</th>
                                    <th style="text-align: right;">Total Value</th>
                                    <th style="width: 10%;">Date</th>
                                    <th style="text-align: right; width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody><!--  class="even" -->
                            	@foreach ($fetch_group_wise_coin_list as $key => $value)
                                <tr class="odd">
                                    <td><img class="" width="50" height="50" src="https://www.cryptocompare.com{{$value['coinlists']['image_url']}}" alt="{{$value['coinlists']['full_name']}}"></td>
                                    <td>{{$value['coinlists']['full_name']}}</td>
                                    <td>@if($value['transaction_type'] == 1) Long Term Hold @elseif($value['transaction_type'] == 2) Input Trade with Targets @else Watch @endif</td>
                                    <td>{{$value['user_info']['first_name'].' '.$value['user_info']['last_name']}}</td>
                                    <td style="text-align: right;">{{$value['trade_price']}}</td>
                                    <td style="text-align: right;">{{$value['high']}}</td>
                                    <td style="text-align: right;">{{$value['low']}}</td>
                                    <td style="text-align: right;">{{$value['quantity']}}</td>
                                    <td style="text-align: right;">{{$value['total_value']}}</td>
                                    <td>{{date('jS M, Y', strtotime($value['trade_date']))}}</td>
                                    <td style="text-align: right;">
                                    @if($value['user_info']['id'] == Auth::guard('crypto')->user()->id)
                                        <a title="Edit" href="#" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    <a href="/transaction/delete/{{$value['id']}}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm m-r-5"><i class="fa fa-trash"></i></a>
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
    </div>
    <!-- end #content -->

<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
	
@endsection