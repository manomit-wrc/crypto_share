@extends('login_layout')
@section('content')
<div class="login login-with-news-feed">
            <!-- begin news-feed -->
    <div class="news-feed">
        <div class="news-image">
            <img src="storage/dashboard/assets/img/login-bg/bg-7.jpg" data-id="login-cover-image" alt="" />
        </div>
        <div class="news-caption">
            <h4 class="caption-title"><i class="fa fa-diamond text-success"></i> Announcing the Crypto Share app</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
        </div>
    </div>
    <!-- end news-feed -->
    <!-- begin right-content -->
    <div class="right-content">
        <!-- begin login-header -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> Crypto Share
                <small>Lorem ipsum dolor sit amet</small>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
        </div>
        <!-- end login-header -->
        <!-- begin login-content -->
        @if (Session::has('login-status'))
            <div class="m-l-10 m-r-10"><br /><div class="alert alert-info" id="result7">{{ Session::get('login-status') }}</div></div>
        @endif
        <div class="login-content">
            <form action="/login/submit" method="POST" class="margin-bottom-0">
            {{csrf_field()}}
                <div class="form-group m-b-15 {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email Address" />
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group m-b-15 {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" />
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
                <div class="checkbox m-b-30">
                    <label>
                        <input type="checkbox" name="remember" id="remember" /> Remember Me
                    </label>
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                </div>
                <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                    Not a member yet? Click <a href="/register" class="text-success">here</a> to register.
                </div>
                <hr />
                <p class="text-center">
                    &copy; WRC Technologies All Right Reserved 2017
                </p>
            </form>
        </div>
        <!-- end login-content -->
    </div>
            <!-- end right-container -->
</div>
@stop