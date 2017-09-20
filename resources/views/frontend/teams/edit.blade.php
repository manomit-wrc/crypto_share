@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/teams">Teams</a></li>
            <li class="active">Edit</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        

        <!-- end page-header -->
        <!-- begin profile-container -->
        <div class="profile-container">
            @if(Session::has('submit-status'))
                <p class="login-box-msg" style="color: red;">{{ Session::get('submit-status') }}</p>
            @endif
            <div class="row">
                <form name="frmTeams" method="POST" action="/teams/{{ $team->id }}" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-2 control-label">First Name</label>
                        <div class="col-md-10">
                            <input class="form-control" name="first_name" id="first_name" placeholder="First Name" type="text" value="{{ $team->first_name }}">
                        </div>
                        @if ($errors->first('first_name'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('first_name') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Last Name</label>
                        <div class="col-md-10">
                            <input class="form-control" name="last_name" id="last_name" placeholder="Last Name" type="text" value="{{ $team->last_name }}">
                        </div>
                        @if ($errors->first('last_name'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('last_name') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Designation</label>
                        <div class="col-md-10">
                            <input class="form-control" name="designation" id="designation" placeholder="Designation" type="text" value="{{ $team->designation }}">
                        </div>
                        @if ($errors->first('designation'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('designation') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Description</label>
                        <div class="col-md-10">
                            <textarea name="description" class="form-control" rows="3" cols="" placeholder="Description">{{ $team->description }}</textarea>
                        </div>
                        @if ($errors->first('description'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('description') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Image</label>
                        <div class="col-md-10">
                            <input type="file" name="image" id="image" class="form-control">
                            
                            @if($team->image && file_exists(public_path() ."/upload/teams/".$team->image))
                                <img src="{{ url('upload/teams/'.$team->image) }}" height="100" width="100" class="img-responsive">
                            @else
                                <img src="{{ url('upload/teams/default.png') }}" height="100" width="100" class="img-responsive">
                            @endif
                        </div>
                        @if ($errors->first('image'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('image') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Facebook Url</label>
                        <div class="col-md-10">
                            <input class="form-control" name="facebook_url" id="facebook_url" placeholder="Facebook URL" type="text" value="{{ $team->facebook_url }}">
                        </div>
                        @if ($errors->first('facebook_url'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('facebook_url') }}</span>@endif
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Twitter Url</label>
                        <div class="col-md-10">
                            <input class="form-control" name="twitter_url" id="twitter_url" placeholder="Twitter URL" type="text" value="{{ $team->twitter_url }}">
                        </div>
                        @if ($errors->first('twitter_url'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('twitter_url') }}</span>@endif
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">G+ Url</label>
                        <div class="col-md-10">
                            <input class="form-control" name="google_plus_url" id="google_plus_url" placeholder="Google Plus URL" type="text" value="{{ $team->google_plus_url }}">
                        </div>
                        @if ($errors->first('google_plus_url'))<span class="input-group col-md-offset-2 text-danger">{{ $errors->first('google_plus_url') }}</span>@endif
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            {{-- <button type="reset" class="btn btn-sm btn-default">Cancel</button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end profile-container -->
    </div>
    <!-- end #content -->
@endsection