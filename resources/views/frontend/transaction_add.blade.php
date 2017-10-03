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
                <form name="add_transaction" method="POST" action="/add_transaction" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" id="user_id" value="{{base64_encode(Auth::guard('crypto')->user()->id)}}">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Search for Coins</label>
                        <div class="col-md-10">
                            <input class="form-control" name="search_coin" id="search_coin" placeholder="Search for Coins" type="text" value="{{old('search_coin')}}">
                        </div>
                        @if ($errors->first('search_coin'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('search_coin') }}</span>@endif
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-10" style="padding-left: 5px;">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a href="#use_100_chips" data-toggle="tab">
                                    <span class="visible-xs"></span>
                                    <span class="hidden-xs">Use 100 Chips</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#input_trade_targets" data-toggle="tab">
                                    <span class="visible-xs"></span>
                                    <span class="hidden-xs">Input Trade with Targets</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#watch" data-toggle="tab">
                                    <span class="visible-xs"></span>
                                    <span class="hidden-xs">Watch</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="use_100_chips">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Current Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_current_price" placeholder="Current Price" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_trade_price" placeholder="Trade Price" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Enter Qty.</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_qty" placeholder="Qty." type="text" value="{{old('tab1_qty')}}">
                                    </div>
                                    @if ($errors->first('tab1_qty'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab1_qty') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_total_val" placeholder="Total Value" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_trade_date" placeholder="Trade Date" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Notes</label>
                                    <div class="col-md-10">
                                        <textarea name="tab1_notes" class="form-control" rows="3" cols="" placeholder="Notes">{{old('tab1_notes')}}</textarea>
                                    </div>
                                    @if ($errors->first('tab1_notes'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab1_notes') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">No. of Chips</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab1_chip_qty" placeholder="No. of Chips" type="number" value="{{old('tab1_chip_qty')}}" min="0" max="100">
                                    </div>
                                    @if ($errors->first('tab1_chip_qty'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab1_chip_qty') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">&nbsp;</label>
                                    <div class="col-md-10">
                                        <label class="radio-inline">
                                            <input name="chip_type" value="long_term" checked="" type="radio">
                                            100 Long Term Chips
                                        </label>
                                        <label class="radio-inline">
                                            <input name="chip_type" value="trade" type="radio">
                                            100 Trade Chips
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="input_trade_targets">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Current Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_current_price" placeholder="Current Price" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_trade_price" placeholder="Trade Price" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Enter Qty.</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_qty" placeholder="Qty." type="text" value="{{old('tab2_qty')}}">
                                    </div>
                                    @if ($errors->first('tab2_qty'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab2_qty') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_total_val" placeholder="Total Value" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_trade_date" placeholder="Trade Date" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Notes</label>
                                    <div class="col-md-10">
                                        <textarea name="tab2_notes" class="form-control" rows="3" cols="" placeholder="Notes">{{old('tab2_notes')}}</textarea>
                                    </div>
                                    @if ($errors->first('tab2_notes'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab2_notes') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 1</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target1" placeholder="Target 1" type="text" value="{{old('tab2_target1')}}">
                                    </div>
                                    @if ($errors->first('tab2_target1'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab2_target1') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 2</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target2" placeholder="Target 2" type="text" value="{{old('tab2_target2')}}">
                                    </div>
                                    @if ($errors->first('tab2_target2'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab2_target2') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Target 3</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab2_target3" placeholder="Target 3" type="text" value="{{old('tab2_target3')}}">
                                    </div>
                                    @if ($errors->first('tab2_target3'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab2_target3') }}</span>@endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="watch">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Current Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_current_price" placeholder="Current Price" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Price</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_trade_price" placeholder="Trade Price" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Enter Qty.</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_qty" placeholder="Qty." type="text" value="{{old('tab3_qty')}}">
                                    </div>
                                    @if ($errors->first('tab3_qty'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('tab3_qty') }}</span>@endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Total Value</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_total_val" placeholder="Total Value" type="text" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Trade Date</label>
                                    <div class="col-md-10">
                                        <input class="form-control" name="tab3_trade_date" placeholder="Trade Date" type="text" value="" disabled>
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
            var availableCoins = [
                @foreach($coin_list as $coin)
                "{{$coin->full_name}}",
                @endforeach
            ];
            $( "#search_coin" ).autocomplete({
                source: availableCoins
            });
        });
    </script>
	
@endsection

