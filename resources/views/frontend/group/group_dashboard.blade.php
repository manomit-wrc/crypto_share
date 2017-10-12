@extends('dashboard_layout')
@section('content')
<style type="text/css">
	.carousel-inner.onebyone-carosel { margin: auto; width: 90%; }
	.onebyone-carosel .active.left { left: -33.33%; }
	.onebyone-carosel .active.right { left: 33.33%; }
	.onebyone-carosel .next { left: 33.33%; }
	.onebyone-carosel .prev { left: -33.33%; }
	.widget-stats .stats-info p { font-size: 20px; }
	.error { text-align: left; }
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

	@if(Session::has('submit-status'))
      	<p class="login-box-msg" style="color: green;">{{ Session::get('submit-status') }}</p>
    @endif

	<div class="row">
		<!-- begin col-8 -->
		<div class="col-md-8">
			<div class="span12">
                <div class="well">
                    <div id="myCarousel" class="carousel fdi-Carousel slide">
						<!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
                            	@if(count($fetch_latest_post_image) > 0)
                            		<?php $i=0; ?>
	                            	@foreach($fetch_latest_post_image as $key=>$value)
		                                <div class="item @if($i==0) active @endif">
		                                    <div class="col-md-4">
	                                        	<img class="img-responsive" src="{{ url('/upload/quick_post/resize/'.$value['post_image'])}}" alt="" />
		                                    </div>
		                                </div>
		                            <?php $i++; ?>
                                	@endforeach
                            	@else
                            		No post image as off now.
                            	@endif
                            </div>
                            @if(count($fetch_latest_post_image) > 0)
	                            <a class="left carousel-control" href="#eventCarousel" data-slide="prev"></a>
	                            <a class="right carousel-control" href="#eventCarousel" data-slide="next"></a>
                            @endif
                        </div>
                        <!--/carousel-inner-->
                    </div><!--/myCarousel-->
                </div><!--/well-->
            </div>
		</div>
		<!-- end col-8 -->
		<!-- begin col-4 -->
		<div class="col-md-4">
			<div class="row">
				<div class="col-sm-6">
					<!-- begin col-3 -->
					<div class="">
						<div class="widget widget-stats bg-green">
							<div class="stats-icon"><i class="fa fa-object-group"></i></div>
							<div class="stats-info">
								<h4>GROUP NAME</h4>
								<p>{{$fetch_group_details['group_name']}}</p>
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
							<div class="stats-icon"><i class="fa fa-user-secret"></i></div>
							<div class="stats-info">
								<h4>GROUP OWNER</h4>
								<p>{{$fetch_group_details['user_info']['first_name']}} {{$fetch_group_details['user_info']['last_name']}}</p>
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
								<h4>MEMBER(S)</h4>
								<p>{{$total_member_of_group}}</p>
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
							<div class="stats-icon"><i class="fa fa-thumbs-up"></i></div>
							<div class="stats-info">
								<h4>NO. OF VISITOR(S)</h4>
								<p>1,22,666</p>
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
		<!-- end col-4 -->
	</div>

	<div class="row">
		<div class="col-md-8">
			@if($group_status && $group_status[0]['status'] == "1" && $group_status[0]['read_status'] == "0")
				<a href="/group_transaction/{{$group_id}}"><button type="button" class="btn btn-primary m-b-5">Add New Transaction</button></a>
			@endif

			@if($fetch_group_details['user_id'] == Auth::guard('crypto')->user()->id)
				<a href="/group_transaction/{{$group_id}}"><button type="button" class="btn btn-primary m-b-5">Add New Transaction</button></a>
			@endif
		</div>
		<div class="col-md-4">
			@if($group_status && $group_status[0]['status'] == "2")
				<span style="font-size: 15px;">Invitation is pending</span></h1>
			@elseif($group_status && $group_status[0]['status'] == "1")
				<span style="font-size: 15px;">You are member of this group</span></h1>
			@elseif($fetch_group_details['user_id'] == Auth::guard('crypto')->user()->id)
				<span style="font-size: 15px;">You are admin of this group</span></h1>
			@else
				<span style="font-size: 15px;"><button type="button" class="btn btn-info m-r-5 m-b-5 open_join_group_modal" data-toggle="modal" data-target="#myModal" value="{{$fetch_group_details['id']}}" group_type="{{$fetch_group_details['group_type']}}">Join Group</button></span></h1>
			@endif
		</div>
	</div>

	<div class="row">
		<!-- begin col-8 -->
		<div class="col-md-8">
			<div class="panel panel-inverse" data-sortable-id="index-2">
				<div class="panel-heading">
					<h4 class="panel-title">Group Activities</h4>
				</div>
				<!-- <div class="panel-body">
					There is no user coin available for this group.
				</div> -->
				<div class="panel-body">
                    <div class="panel-group" id="accordion">
                    	<?php $i = 0; ?>
                    	@if (count($coin_user_info) > 0)
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
								<div id="{{$coin_user['coin_id']}}" class="panel-collapse collapse in" aria-expanded="true" style="border: 1px solid #ccc;">
									<div class="panel-body">
										<div class="col-md-1">
											<img class="" width="50" height="50" src="https://www.cryptocompare.com{{$coin_user['image_url']}}" alt="{{$coin_user['full_name']}}">
										</div>
										<div class="col-md-11">
										@foreach ($coin_user['user_info'] as $user_list)
											<div class="m-r-5 text-center" style="float: left; width: 15%;">
												@if($user_list['transaction_type'] == 1)
													{{$user_list['first_name']}} {{$user_list['last_name']}}<br />
													<i class="fa fa-anchor" aria-hidden="true"></i><br />
													{{$user_list['chip_value']}}
												@endif

												@if($user_list['transaction_type'] == 2)
													{{$user_list['first_name']}} {{$user_list['last_name']}}<br />
													<i class="fa fa-handshake-o" aria-hidden="true"></i><br />
													{{$user_list['chip_value']}}
												@endif

												@if($user_list['transaction_type'] == 3)
													{{$user_list['first_name']}} {{$user_list['last_name']}}<br />
													<i class="fa fa-eye" aria-hidden="true"></i><br />
												@endif
											</div>
										@endforeach
										</div>
									</div>
								</div>
							</div>
							<?php $i++; ?>
							@endforeach
						@else
							There is no user coin available for this group.
						@endif
					</div>
				</div>
			</div>

			{{-- //coin list view --}}
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
	                <h4 class="panel-title">Recent Transactions</h4>
	            </div>
				<div class="panel-body">
	                <table id="data-table_coin_list" class="table table-striped table-bordered data-table">
	                    <thead>
	                        <tr>
	                            <th>Coin Image/Name</th>
	                            <th>Tran Type</th>
	                            <th>User Name</th>
	                            <th style="text-align: right;">Amount</th>
	                            <th style="text-align: right;">Buy In</th>
	                            <th>Target 1</th>
	                            <th>Target 2</th>
	                            <th>Target 3</th>
	                            <th>Notes</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@if (count($fetch_coin_all_details) > 0)
		                    	@foreach ($fetch_coin_all_details as $key => $value)
		                        <tr class="odd">
		                            <td><img class="" width="50" height="50" src="https://www.cryptocompare.com{{$value['coinlists']['image_url']}}" alt="{{$value['coinlists']['coin_name']}}"><br />{{$value['coinlists']['coin_name']}}</td>
		                            <td style="text-align: center;">@if($value['transaction_type'] == 1) <i class="fa fa-anchor fa-2x"></i> @elseif($value['transaction_type'] == 2) <i class="fa fa-handshake-o fa-2x"></i> @else <i class="fa fa-eye fa-2x"></i> @endif</td>
		                            <td>{{$value['user_info']['first_name']}} {{$value['user_info']['last_name']}}</td>
		                            <td style="text-align: right;">{{$value['trade_price']}}</td>
		                            <td style="text-align: right;">{{$value['current_price']}}</td>
		                            <td>@if ($value['transaction_type'] == 2) {{$value['target_1']}} @endif</td>
		                            <td>@if ($value['transaction_type'] == 2) {{$value['target_2']}} @endif</td>
		                            <td>@if ($value['transaction_type'] == 2) {{$value['target_3']}} @endif</td>
		                            <td><a href="#modal-dialog{{$value['id']}}" class="btn btn-primary btn-xs" data-toggle="modal">Notes</a></td>
		                        </tr>
		                        <!-- #modal-dialog -->
								<div class="modal fade" id="modal-dialog{{$value['id']}}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title">{{$value['coinlists']['coin_name']}}</h4>
											</div>
											<div class="modal-body">
												{{$value['notes']}}
											</div>
											<div class="modal-footer">
												{{$value['user_info']['first_name']}} {{$value['user_info']['last_name']}}
												<!-- <a class="btn btn-sm btn-white" data-dismiss="modal">Close</a> -->
											</div>
										</div>
									</div>
								</div>
		                        @endforeach
		                    @else
		                    	<tr class="odd">
		                    		<td colspan="7">There is no user coin available for this group.</td>
		                    	</tr>
		                    @endif
	                    </tbody>
	                </table>
	            </div>
            </div>
			{{-- //end --}}

			<div class="latest">
				<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
					<li class="active"><a href="#latest-post" data-toggle="tab"><i class="fa fa-clipboard" aria-hidden="true"></i> <span class="hidden-xs">Latest Post</span></a></li>

					<li class=""><a href="#pinned_post" data-toggle="tab"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <span class="hidden-xs">Pinned Post</span></a></li>

					<li class=""><a href="#chat" data-toggle="tab"><i class="fa fa-comments" aria-hidden="true"></i> <span class="hidden-xs">Chat</span></a></li>
				</ul>
				<div class="tab-content" data-sortable-id="index-3">
					<div class="tab-pane fade active in" id="latest-post">
						<div class="height-sm" data-scrollbar="true">
							<ul class="media-list media-list-with-divider">
								@if(count($fetch_latest_post) > 0)
									@foreach($fetch_latest_post as $key => $value)
										<li class="media media-lg">
											<a href="javascript:;" class="pull-left">
												<img class="img-responsive" src="{{ url('/upload/quick_post/resize/'.$value['post_image'])}}" alt="" />
											</a>
											<div class="media-body">
												{{$value['post']}}
												<br> <span style="color:#07afee; margin-right: 10px"><strong>Posted by</strong>: {{ucwords($value['user_name']['first_name'].' '.$value['user_name']['last_name'])}}</span>
												<span style="color:#07afee;"> {{ $value['created_at']}}</span>
												@if(($group_status && $group_status[0]['status'] == "1" && $group_status[0]['read_status'] == "0") || ($fetch_group_details['user_id'] == Auth::guard('crypto')->user()->id)) 
												@if($value['status']!=1)
												<span class="pull-right m-r-15" title="Pinned Post"><a href="javascript:void(0)" style="color:#000000;"><i class="fa fa-thumb-tack pinned_post" aria-hidden="true" user_id="{{$value['id']}}"></i></a></span>
												@endif
												@endif
											</div>
										</li>
									@endforeach
								@else
									No post as off now.
								@endif
							</ul>
						</div>
					</div>
					<div class="tab-pane fade" id="pinned_post">
						<div class="height-sm" data-scrollbar="true">
							<ul class="media-list media-list-with-divider">
								@if(count($fetch_pinned_post) > 0)
									@foreach($fetch_pinned_post as $key => $value)
										<li class="media media-lg">
											<a href="javascript:;" class="pull-left">
												<img class="img-responsive" src="{{ url('/upload/quick_post/resize/'.$value['post_image'])}}" alt="" />
											</a>
											<div class="media-body">
												{{$value['post']}}
												<br> <span style="color:#07afee; margin-right: 10px"><strong>Posted by</strong>: {{ucwords($value['user_name']['first_name'].' '.$value['user_name']['last_name'])}}</span>
												<span style="color:#07afee;"> {{ $value['created_at']}}</span> 
											</div>
										</li>
									@endforeach
								@else
									No pinned post as off now. 
								@endif
							</ul>
						</div>
					</div>
					<div class="tab-pane fade" id="chat">
						<div class="height-sm" data-scrollbar="true">
							<ul class="media-list media-list-with-divider" id="message_list">
								@foreach($chatArray as $value)
								<li class="media media-sm">
									<a href="javascript:;" class="pull-left">
										<img src="{{$value['avatar']}}" alt="" class="media-object img-responsive img-circle" style="width: 40px; height: 40px;" />
									</a>
									<div class="media-body">
										<a href="javascript:;"><h4 class="media-heading">{{$value['username']}}</h4></a>
										<p class="m-b-5">
											{{$value['text']}}
										</p>
										<i class="text-muted">Posted on {{ Carbon\Carbon::parse($value['timestamp'])->format('d-m-Y h:i:s A') }}</i>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
						@if(($group_status && $group_status[0]['status'] == "1" && $group_status[0]['read_status'] == "0") || ($fetch_group_details['user_id'] == Auth::guard('crypto')->user()->id))
						<div class="input-group">
                            <input type="text" class="form-control input-sm" name="group_message" id="group_message" placeholder="Enter your message here.">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button" id="btn_message" name="btn_message">Send</button>
                            </span>
                        </div>
                        @endif
					</div>
				</div>
			</div>
		</div>
		<!-- end col-8 -->
		<!-- begin col-4 -->
		<div class="col-md-4">
			<div class="panel panel-inverse" data-sortable-id="index-4">
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

			<div class="panel panel-inverse" data-sortable-id="index-10">
				<div class="panel-heading">
					<h4 class="panel-title">Visitors User Agent</h4>
				</div>
				<div class="panel-body">
					<div id="donut-chart" class="height-sm"></div>
				</div>
			</div>

			<!-- begin panel -->
	        <div class="panel panel-inverse" data-sortable-id="index-11">
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
	            <div class="panel-footer text-center">
	                
	            </div>
	        </div>
	        <!-- end panel -->

	        @if (($group_status && $group_status[0]['status'] == "1") || ($fetch_group_details['user_id'] == Auth::guard('crypto')->user()->id))
		        <div class="panel panel-inverse" data-sortable-id="index-12">
	                <div class="panel-heading">
	                    <h4 class="panel-title">Feedback</h4>
	                </div>
	                @if ($fetch_group_details['user_id'] == Auth::guard('crypto')->user()->id)
	                	<div class="panel-body">
		                	@if (count($fetch_feedback_list) > 0)
		                		@foreach ($fetch_feedback_list as $fetch_feedback)
									<div class="note note-success">
										<h4>{{$fetch_feedback['user_info']['first_name']}} {{$fetch_feedback['user_info']['last_name']}}</h4>
										<p>
										    {{$fetch_feedback['message']}}
				                        </p>
									</div>
								@endforeach
							@else
								There is no feedback for this group till now.
							@endif
						</div>
	                @else
		                <div class="panel-body">
		                	@if (count($fetch_feedback) > 0)
								<div class="note note-success">
									<h4>{{$fetch_feedback[0]['user_info']['first_name']}} {{$fetch_feedback[0]['user_info']['last_name']}}</h4>
									<p>
									    {{$fetch_feedback[0]['message']}}
			                        </p>
								</div>
							@else
							<div id="no_feedback">
								<span class="txt">Please give your valuable feedback</span><br /><br />
								<a href="javascript:void(0);" onclick="show_feedback_form();" class="btn btn-info">Give Feedback</a>
							</div>
							<div id="feedback_form_div" style="display: none;">
								<form name="feedback_form" id="feedback_form" method="post" action="/group/feedback_submit">
									{{ csrf_field() }}
									<input type="hidden" name="group_id" value="{{$group_id}}">
									<textarea class="form-control" rows="3" name="feedback_msg" placeholder="Type your message here..."></textarea><br />
									<div class="text-right">
										<a href="javascript:void(0);" onclick="hide_form();" class="btn btn-sm btn-info" style="float: left;">Hide</a>
					                    <input class="btn btn-white btn-sm" type="reset" value="Cancel">
					                    <input class="btn btn-primary btn-sm m-l-5" id="feedback_form_submit" type="submit" name="submit" value="Submit">
					                </div>
					            </form>
							</div>
							@endif
		                </div>
		            @endif
	            </div>
	        @endif
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="post"> 
				@if(($group_status && $group_status[0]['status'] == "1" && $group_status[0]['read_status'] == "0") || ($fetch_group_details['user_id'] == Auth::guard('crypto')->user()->id))
					<div class="panel panel-inverse" data-sortable-id="index-8">
						<form name="quick_post_form" id="quick_post_form" method="post" action="/group/quick_post_submit/{{$group_id}}" enctype="multipart/form-data">
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
	            @endif
	        </div>
		</div>
	</div>
	<!-- end row -->
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Join Group</h4>
			</div>
			<div class="modal-body">
				<div class="panel-body">
					<form action="javascript:void(0)" id="join_group_form" name="join_group_form">
						<input type="hidden" name="user_id" id="append_group_id" value="{{$fetch_group_details['id']}}" group_type="{{$fetch_group_details['group_type']}}">
						<fieldset>
							<div class="form-group">
								<label for="exampleInputPassword1">Notes</label>
								<textarea style="height: 150px;" cols="" rows="" class="form-control" id="notes" name="notes"></textarea>
							</div>
						</fieldset>
						<div class="">
							<button type="submit" class="btn btn-success m-r-5 m-b-5" id="join_group_submit">Join</button>
							<button type="button" class="btn btn-success m-r-5 m-b-5" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script type="text/javascript">
    // Ensure CSRF token is sent with AJAX requests

    // Added Pusher logging
    Pusher.log = function(msg) {
        console.log(msg);
    };

    function init() {
        // send button click handling
        $('#group_message').keypress(function(e){
        	if (e.keyCode === 13) {
            	return sendMessage();
        	}	
        });
        $('#btn_message').click(sendMessage);

        if ($("#donut-chart").length !== 0) {
	        var e = [{
	            label: "DuxCoin",
	            data: 35,
	            color: purpleDark
	        }, {
	            label: "EquiTrader",
	            data: 50,
	            color: purple
	        }, {
	            label: "F16Coin",
	            data: 15,
	            color: purpleLight
	        }, {
	            label: "HamsterCoin",
	            data: 10,
	            color: blue
	        }, {
	            label: "QTUM",
	            data: 5,
	            color: blueDark
	        }];
	        $.plot("#donut-chart", e, {
	            series: {
	                pie: {
	                    innerRadius: .5,
	                    show: true,
	                    label: {
	                        show: true
	                    }
	                }
	            },
	            legend: {
	                show: true
	            }
	        })
	    }
    }

    // Send on enter/return key
    function checkSend(e) {   
        
    }

    // Handle the send button being clicked
    function sendMessage() {
        var messageText = $('#group_message').val();
        if(messageText.length < 3) {
            return false;
        }

        // Build POST data and make AJAX request
        var data = {chat_text: messageText, _token: "{{ csrf_token() }}", group_id: "{{$group_id}}"};
        $.post('/chat/message', data).success(sendMessageSuccess);

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function sendMessageSuccess() {
        $('#group_message').val('')
        console.log('message sent successfully');
    }

    // Build the UI for a new message and add to the DOM
    function addMessage(data) {
        
        $("#message_list").append('<li class="media media-sm"><a href="javascript:;" class="pull-left"><img src="'+data.avatar+'" alt="" class="media-object rounded-corner" /></a><div class="media-body"><a href="javascript:;"><h4 class="media-heading">'+data.username+'</h4></a><p class="m-b-5">'+data.text+'</p><i class="text-muted">Posted on '+strftime('%d-%m-%Y %H:%M:%S %p', new Date(data.timestamp))+'</i></div></li>');

        $("#message_list").scrollTop($("#message_list").scrollHeight);
    }

    // Creates an activity element from the template
    function createMessageEl() {
        var text = $('#chat_message_template').text();
        var el = $(text);
        return el;
    }

    $(init);

    /***********************************************/

    var pusher = new Pusher('397f69f15f677e2fd465', {
              cluster: 'ap2',
              encrypted: true
    });

    var channel = pusher.subscribe('{{$chatChannel}}');
    channel.bind('new-message', addMessage);

    function show_feedback_form() {
    	$('#no_feedback').css('display', 'none');
    	$('#feedback_form_div').css('display', 'block');
    }

    function hide_form() {
    	$('#no_feedback').css('display', 'block');
    	$('#feedback_form_div').css('display', 'none');
    }

</script>
@stop
