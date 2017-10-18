@extends('welcome')
@section('content')
<style type="text/css">
    .modal-title { color: #666 !important; }
</style>
<!-- begin #home -->
<div id="home" class="content has-bg home">
    <!-- begin content-bg -->
    <div class="content-bg">
        <img src="storage/frontend/assets/img/home-bg.jpg" alt="Home" />
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container home-content">
        <img src="storage/frontend/assets/img/logo.png" alt="CryptShares" width="" height="200" />
        <a href="/explore" class="btn btn-theme">Explore Groups</a> 
        @if(Auth::guard('crypto')->check() && Auth::guard('crypto')->user()->status === "1")
            <a href="/dashboard" class="btn btn-outline">Dashboard</a>
        @else
            <a href="javascript:void(0);" class="btn btn-outline" id="btn_login" data-toggle="modal">&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;</a>
        @endif
    </div>
    <!-- end container -->
    <div class="modal fade" id="login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">CryptShares Sign in</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="result7" style="display: none;"></div>
                    <form name="login_form" id="login_form" action="javascript:void(0);" method="POST">
                    {{csrf_field()}}
                        <div class="form-group m-b-15">
                            <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email Address" />
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" />
                        </div>
                        <div class="checkbox m-b-10">
                            <label>
                                <input type="checkbox" name="remember" id="remember" /> Remember Me
                            </label>
                        </div>
                        <div class="login-buttons">
                            <button type="button" class="btn btn-success btn-block btn-lg" id="login_submit">Sign me in</button>
                        </div>
                        <div class="m-t-20 m-b-20 text-inverse">
                            Not a member yet? Click <a href="javascript:void(0);" id="link_register" class="text-success" data-toggle="modal">here</a> to register.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="register">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">CryptShares Sign Up</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info" id="result5" style="display: none;"></div>
                    <div class="alert alert-danger" id="result6" style="display: none;"></div>
                    <form name="register_form" id="register_form" action="javascript:void(0);" method="POST">
                    {{csrf_field()}}
                        <label class="control-label">Name <span class="text-danger">*</span></label>
                        <div class="row row-space-10">
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" />
                            </div>
                            <div class="col-md-6 m-b-15">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" />
                            </div>
                        </div>
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="reg_email" id="reg_email" placeholder="Email address" />
                            </div>
                        </div>
                        
                        <label class="control-label">Password <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="reg_password" id="reg_password" placeholder="Password" />
                            </div>
                        </div>
                        <label class="control-label">Re-enter password <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="checkbox m-b-10">
                            <label>
                                <input type="checkbox" name="aggrement" id="aggrement" value="1" /> By clicking Sign Up, you agree to our <a href="javascript:void(0)">Terms</a> and that you have read our <a href="javascript:void(0)">Data Policy</a>, including our <a href="javascript:void(0)">Cookie Use</a>.
                            </label>
                        </div>
                        <div class="register-buttons">
                            <button type="button" class="btn btn-primary btn-block btn-lg" id="register_submit">Sign Up</button>
                        </div>
                        <div class="m-t-20 m-b-20 text-inverse">
                            Already a member? Click <a href="javascript:void(0);" id="link_login" data-toggle="modal">here</a> to login.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end #home -->
@stop