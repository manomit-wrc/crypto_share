@extends('welcome')
@section('content')
<!-- begin #home -->
<div id="home" class="content has-bg home">
    <!-- begin content-bg -->
    <div class="content-bg">
        <img src="storage/frontend/assets/img/home-bg.jpg" alt="Home" />
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container home-content">
        <h1>Welcome to Crypto Share</h1>
        <h3>Multipurpose One Page Theme</h3>
        <p>
            We have created a multi-purpose theme that take the form of One-Page or Multi-Page Version.<br />
            Use our <a href="#">theme panel</a> to select your favorite theme color.
        </p>
        <a href="/explore" class="btn btn-theme">Explore Group</a> 
        @if(Auth::guard('crypto')->check())
            <a href="/dashboard" class="btn btn-outline">Dashboard</a>
        @else
            <a href="/login" class="btn btn-outline">&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;</a>
        @endif
    </div>
    <!-- end container -->
</div>
<!-- end #home -->
@stop