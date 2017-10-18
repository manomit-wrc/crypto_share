@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li class="active">Feedback</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Feedback Lists</h1>

        <!-- end page-header -->
        <div class="row">
            <!-- begin col-12 -->
		    <div class="col-md-12">
		        <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">&nbsp;</h4>
                    </div>
                    <div class="panel-body">
                        <div class="email-content">
                        <table class="table table-email">
                            <thead>
                                <tr>
                                    <th><span class="email-header-link">User</span></th>
                                    <th><span class="email-header-link">Message</span></th>
                                    <th><span class="email-header-link">Posted On</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($feedback_list) > 0)
                                    @foreach($feedback_list as $feedback)
                                    <tr>
                                        <td class="email-sender">@if($feedback['user_info']['image'] && file_exists(public_path() ."/upload/profile_image/resize/".$feedback['user_info']['image']))
                                        <img src="{{url('/upload/profile_image/resize/'.$feedback['user_info']['image'])}}" alt="{{$feedback['user_info']['first_name']}} {{$feedback['user_info']['last_name']}}" height="50" width="50" class="img-responsive">
                                        @else
                                        <img src="{{ url('upload/profile_image/default.png') }}" height="50" width="50" class="img-responsive">
                                        @endif
                                        {{$feedback['user_info']['first_name']}} {{$feedback['user_info']['last_name']}}</td>
                                        <td class="email-subject">{{$feedback['message']}}</td>
                                        <td class="email-date">{{date('jS M, Y'), strtotime($feedback['created_at'])}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr colspan="3">There is no feedback available till now.</tr>
                                @endif
                            </tbody>
                        </table>
                        @if(count($feedback_list) > 0)
                        <div class="email-footer clearfix">
                            {{count($feedback_list)}} messages
                        </div>
                        @endif
                    </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
    </div>
    <!-- end #content -->

<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
	
@endsection
