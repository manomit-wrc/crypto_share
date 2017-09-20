@extends('dashboard_layout')
<!-- end #header -->

<!-- begin #sidebar -->
@section('content')

	<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="/dashboard">Home</a></li>
            <li class="active">Pricing</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Pricing Lists</h1>

        <!-- end page-header -->
        <div class="row">
        	@if(Session::has('submit-status'))
                <div class="alert alert-success">{{ Session::get('submit-status') }}</div>
            @endif
            <!-- begin col-12 -->
		    <div class="col-md-12">
                <div class="pull-right">
                    <a href="/pricing/add"><button type="button" class="btn btn-success m-b-5"><i class="fa fa-plus"></i> Add</button></a>
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
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Storage</th>
                                    <th>Clients</th>
                                    <th>Active Projects</th>
                                    <th>Colors</th>
                                    <th>Goodies</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th style="text-align: right; width: 8%;">Action</th>
                                </tr>
                            </thead>
                            <tbody><!--  class="even" -->
                            	@foreach ($all_pricing AS $pricing)
                                <tr class="odd">
                                    <td>{{$pricing->pricing_title}}</td>
                                    <td>{{$pricing->pricing_amount}}</td>
                                    <td>{{$pricing->storage}}</td>
                                    <td>{{$pricing->no_of_clients}}</td>
                                    <td>{{$pricing->active_projects}}</td>
                                    <td>{{$pricing->colors}}</td>
                                    <td>{{$pricing->goodies}}</td>
                                    <td>@if($pricing->status == '1') Active @else In-Active @endif</td>
                                    <td>{{$pricing->created_at->format('jS M, Y')}}</td>
                                    <td style="text-align: right;"><a href="/pricing/edit/{{$pricing->id}}" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-pencil"></i></a><a href="/pricing/delete/{{$pricing->id}}" onclick="return confirm('Do you really want to delete the current record ?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
