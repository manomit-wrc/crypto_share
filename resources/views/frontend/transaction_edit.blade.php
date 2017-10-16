@extends('dashboard_layout')
<!-- end #header -->

<style type="text/css">
    .tab-content {
        border: 1px solid #ccc;
    }
</style>

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/group/dashboard/{{base64_encode($group_id)}}">Group Dashboard</a></li>
            <li><a href="/group/group_transaction/{{base64_encode($group_id)}}">Group Transaction</a></li>
            <li class="active">Edit Transaction</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Edit Transaction Page</h1>

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            @if(Session::has('submit-status'))
                <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
            <div class="row">
                <form name="edit_transaction" method="POST" action="/update_transaction" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="group_id" id="group_id" value="{{base64_encode($group_id)}}">
                    <input type="hidden" name="user_id" id="user_id" value="{{base64_encode(Auth::guard('crypto')->user()->id)}}">
                    <input type="hidden" name="tran_id" id="tran_id" value="{{$tran_id}}">
                    <input type="hidden" name="tran_type" id="tran_type" value="{{$tran_details[0]['transaction_type']}}">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Coin Name</label>
                        <div class="col-md-10">
                            <input class="form-control" name="coin_full_name" id="coin_full_name" type="text" value="{{$tran_details[0]['coinlists']['full_name']}}" readonly>
                            <input type="hidden" name="coin_id" id="coin_id" value="{{$tran_details[0]['coin_list_id']}}">
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-10" style="padding-left: 5px;">
                        <ul class="nav nav-pills">
                            <li @if ($tran_details[0]['transaction_type'] == 1)class="active" @endif>
                                <a id="tab1" href="#use_100_chips" data-toggle="tab">
                                    <span class="hidden-xs">Long Term Hold</span>
                                </a>
                            </li>
                            <li @if ($tran_details[0]['transaction_type'] == 2)class="active" @endif>
                                <a id="tab2" href="#input_trade_targets" data-toggle="tab">
                                    <span class="hidden-xs">Trade</span>
                                </a>
                            </li>
                            <li @if ($tran_details[0]['transaction_type'] == 3)class="active" @endif>
                                <a id="tab3" href="#watch" data-toggle="tab">
                                    <span class="hidden-xs">Watch</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade @if ($tran_details[0]['transaction_type'] == 1)active in @endif" id="use_100_chips">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Buy in Price (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_current_price" id="tab1_current_price" placeholder="Buy in Price (BTC)" type="text" value="{{$tran_details[0]['current_price']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price (USD)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_trade_price_usd" id="tab1_trade_price_usd" placeholder="Trade Price (USD)" type="text" value="{{$tran_details[0]['trade_price_usd']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_trade_price_btc" id="tab1_trade_price_btc" placeholder="Trade Price (BTC)" type="text" value="{{$tran_details[0]['trade_price_btc']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Actual Quantity</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_qty" id="tab1_qty" placeholder="Quantity" type="number" value="@if($tran_details[0]['transaction_type'] == 1){{$tran_details[0]['quantity']}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value (USD)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_total_val_usd" id="tab1_total_val_usd" placeholder="Total Value (USD)" type="text" value="@if($tran_details[0]['transaction_type'] == 1){{$tran_details[0]['total_value_usd']}}@endif" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_total_val_btc" id="tab1_total_val_btc" placeholder="Total Value (BTC)" type="text" value="@if($tran_details[0]['transaction_type'] == 1){{$tran_details[0]['total_value_btc']}}@endif" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd M yyyy" data-date-end-date="Date.default">
                                            <input type="text" class="form-control" placeholder="Trade Date" value="{{date('d M Y', strtotime($tran_details[0]['trade_date']))}}" name="tab1_trade_date" disabled>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Notes</label>
                                    <div class="col-md-10">
                                        <textarea name="tab1_notes" class="form-control" rows="3" cols="" placeholder="Notes">@if($tran_details[0]['transaction_type'] == 1){{$tran_details[0]['notes']}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">No. of Chips</label>
                                    <div class="col-md-10">
                                        <input class="form-control chip_qty_validation_longterm" name="tab1_chip_qty" placeholder="No. of Chips" type="number" value="@if ($tran_details[0]['transaction_type'] == 1){{$tran_details[0]['chip_value']}}@endif" min="1" max="{{$remain_longterm_chip}}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if ($tran_details[0]['transaction_type'] == 2)active in @endif" id="input_trade_targets">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Buy in Price (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_current_price" id="tab2_current_price" placeholder="Buy in Price (BTC)" type="text" value="{{$tran_details[0]['current_price']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price (USD)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_trade_price_usd" id="tab2_trade_price_usd" placeholder="Trade Price (USD)" type="text" value="{{$tran_details[0]['trade_price_usd']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_trade_price_btc" id="tab2_trade_price_btc" placeholder="Trade Price (BTC)" type="text" value="{{$tran_details[0]['trade_price_btc']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Actual Quantity</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_qty" id="tab2_qty" placeholder="Quantity" type="number" value="@if($tran_details[0]['transaction_type'] == 2){{$tran_details[0]['quantity']}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value (USD)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_total_val_usd" id="tab2_total_val_usd" placeholder="Total Value (USD)" type="text" value="@if($tran_details[0]['transaction_type'] == 2){{$tran_details[0]['total_value_usd']}}@endif" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_total_val_btc" id="tab2_total_val_btc" placeholder="Total Value (BTC)" type="text" value="@if($tran_details[0]['transaction_type'] == 2){{$tran_details[0]['total_value_btc']}}@endif" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd M yyyy" data-date-end-date="Date.default">
                                            <input type="text" class="form-control" placeholder="Trade Date" value="{{date('d M Y', strtotime($tran_details[0]['trade_date']))}}" name="tab2_trade_date" disabled>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Notes</label>
                                    <div class="col-md-10">
                                        <textarea name="tab2_notes" class="form-control" rows="3" cols="" placeholder="Notes">@if($tran_details[0]['transaction_type'] == 2){{$tran_details[0]['notes']}}@endif</textarea>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Type</label>
                                    <div class="col-md-10">
                                        <label><input type="radio" name="trade_type" value="long_term" @if($tran_details[0]['transaction_type'] == 2) @if($tran_details[0]['trade_type'] == 'long_term') checked="checked" @endif @endif><span style="font-weight: normal;"> 100 chips for long term</span></label>&nbsp;
                                        <label><input type="radio" name="trade_type" value="trade" @if($tran_details[0]['transaction_type'] == 2) @if($tran_details[0]['trade_type'] == 'trade') checked="checked" @endif @endif><span style="font-weight: normal;"> 100 chips for trade</span></label>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-md-2 control-label">No. of Chips</label>
                                    <div class="col-md-10">
                                        <input class="form-control chip_qty_validation_trade" name="tab2_chip_qty" placeholder="No. of Chips" type="number" value="@if($tran_details[0]['transaction_type'] == 2){{$tran_details[0]['chip_value']}}@endif" min="1" max="{{$remain_trade_chip}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 1</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target1" placeholder="Target 1" type="text" value="{{$tran_details[0]['target_1']}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 2</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target2" placeholder="Target 2" type="text" value="{{$tran_details[0]['target_2']}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 3</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target3" placeholder="Target 3" type="text" value="{{$tran_details[0]['target_3']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if($tran_details[0]['transaction_type'] == 3)active in @endif" id="watch">
                                <div class="form-group" style="display: none;">
                                    <label class="col-md-2 control-label">Buy in Price (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_current_price" id="tab3_current_price" placeholder="Buy in Price (BTC)" type="text" value="{{$tran_details[0]['current_price']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label class="col-md-2 control-label">Trade Price (USD)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_trade_price_usd" id="tab3_trade_price_usd" placeholder="Trade Price (USD)" type="text" value="{{$tran_details[0]['trade_price_usd']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label class="col-md-2 control-label">Trade Price (BTC)</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_trade_price_btc" id="tab3_trade_price_btc" placeholder="Trade Price (BTC)" type="text" value="{{$tran_details[0]['trade_price_btc']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label class="col-md-2 control-label">Actual Quantity</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_qty" id="tab3_qty" placeholder="Quantity" type="number" value="@if($tran_details[0]['transaction_type'] == 3){{$tran_details[0]['quantity']}}@endif">
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label class="col-md-2 control-label">Total Value</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_total_val" id="tab3_total_val" placeholder="Total Value" type="text" value="@if($tran_details[0]['transaction_type'] == 3){{$tran_details[0]['total_value']}}@endif" readonly>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd M yyyy" data-date-end-date="Date.default">
                                            <input type="text" class="form-control" placeholder="Trade Date" value="{{date('d M Y', strtotime($tran_details[0]['trade_date']))}}" name="tab3_trade_date" disabled>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Notes</label>
                                    <div class="col-md-10">
                                        <textarea name="tab3_notes" class="form-control" rows="3" cols="" placeholder="Notes">@if($tran_details[0]['transaction_type'] == 3){{$tran_details[0]['notes']}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <button type="reset" class="btn btn-sm btn-default">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end profile-container -->
    </div>
    <!-- end #content -->

<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
    <script type="text/javascript">
        $("#tab1").click(function() {
            var tran_type = 1;
            $('#tran_type').val(tran_type);
        });

        $("#tab2").click(function() {
            var tran_type = 2;
            $('#tran_type').val(tran_type);
        });

        $("#tab3").click(function() {
            var tran_type = 3;
            $('#tran_type').val(tran_type);
        });

        $("#tab1_qty").blur(function() {
            if ($("#tab1_qty").val() != '') {
                var trade_price_usd = parseFloat($("#tab1_trade_price_usd").val());
                var qty = parseFloat($("#tab1_qty").val());
                var tot_val_usd = (trade_price_usd * qty);
                var trade_price_btc = parseFloat($("#tab1_trade_price_btc").val());
                var tot_val_btc = (trade_price_btc * qty);
                $('#tab1_total_val_usd').val(tot_val_usd);
                $('#tab1_total_val_btc').val(tot_val_btc);
            }
        });

        $("#tab2_qty").blur(function() {
            if ($("#tab2_qty").val() != '') {
                var trade_price_usd = parseFloat($("#tab2_trade_price_usd").val());
                var qty = parseFloat($("#tab2_qty").val());
                var tot_val_usd = (trade_price_usd * qty);
                var trade_price_btc = parseFloat($("#tab2_trade_price_btc").val());
                var tot_val_btc = (trade_price_btc * qty);
                $('#tab2_total_val_usd').val(tot_val_usd);
                $('#tab2_total_val_btc').val(tot_val_btc);
            }
        });

        $("#tab3_qty").blur(function() {
            if ($("#tab3_qty").val() != '') {
                var trade_price_usd = parseFloat($("#tab3_trade_price_usd").val());
                var qty = parseFloat($("#tab3_qty").val());
                var tot_val_usd = (trade_price_usd * qty);
                var trade_price_btc = parseFloat($("#tab3_trade_price_btc").val());
                var tot_val_btc = (trade_price_btc * qty);
                $('#tab3_total_val_usd').val(tot_val_usd);
                $('#tab3_total_val_btc').val(tot_val_btc);
            }
        });

        $('.chip_qty_validation_longterm').on('change',function() {
            var value = $(this).val();
            if (value > {{$remain_longterm_chip}}) {
                alert ('You have consumed {{$tot_longterm_chip}} chips. Your remaining chip is {{$remain_longterm_chip}}');
                return false;
            } else if (value < 1) {
                alert ('Minimum 1 Chip must be added for Long Term Hold');
                return false;
            }
        });

        $('.chip_qty_validation_trade').on('change',function() {
            var value = $(this).val();
            if (value > {{$remain_trade_chip}}) {
                alert ('You have consumed {{$tot_trade_chip}} chips. Your remaining chip is {{$remain_trade_chip}}');
                return false;
            } else if (value < 1) {
                alert ('Minimum 1 Chip must be added for Trade');
                return false;
            }
        });
    </script>
	
@endsection
