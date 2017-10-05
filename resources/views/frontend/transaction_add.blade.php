@extends('dashboard_layout')
<!-- end #header -->

<style type="text/css">
    .tab-content {
        border: 1px solid #ccc;
    }
    .ui-autocomplete {
        height: 200px;
        overflow: scroll;
    }
    .loading {
        background: url('/storage/dashboard/assets/img/loading.gif') no-repeat;
    }
</style>

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/transaction">Transaction</a></li>
            <li class="active">Add Transaction</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Transaction Page</h1>

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            @if(Session::has('submit-status'))
                <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
            <div class="row">
                <form name="add_transaction" method="POST" action="/insert_transaction" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" id="user_id" value="{{base64_encode(Auth::guard('crypto')->user()->id)}}">
                    <input type="hidden" name="tran_type" id="tran_type" value="1">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Search for Coins</label>
                        <div class="col-md-10">
                            <input class="form-control" name="coin_full_name" id="coin_full_name" placeholder="Search for Coins" type="text">
                            <input type="hidden" name="coin_name" id="coin_name">
                            <input type="hidden" name="coin_id" id="coin_id">
                        </div>
                        @if ($errors->first('coin_full_name'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('coin_full_name') }}</span>@endif
                    </div>
                    <div id="loading"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-10" style="padding-left: 5px;">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a id="tab1" href="#use_100_chips" data-toggle="tab">
                                    <span class="hidden-xs">Long Term Hold</span>
                                </a>
                            </li>
                            <li class="">
                                <a id="tab2" href="#input_trade_targets" data-toggle="tab">
                                    <span class="hidden-xs">Input Trade with Targets</span>
                                </a>
                            </li>
                            <li class="">
                                <a id="tab3" href="#watch" data-toggle="tab">
                                    <span class="hidden-xs">Watch</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="use_100_chips">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Buy in Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_current_price" id="tab1_current_price" placeholder="Buy in Price" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_trade_price" id="tab1_trade_price" placeholder="Trade Price" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Actual Quantity</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_qty" id="tab1_qty" placeholder="Quantity" type="number" value="{{old('tab1_qty')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_total_val" id="tab1_total_val" placeholder="Total Value" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_trade_date" id="datepicker-autoClose" placeholder="Trade Date" type="text" value="{{date('d M Y')}}" data-date-format="dd M yyyy" data-date-end-date="Date.default">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Notes</label>
                                    <div class="col-md-10">
                                        <textarea name="tab1_notes" class="form-control" rows="3" cols="" placeholder="Notes">{{old('tab1_notes')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">No. of Chips</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_chip_qty" placeholder="No. of Chips" type="number" value="{{old('tab1_chip_qty')}}" min="0" max="100">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="input_trade_targets">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Buy in Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_current_price" id="tab2_current_price" placeholder="Buy in Price" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_trade_price" id="tab2_trade_price" placeholder="Trade Price" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Actual Quantity</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_qty" id="tab2_qty" placeholder="Quantity" type="number" value="{{old('tab2_qty')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_total_val" id="tab2_total_val" placeholder="Total Value" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_trade_date" id="datepicker-autoClose" placeholder="Trade Date" type="text" value="{{date('d M Y')}}" data-date-format="dd M yyyy" data-date-end-date="Date.default">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Notes</label>
                                    <div class="col-md-10">
                                        <textarea name="tab2_notes" class="form-control" rows="3" cols="" placeholder="Notes">{{old('tab2_notes')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 1</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target1" placeholder="Target 1" type="number" value="{{old('tab2_target1')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 2</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target2" placeholder="Target 2" type="number" value="{{old('tab2_target2')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 3</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target3" placeholder="Target 3" type="number" value="{{old('tab2_target3')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="watch">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Buy in Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_current_price" id="tab3_current_price" placeholder="Buy in Price" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_trade_price" id="tab3_trade_price" placeholder="Trade Price" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Actual Quantity</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_qty" id="tab3_qty" placeholder="Quantity" type="number" value="{{old('tab3_qty')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_total_val" id="tab3_total_val" placeholder="Total Value" type="text" value="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_trade_date" id="datepicker-autoClose" placeholder="Trade Date" type="text" value="{{date('d M Y')}}" data-date-format="dd M yyyy" data-date-end-date="Date.default">
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
        $( function() {
            var coinList = [
                @foreach($coin_list as $coin)
                {label:"{{$coin->full_name}}",value:"{{$coin->name}}",id:"{{$coin->id}}"},
                @endforeach
            ];
            $( "#coin_full_name" ).autocomplete({
                source: coinList,
                focus: function(event, ui) {
                    $("#coin_full_name").val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    $("#coin_full_name").val(ui.item.label);
                    $("#coin_name").val(ui.item.value);
                    $("#coin_id").val(ui.item.id);
                    var coin_name = $('#coin_name').val();
                    $.ajax({
                        url: '/get_price/'+coin_name,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            setTimeout(function() {
                                $('#loading').addClass('loading');
                            }, 3000);
                        },
                        success: function(data) {
                            $("#tab1_current_price").val(data.USD);
                            $("#tab2_current_price").val(data.USD);
                            $("#tab3_current_price").val(data.USD);
                            $("#tab1_trade_price").val(data.USD);
                            $("#tab2_trade_price").val(data.USD);
                            $("#tab3_trade_price").val(data.USD);
                        },
                        error: function() {
                            //alert('error');
                        },
                        complete: function() {
                            $('#loading').removeClass('loading');
                        }
                    });
                }
            });
        });
    
        

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
                var cur_price = parseFloat($("#tab1_current_price").val());
                var qty = parseFloat($("#tab1_qty").val());
                var tot_val = (cur_price * qty);
                $('#tab1_total_val').val(tot_val);
            }
        });

        $("#tab2_qty").blur(function() {
            if ($("#tab2_qty").val() != '') {
                var cur_price = parseFloat($("#tab2_current_price").val());
                var qty = parseFloat($("#tab2_qty").val());
                var tot_val = (cur_price * qty);
                $('#tab2_total_val').val(tot_val);
            }
        });

        $("#tab3_qty").blur(function() {
            if ($("#tab3_qty").val() != '') {
                var cur_price = parseFloat($("#tab3_current_price").val());
                var qty = parseFloat($("#tab3_qty").val());
                var tot_val = (cur_price * qty);
                $('#tab3_total_val').val(tot_val);
            }
        });
    </script>
	
@endsection

