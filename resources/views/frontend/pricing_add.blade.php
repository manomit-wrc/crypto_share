@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/pricing">Pricing</a></li>
            <li class="active">Add</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Add New Pricing</h1>

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            @if(Session::has('submit-status'))
                <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
            <div class="row">
                <form name="add_pricing" method="POST" action="/insert_pricing" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pricing Title</label>
                        <div class="col-md-10">
                            <input class="form-control" name="pricing_title" placeholder="Pricing Title" type="text" value="{{old('pricing_title')}}">
                        </div>
                        @if ($errors->first('pricing_title'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('pricing_title') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Pricing Amount</label>
                        <div class="col-md-10">
                            <input class="form-control" name="pricing_amount" placeholder="Pricing Amount" type="text" value="{{old('pricing_amount')}}">
                        </div>
                        @if ($errors->first('pricing_amount'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('pricing_amount') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Storage</label>
                        <div class="col-md-10">
                            <input class="form-control" name="storage" placeholder="Storage" type="text" value="{{old('storage')}}">
                        </div>
                        @if ($errors->first('storage'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('storage') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">No. of Clients</label>
                        <div class="col-md-10">
                            <input class="form-control" name="no_of_clients" placeholder="No. of Clients" type="text" value="{{old('no_of_clients')}}">
                        </div>
                        @if ($errors->first('no_of_clients'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('no_of_clients') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Active Projects</label>
                        <div class="col-md-10">
                            <input class="form-control" name="active_projects" placeholder="Active Projects" type="text" value="{{old('active_projects')}}">
                        </div>
                        @if ($errors->first('active_projects'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('active_projects') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Colors</label>
                        <div class="col-md-10">
                            <input class="form-control" name="colors" placeholder="Colors" type="text" value="{{old('colors')}}">
                        </div>
                        @if ($errors->first('colors'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('colors') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Goodies</label>
                        <div class="col-md-10">
                            <input class="form-control" name="goodies" placeholder="Goodies" type="text" value="{{old('goodies')}}">
                        </div>
                        @if ($errors->first('goodies'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('goodies') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email Support</label>
                        <div class="col-md-10">
                            <input class="form-control" name="email_support" placeholder="Email Support" type="text" value="{{old('email_support')}}">
                        </div>
                        @if ($errors->first('email_support'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('email_support') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Status</label>
                        <div class="col-md-10">
                            <select class="form-control" name="status">
                                <option value="" disabled>Please Select</option>
                                <option value="1">Active</option>
                                <option value="0">In-Active</option>
                            </select>
                        </div>
                        @if ($errors->first('status'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('status') }}</span>@endif
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
	
@endsection
