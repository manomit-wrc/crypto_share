@extends('login_layout')
@section('content')
<div class="register register-with-news-feed">
            <!-- begin news-feed -->
    <div class="news-feed">
        <div class="news-image">
            <img src="storage/dashboard/assets/img/login-bg/bg-8.jpg" alt="" />
        </div>
        <div class="news-caption">
            <h4 class="caption-title"><i class="fa fa-edit text-success"></i> Announcing the Crypto Share app</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
        </div>
    </div>
    <!-- end news-feed -->
    <!-- begin right-content -->
    <div class="right-content">
        <!-- begin register-header -->
        <h1 class="register-header">
            Sign Up
            <small>Create your Crypto Share Account. It’s free and always will be.</small>
        </h1>
        @if (Session::has('message'))
            <div class="m-l-10 m-r-10"><br /><div class="alert alert-info" id="result7">{{ Session::get('message') }}</div></div>
        @endif
        @if (Session::has('error_message'))
            <div class="m-l-10 m-r-10"><br /><div class="alert alert-danger" id="result8">{{ Session::get('error_message') }}</div></div>
        @endif
        <!-- end register-header -->
        <!-- begin register-content -->
        <div class="register-content">
            <form action="/register/submit" method="POST" class="margin-bottom-0">
            {{csrf_field()}}
                <label class="control-label">Name <span class="text-danger">*</span></label>
                <div class="row row-space-10">
                    <div class="col-md-6 m-b-15 {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="{{ old('first_name')}}" />
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    </div>
                    <div class="col-md-6 m-b-15 {{ $errors->has('last_name') ? 'has-error' : '' }}">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="{{ old('last_name')}}" />
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    </div>
                </div>
                <label class="control-label">Email <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12 {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email address" value="{{ old('email')}}" />
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                
                <label class="control-label">Password <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12 {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{ old('password') }}"/>
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <label class="control-label">Re-enter password <span class="text-danger">*</span></label>
                <div class="row m-b-15">
                    <div class="col-md-12 {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password" value="{{ old('password') }}" />
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                    </div>
                </div>
                <div class="checkbox m-b-30">
                    <label>
                        <input type="checkbox" name="aggrement" id="aggrement" value="1" /> By clicking Sign Up, you agree to our <a href="javascript:void(0)">Terms</a> and that you have read our <a href="javascript:void(0)">Data Policy</a>, including our <a href="javascript:void(0)">Cookie Use</a>.
                        <span class="text-danger">{{ $errors->first('aggrement') }}</span>
                    </label>
                </div>
                <div class="register-buttons">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
                </div>
                <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                    Already a member? Click <a href="/login">here</a> to login.
                </div>
                <hr />
                <p class="text-center">
                    &copy; WRC Technologies All Right Reserved 2017
                </p>
            </form>
        </div>
        <!-- end register-content -->
    </div>
            <!-- end right-content -->
</div>
@stop