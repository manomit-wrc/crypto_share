<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<div class="image">
					<?php if(empty(Auth::guard('crypto')->user()->image)){?>
			            <img class="profile-user-img img-responsive img-circle sidebar_image_preview" src="{{ url('/upload/profile_image/default.png')}}" alt="User profile picture">
		          	<?php }else{?>
			            <a href="javascript:;"><img class="sidebar_image_preview" src="{{url('upload/profile_image/resize/'.Auth::guard('crypto')->user()->image)}}" alt="" /></a>
		          	<?php } ?>

				</div>
				<div class="info">
					{{Auth::guard('crypto')->user()->first_name}} {{Auth::guard('crypto')->user()->last_name}}
					<small>Front end developer</small>
				</div>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			
			<li class="has-sub {{ (Request::is('dashboard') ? 'active' : '') }}">
				<a href="/dashboard">
				    <span>Home</span>
			    </a>
			</li>

			@if(Auth::guard('crypto')->user()->role_code == 'SITEADM')

				<li class="has-sub {{ (Request::segment(1) === 'view-settings' ? 'active' : '')}}">
					<a href="/view-settings">
						<span>Organization</span>
					</a>
				</li>
				<li class="has-sub {{(Request::segment(1) === 'testimonial' ? 'active' : '' )}}">
					<a href="/testimonial">
						<span>Testimonial</span>
					</a>
				</li>
				<li class="has-sub {{(Request::segment(1) === 'pricing' ? 'active' : '' )}}">
					<a href="/pricing">
						<span>Pricing</span>
					</a>
				</li>
				<li class="has-sub {{(Request::segment(1) === 'users' ? 'active' : '' )}}">
					<a href="/users">
						<span>User Lists</span>
					</a>
				</li>
				<li class="has-sub {{(Request::segment(1) === 'work' ? 'active' : '' )}}">
					<a href="/work">
						<span>Work</span>
					</a>
				</li>
				<li class="has-sub {{(Request::segment(1) === 'teams' ? 'active' : '' )}}">
					<a href="/teams">
						<span>Team</span>
					</a>
				</li>
			
			@endif

			@if(Auth::guard('crypto')->user()->role_code == 'SITEUSR')

				<li class="has-sub {{(Request::segment(1) === 'group' ? 'active' : '')}}">
					<a href="/group">
						<span>Group</span>
					</a>
					<ul class="sub-menu">
						@foreach($fetch_user_group as $fetch_user_group_list)
							<li class="{{(Request::segment(3) === base64_encode($fetch_user_group_list['groups']['id']) ? 'active' : '' || Request::segment(4) === base64_encode($fetch_user_group_list['groups']['id']) ? 'active' : '')}}">

								<a href="/group/dashboard/{{base64_encode($fetch_user_group_list['groups']['id'])}}">
									<span>{{$fetch_user_group_list['groups']['group_name']}}</span>
								</a>

							</li>
						@endforeach

					</ul>
				</li>

				<li class="has-sub {{ (Request::segment(1) === 'my-post' ? 'active' : '')}}">
					<a href="/my-post">
						<span>My Post</span>
					</a>
				</li>
				
			@endif

	        <!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
	        <!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
			<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>