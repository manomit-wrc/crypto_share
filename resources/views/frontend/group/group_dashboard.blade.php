@extends('dashboard_layout')
@section('content')
<style type="text/css">
	.carousel-inner.onebyone-carosel { margin: auto; width: 90%; }
	.onebyone-carosel .active.left { left: -33.33%; }
	.onebyone-carosel .active.right { left: 33.33%; }
	.onebyone-carosel .next { left: 33.33%; }
	.onebyone-carosel .prev { left: -33.33%; }
</style>
<script type="text/javascript">
	$(document).ready(function () {
	    $('#myCarousel').carousel({
	        interval: 10000
	    })
	    $('.fdi-Carousel .item').each(function () {
	        var next = $(this).next();
	        if (!next.length) {
	            next = $(this).siblings(':first');
	        }
	        next.children(':first-child').clone().appendTo($(this));

	        if (next.next().length > 0) {
	            next.next().children(':first-child').clone().appendTo($(this));
	        }
	        else {
	            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
	        }
	    });
	});
</script>
<div id="content" class="content">

	<!-- begin page-header -->
	<h1 class="page-header text-center">{{$group_name}} <br><small>Members: {{$total_member_of_group}}</small> <br> <span style="font-size: 15px;">Join this group</span></h1>
			<!-- end page-header -->

	@if(Session::has('submit-status'))
      	<p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
    @endif
			<!-- begin row -->

	<div class="row">
		<!-- begin col-8 -->
		<div class="col-md-8">
			<div class="span12">
                <div class="well">
                    <div id="myCarousel" class="carousel fdi-Carousel slide">
                     <!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
                                <div class="item active">
                                    <div class="col-md-4">
                                    	@foreach($fetch_latest_post_image as $key=>$value)

                                        	<img class="img-responsive" src="{{ url('/upload/quick_post/resize/'.$value['post_image'])}}" alt="" />

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#eventCarousel" data-slide="prev"></a>
                            <a class="right carousel-control" href="#eventCarousel" data-slide="next"></a>
                        </div>
                        <!--/carousel-inner-->
                    </div><!--/myCarousel-->
                </div><!--/well-->
            </div>
		</div>
		<!-- end col-8 -->
		<div class="col-md-4">
			<div class="row">
				<div class="col-sm-6">
					<!-- begin col-3 -->
					<div class="">
						<div class="widget widget-stats bg-green">
							<div class="stats-icon"><i class="fa fa-desktop"></i></div>
							<div class="stats-info">
								<h4>TOTAL VISITORS</h4>
								<p>3,291,922</p>	
							</div>
							<!-- <div class="stats-link">
								<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
							</div> -->
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="">
						<div class="widget widget-stats bg-blue">
							<div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
							<div class="stats-info">
								<h4>BOUNCE RATE</h4>
								<p>20.44%</p>	
							</div>
							<!-- <div class="stats-link">
								<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
							</div> -->
						</div>
					</div>
					<!-- end col-3 -->
				</div>
				<div class="col-sm-6">
					<!-- begin col-3 -->
					<div class="">
						<div class="widget widget-stats bg-purple">
							<div class="stats-icon"><i class="fa fa-users"></i></div>
							<div class="stats-info">
								<h4>UNIQUE VISITORS</h4>
								<p>1,291,922</p>	
							</div>
							<!-- <div class="stats-link">
								<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
							</div> -->
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="">
						<div class="widget widget-stats bg-red">
							<div class="stats-icon"><i class="fa fa-clock-o"></i></div>
							<div class="stats-info">
								<h4>AVG TIME ON SITE</h4>
								<p>00:12:23</p>	
							</div>
							<!-- <div class="stats-link">
								<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
							</div> -->
						</div>
					</div>
					<!-- end col-3 -->
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<a href="/transaction/add/{{base64_encode($group_id)}}"><button type="button" class="btn btn-primary m-b-5">Add New Transaction</button></a>
		</div>
		<!-- begin col-8 -->
		<div class="col-md-8">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Coin Lists & User Activities</h4>
				</div>
				<!-- <div class="panel-body">
					There is no user coin available for this group.
				</div> -->
				<div class="panel-body">
                    <div class="panel-group" id="accordion">
                    	<?php $i = 0; ?>
                    	@foreach ($coin_user_info as $coin_user)
						<div class="panel panel-info panel-inverse overflow-hidden">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#{{$coin_user['coin_id']}}" aria-expanded="true">
									    <i class="fa fa-plus-circle pull-right"></i> 
										{{$coin_user['full_name']}}
									</a>
								</h3>
							</div>
							<div id="{{$coin_user['coin_id']}}" class="panel-collapse collapse @if($i == 0) in @endif" @if($i == 0) aria-expanded="true" @endif style="border: 1px solid #ccc;">
								<div class="panel-body">
									<div class="col-md-1 m-r-5">
										<img class="" width="50" height="50" src="https://www.cryptocompare.com{{$coin_user['image_url']}}" alt="{{$coin_user['full_name']}}">
									</div>
									<div class="col-md-10">
									@foreach ($coin_user['user_info'] as $user_list)
										<div class="m-r-5" style="float: left; width: 15%;">
											{{$user_list['first_name']}} {{$user_list['last_name']}}<br />
											<i class="fa fa-anchor fa-3x"></i><br />
											{{$user_list['qty']}}
										</div>
									@endforeach
									</div>
								</div>
							</div>
						</div>
						<?php $i++; ?>
						@endforeach
					</div>
				</div>
			</div>
			
			<div class="">
				<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
					<li class="active"><a href="#latest-post" data-toggle="tab"><i class="fa fa-clipboard" aria-hidden="true"></i> <span class="hidden-xs">Latest Post</span></a></li>

					<li class=""><a href="#pinned_post" data-toggle="tab"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <span class="hidden-xs">Pinned Post</span></a></li>

					<li class=""><a href="#chat" data-toggle="tab"><i class="fa fa-comments" aria-hidden="true"></i> <span class="hidden-xs">Chat</span></a></li>
				</ul>

				<div class="tab-content" data-sortable-id="index-3">
					<div class="tab-pane fade active in" id="latest-post">
						<div class="height-sm" data-scrollbar="true">
							<ul class="media-list media-list-with-divider">
							@foreach($fetch_latest_post as $key => $value)

								<li class="media media-lg">
									<a href="javascript:;" class="pull-left">

										<img class="img-responsive" src="{{ url('/upload/quick_post/resize/'.$value['post_image'])}}" alt="" />
									</a>
									<div class="media-body">
										{{$value['post']}}
										<br> <span style="color:#07afee; margin-right: 10px"><strong>Posted by</strong>: {{ucwords($value['user_name']['first_name'].' '.$value['user_name']['last_name'])}}  </span><span style="color:#07afee;"> {{ $value['created_at']}}</span> <span class="pull-right m-r-15" title="Pinned Post"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span>
									</div>
								</li>

							@endforeach
							</ul>
						</div>
					</div>
					<div class="tab-pane fade" id="pinned_post">
						<div class="height-sm" data-scrollbar="true">

						</div>
					</div>
					<div class="tab-pane fade" id="chat">
						<div class="height-sm" data-scrollbar="true">
						</div>
					</div>
				</div>
				
				<div class="panel panel-inverse" data-sortable-id="index-4">
					<form name="quick_post_form" id="quick_post_form" method="post" action="/group/quick_post_submit/{{base64_encode($group_id)}}" enctype="multipart/form-data">
					{{ csrf_field() }}

		                <div class="panel-heading">
		                    <h4 class="panel-title">Quick Post</h4>
		                </div>
		                <div class="panel-toolbar">
		                    <div class="btn-group m-r-5">
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-bold"></i></a>
								<a class="btn btn-white active" href="javascript:;"><i class="fa fa-italic"></i></a>
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-underline"></i></a>
							</div>
		                    <div class="btn-group">
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-align-left"></i></a>
								<a class="btn btn-white active" href="javascript:;"><i class="fa fa-align-center"></i></a>
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-align-right"></i></a>
								<a class="btn btn-white" href="javascript:;"><i class="fa fa-align-justify"></i></a>
							</div>
		                </div>
		                
		                <textarea class="form-control no-rounded-corner bg-silver" rows="14" name="quick_post"></textarea>

		                <input class="form-control no-rounded-corner bg-silver" type="file" name="quick_post_image" id="quick_post_image">

		                <div class="panel-footer text-right">

		                    <input class="btn btn-white btn-sm" type="reset" value="Cancel">
		                    <input class="btn btn-primary btn-sm m-l-5" id="quick_post_form_submit" type="submit" name="submit" value="Post">
		                   
		                </div>
	                </form>
	            </div>
	        </div>
		</div>
		<!-- end col-8 -->
		<!-- begin col-4 -->
		<div class="col-md-4">
			<div class="panel panel-inverse" data-sortable-id="index-6">
				<div class="panel-heading">
					<h4 class="panel-title">Analytics Details</h4>
				</div>
				<div class="panel-body p-t-0">
					<table class="table table-valign-middle m-b-0">
						<thead>
							<tr>	
								<th>Source</th>
								<th>Total</th>
								<th>Trend</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><label class="label label-danger">Unique Visitor</label></td>
								<td>13,203 <span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
								<td><div id="sparkline-unique-visitor"></div></td>
							</tr>
							<tr>
								<td><label class="label label-warning">Bounce Rate</label></td>
								<td>28.2%</td>
								<td><div id="sparkline-bounce-rate"></div></td>
							</tr>
							<tr>
								<td><label class="label label-success">Total Page Views</label></td>
								<td>1,230,030</td>
								<td><div id="sparkline-total-page-views"></div></td>
							</tr>
							<tr>
								<td><label class="label label-primary">Avg Time On Site</label></td>
								<td>00:03:45</td>
								<td><div id="sparkline-avg-time-on-site"></div></td>
							</tr>
							<tr>
								<td><label class="label label-default">% New Visits</label></td>
								<td>40.5%</td>
								<td><div id="sparkline-new-visits"></div></td>
							</tr>
							<tr>
								<td><label class="label label-inverse">Return Visitors</label></td>
								<td>73.4%</td>
								<td><div id="sparkline-return-visitors"></div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="panel panel-inverse" data-sortable-id="index-7">
				<div class="panel-heading">
					<h4 class="panel-title">Visitors User Agent</h4>
				</div>
				<div class="panel-body">
					<div id="donut-chart" class="height-sm"></div>
				</div>
			</div>
			
		</div>
		<!-- end col-4 -->
		<div class="col-md-4">
	        <!-- begin panel -->
	        <div class="panel panel-inverse">
	            <div class="panel-heading">
	                <h4 class="panel-title">Group Members</h4>
	            </div>
                <ul class="registered-users-list clearfix">
                	@if(count($fetch_user_details))
	                	@foreach ($fetch_user_details as $key => $value)
		                    <li>
		                    	@if(!empty($value['image']))

									<a href="javascript:;"><img src="{{url('upload/profile_image/resize/'.$value['image'])}}" style="height: 50px;" alt="User profile picture" /></a>
		                    		
	                    		@else

	                    			<a href="javascript:;"><img src="{{ url('/upload/profile_image/default.png')}}" style="height: 50px;" alt="User profile picture"></a>

		                    	@endif
		                        
		                        <h4 class="username text-ellipsis">
		                            {{$value['first_name'].' '.$value['last_name']}}
		                        </h4>
		                    </li>
	                    @endforeach

                    @else
                    	No members as off now.

                	@endif
                </ul>
	            {{-- <div class="panel-footer text-center">
	                <a href="javascript:;" class="text-inverse">View All</a>
	            </div> --}}
	            <div class="panel-footer text-center">
	                
	            </div>
	        </div>
	        <!-- end panel -->
	    </div>
	</div>
			<!-- end row -->
</div>
@stop