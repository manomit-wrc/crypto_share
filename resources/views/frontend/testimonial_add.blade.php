@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/testimonial">Testimonial</a></li>
            <li class="active">Add</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Add New Testimonial</h1>

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            @if(Session::has('submit-status'))
                <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
            <div class="row">
                <form name="add_testimonial" method="POST" action="/insert_testimonial" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client Name</label>
                        <div class="col-md-10">
                            <input class="form-control" name="client_name" placeholder="Client Name" type="text" value="{{old('client_name')}}">
                        </div>
                        @if ($errors->first('client_name'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('client_name') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client Designation</label>
                        <div class="col-md-10">
                            <input class="form-control" name="client_desg" placeholder="Client Designation" type="text" value="{{old('client_desg')}}">
                        </div>
                        @if ($errors->first('client_desg'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('client_desg') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Client Comments</label>
                        <div class="col-md-10">
                            <textarea name="client_comments" class="form-control" rows="3" cols="" placeholder="Client Comments">{{old('client_comments')}}</textarea>
                        </div>
                        @if ($errors->first('client_comments'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('client_comments') }}</span>@endif
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
