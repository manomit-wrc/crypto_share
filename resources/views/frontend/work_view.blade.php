@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li class="active">Work</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Work Gallery</h1>

        <!-- end page-header -->
    	@if(Session::has('submit-status'))
            <div class="alert alert-success">{{ Session::get('submit-status') }}</div>
        @endif

        <div class="pull-right">
            <a href="/work/add"><button type="button" class="btn btn-success m-b-5"><i class="fa fa-plus"></i> Add</button></a>
        </div>
        <div style="clear: both;"></div>
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">&nbsp;</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th style="text-align: right; width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody><!--  class="even" -->
                        @foreach($all_work AS $work)
                        <tr class="odd">
                            <td><img src="{{url('/upload/work_image/resize/'.$work->image)}}" alt="{{$work->title}}" width="50" height="50" /></td>
                            <td>{{$work->title}}</td>
                            <td>{{$work->description}}</td>
                            <td>@if($work->status == '1') Active @else In-Active @endif</td>
                            <td style="text-align: right;"><a href="/work/edit/{{$work->id}}" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-pencil"></i></a><a href="/work/delete/{{$work->id}}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end #content -->

<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
	
@endsection
