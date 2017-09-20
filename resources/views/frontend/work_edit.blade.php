@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li><a href="/work">Work</a></li>
            <li class="active">Edit</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Edit Existing Work</h1>

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            @if(Session::has('submit-status'))
                <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
            <div class="row">
                <form name="add_work" method="POST" action="/update_work" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="work_id" value="{{$work->id}}">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Title</label>
                        <div class="col-md-10">
                            <input class="form-control" name="title" placeholder="Title" type="text" value="{{ $work->title }}">
                        </div>
                        @if ($errors->first('title'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('title') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Description</label>
                        <div class="col-md-10">
                            <textarea name="description" class="form-control" rows="3" cols="" placeholder="Description">{{ $work->description }}</textarea>
                        </div>
                        @if ($errors->first('description'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('description') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Image</label>
                        <div class="col-md-10">
                            <input type="file" name="image" class="form-control" />
                        </div>
                        @if ($errors->first('image'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('image') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Status</label>
                        <div class="col-md-10">
                            <select class="form-control" name="status">
                                <option value="" disabled>Please Select</option>
                                <option value="1" @if($work->status == '1') selected @endif>Active</option>
                                <option value="0" @if($work->status == '0') selected @endif>In-Active</option>
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
