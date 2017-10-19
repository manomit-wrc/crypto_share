@extends('dashboard_layout')
@section('content')
<style type="text/css">
	.error { text-align: left; }
	#feedback_msg-error { width: 100%; text-align: center; }
</style>
<div id="content" class="content">
	<!-- begin page-header -->
	<h1 class="text-center">Welcome to Crypt Shares</h1>
	<h3 class="text-center">Please report any feedback/issues here.</h3>
	<h4 class="text-center">The site is currently in development and your feedback is HIGHLY appreciated.</h4>
	<!-- end page-header -->
	<hr />
	<!-- begin row -->
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h4 class="text-center m-b-10">Feedback Form</h4>
			<form name="feedback_form" id="feedback_form" method="post" action="/feedback_submit">
				{{ csrf_field() }}
				<textarea class="form-control" rows="3" name="feedback_msg" placeholder="Type your message here..."></textarea><br />
				<div class="text-center">
                    <input class="btn btn-info" type="reset" value="Cancel" />
                    <input class="btn btn-primary m-l-5" type="submit" name="submit" value="Submit" />
                </div>
            </form>
		</div>
		<div class="col-md-12 text-center m-t-10">
			@if(Session::has('success-status'))
		      	<h3 style="color: green;">{{ Session::get('success-status') }}</h3>
		    @endif
		</div>
		<div class="col-md-12 text-center m-t-10">
			@if(Session::has('error-status'))
		      	<h3 style="color: red;">{{ Session::get('error-status') }}</h3>
		    @endif
		</div>
	</div>
	<!-- end row -->
</div>
@stop