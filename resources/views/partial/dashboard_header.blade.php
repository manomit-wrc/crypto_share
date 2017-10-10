<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
			<a href="/dashboard" class="navbar-brand"><span class="navbar-logo"></span> Crypto Share</a>
			<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<!-- end mobile sidebar expand / collapse button -->
		
		<!-- begin header navigation right -->
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="/" target="_blank"><i class="fa fa-globe"></i> View Site</a>
			</li>
			{{-- //use for notification// --}}
			<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							@if((Auth::guard('crypto')->user()->role_code != 'SITEADM'))
								<span class="label">{{$total_record}}</span>
							@endif
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
							@if(Auth::guard('crypto')->user()->role_code != 'SITEADM')
								<li class="dropdown-header">Notifications ({{$total_record}})</li>
								@foreach($details as $key=>$value)

									<li class="media">
		                                <a href="/group/pending-request/{{$value['id']}}">
		                                    <div class="media-left">
		                                    	<?php if(empty($value['user_image'])){?>
							                        <img class="media-object" src="{{ url('/upload/profile_image/default.png')}}" alt="User profile picture">
							                    <?php }else{?>
							                        <img class="media-object" src="{{url('upload/profile_image/resize/'.$value['user_image'])}}" alt="" />
							                    <?php } ?>
	                                    	</div>
		                                    <div class="media-body">
		                                        <h6 class="media-heading">{{$value['sent_invitation_user_name']}}</h6>

		                                        <div class="text-muted f-s-11">sent you a group request.</div>
		                                    </div>
		                                </a>
		                            </li>

                            	@endforeach
							@endif
                            
                            
						</ul>
					</li>
			{{-- //end// --}}
			<li class="dropdown navbar-user">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

                    <?php if(empty(Auth::guard('crypto')->user()->image)){?>
                        <img class="profile-user-img img-responsive img-circle header_image_preview" src="{{ url('/upload/profile_image/default.png')}}" alt="User profile picture">
                    <?php }else{?>
                        <img class="header_image_preview" src="{{url('upload/profile_image/resize/'.Auth::guard('crypto')->user()->image)}}" alt="" />
                    <?php } ?>

					<span class="hidden-xs">{{Auth::guard('crypto')->user()->first_name}} {{Auth::guard('crypto')->user()->last_name}}</span> <b class="caret"></b>
				</a>
				<ul class="dropdown-menu animated fadeInLeft">
					<li class="arrow"></li>
					<li><a href="/edit_profile">Profile</a></li>
					@if((Auth::guard('crypto')->user()->role_code) == 'SITEUSR')
					<li><a href="/transaction">My Transaction</a></li>
					@endif
					<li><a href="/change_pass">Change Password</a></li>
					<li class="divider"></li>
					<li><a href="/logout">Log Out</a></li>
				</ul>
			</li>
		</ul>
		<!-- end header navigation right -->
	</div>
			<!-- end container-fluid -->
</div>