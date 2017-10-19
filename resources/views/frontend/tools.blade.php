@extends('dashboard_layout')
<!-- end #header -->
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li><a href="/dashboard">Home</a></li>
			<li class="active">Tools</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">Tools</h1>
		<!-- end page-header -->
		
		@if(Session::has('submit-status'))
          <p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
        @endif

		<!-- begin row -->
		<div class="row">
            <!-- begin col-6 -->
		    <div class="col-md-12">
		        <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        <h4 class="panel-title">Tools</h4>
                    </div>
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" name="tools_form" id="tools_form" method="POST" action="/edit_tools">
                        {{ csrf_field() }}
							<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
								<label class="control-label col-md-4 col-sm-4" for="email">Message :</label>
								<div class="col-md-6 col-sm-6">
									<textarea class="form-control" id="message" name="message" placeholder="Message" data-parsley-required="true">@if($fetch_details) {{$fetch_details[0]['message']}} @endif</textarea>
									<span class="text-danger">{{ $errors->first('message') }}</span>
									<script>
										CKEDITOR.replace( 'message', {
											uiColor: '#9AB8F3'
										} );
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-primary">Submit</button>
									<input class="btn btn-info m-l-5" type="reset" value="Cancel" />
								</div>
							</div>
                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>
        <!-- end row -->
	</div>

@endsection