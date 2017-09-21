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
        <a href="#" class="btn btn-theme">Explore More</a> <a href="#" class="btn btn-outline">Purchase Now</a><br />
        <br />
        or <a href="#">subscribe</a> newsletter
    </div>
    <!-- end container -->
</div>
<!-- end #home -->

<!-- begin #about -->
<div id="about" class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="container" data-animation="true" data-animation-type="fadeInDown">
        <h2 class="content-title">About Us</h2>
        <p class="content-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
            sed bibendum turpis luctus eget
        </p>
        <!-- begin row -->
        <div class="row">
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-6">
                <!-- begin about -->
                <div class="about">
                    <h3>Our Story</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Vestibulum posuere augue eget ante porttitor fringilla. 
                        Aliquam laoreet, sem eu dapibus congue, velit justo ullamcorper urna, 
                        non rutrum dolor risus non sapien. Vivamus vel tincidunt quam. 
                        Donec ultrices nisl ipsum, sed elementum ex dictum nec. 
                    </p>
                    <p>
                        In non libero at orci rutrum viverra at ac felis. 
                        Curabitur a efficitur libero, eu finibus quam. 
                        Pellentesque pretium ante vitae est molestie, ut faucibus tortor commodo. 
                        Donec gravida, eros ac pretium cursus, est erat dapibus quam, 
                        sit amet dapibus nisl magna sit amet orci. 
                    </p>
                </div>
                <!-- end about -->
            </div>
            <!-- end col-4 -->
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-6">
                <h3>Our Philosophy</h3>
                <!-- begin about-author -->
                <div class="about-author">
                    <div class="quote bg-silver">
                        <i class="fa fa-quote-left"></i>
                        <h3>We work harder,<br /><span>to let our user keep simple</span></h3>
                        <i class="fa fa-quote-right"></i>
                    </div>
                    <div class="author">
                        <div class="image">
                            <img src="storage/frontend/assets/img/user-1.jpg" alt="Sean Ngu" />
                        </div>
                        <div class="info">
                            Sean Ngu
                            <small>Front End Developer</small>
                        </div>
                    </div>
                </div>
                <!-- end about-author -->
            </div>
            <!-- end col-4 -->
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-12">
                <h3>Our Experience</h3>
                <!-- begin skills -->
                <div class="skills">
                    <div class="skills-name">Front End</div>
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-success" style="width: 95%">
                            <span class="progress-number">95%</span>
                        </div>
                    </div>
                    <div class="skills-name">Programming</div>
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-success" style="width: 90%">
                            <span class="progress-number">90%</span>
                        </div>
                    </div>
                    <div class="skills-name">Database Design</div>
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-success" style="width: 85%">
                            <span class="progress-number">85%</span>
                        </div>
                    </div>
                    <div class="skills-name">Wordpress</div>
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-success" style="width: 80%">
                            <span class="progress-number">80%</span>
                        </div>
                    </div>
                </div>
                <!-- end skills -->
            </div>
            <!-- end col-4 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #about -->

<!-- begin #milestone -->
<div id="milestone" class="content bg-black-darker has-bg" data-scrollview="true">
    <!-- begin content-bg -->
    <div class="content-bg">
        <img src="storage/frontend/assets/img/milestone-bg.jpg" alt="Milestone" />
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container">
        <!-- begin row -->
        <div class="row">
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-3 milestone-col">
                <div class="milestone">
                    <div class="number" data-animation="true" data-animation-type="number" data-final-number="1292">1,292</div>
                    <div class="title">Themes & Template</div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-3 milestone-col">
                <div class="milestone">
                    <div class="number" data-animation="true" data-animation-type="number" data-final-number="9039">9,039</div>
                    <div class="title">Registered Members</div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-3 milestone-col">
                <div class="milestone">
                    <div class="number" data-animation="true" data-animation-type="number" data-final-number="89291">89,291</div>
                    <div class="title">Items Sold</div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-3 milestone-col">
                <div class="milestone">
                    <div class="number" data-animation="true" data-animation-type="number" data-final-number="129">129</div>
                    <div class="title">Theme Authors</div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #milestone -->

<!-- begin #team -->
<div id="team" class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="container">
        <h2 class="content-title">Our Team</h2>
        <p class="content-desc">
            Phasellus suscipit nisi hendrerit metus pharetra dignissim. Nullam nunc ante, viverra quis<br /> 
            ex non, porttitor iaculis nisi.
        </p>
        <!-- begin row -->
        <div class="row">
            <!-- begin col-4 -->
            @foreach($team as $key=>$value)
            <div class="col-md-4 col-sm-4">
                <!-- begin team -->
                <div class="team">             
                    <div class="image" data-animation="true" data-animation-type="flipInX">
                        @if($value->image && file_exists(public_path() ."/upload/teams/".$value->image))
                            
                            <img src="{{ url('upload/teams/'.$value->image) }}" alt="{{ $value->first_name }}" />
                        @else
                            <img src="{{ url('upload/teams/default.png') }}" alt="Default" />
                            
                        @endif
                        
                    </div>
                    <div class="info">
                        <h3 class="name">{{ $value->first_name }}&nbsp;{{ $value->last_name }}</h3>
                        <div class="title text-theme">{{ $value->designation }}</div>
                        <p>{{ $value->description }}</p>
                        <div class="social">
                            <a href="{{ $value->facebook_url != '' ? $value->facebook_url: 'javascript:void(0)' }}"><i class="fa fa-facebook fa-lg fa-fw"></i></a>
                            <a href="{{ $value->twitter_url != '' ? $value->twitter_url: 'javascript:void(0)' }}"><i class="fa fa-twitter fa-lg fa-fw"></i></a>
                            <a href="{{ $value->google_plus_url != '' ? $value->google_plus_url: 'javascript:void(0)' }}"><i class="fa fa-google-plus fa-lg fa-fw"></i></a>
                        </div>
                    </div>                     
                </div>
                <!-- end team -->
            </div>
            @endforeach
            <!-- end col-4 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #team -->

<!-- begin #quote -->
<div id="quote" class="content bg-black-darker has-bg" data-scrollview="true">
    <!-- begin content-bg -->
    <div class="content-bg">
        <img src="storage/frontend/assets/img/quote-bg.jpg" alt="Quote" />
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container" data-animation="true" data-animation-type="fadeInLeft">
        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12 quote">
                <i class="fa fa-quote-left"></i> Passion leads to design, design leads to performance, <br />
                performance leads to <span class="text-theme">success</span>!  
                <i class="fa fa-quote-right"></i>
                <small>Sean Themes, Developer Teams in Malaysia</small>
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #quote -->

<!-- beign #service -->
<div id="service" class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="container">
        <h2 class="content-title">Our Services</h2>
        <p class="content-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
            sed bibendum turpis luctus eget
        </p>
        <!-- begin row -->
        <div class="row">
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="service">
                    <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-cog"></i></div>
                    <div class="info">
                        <h4 class="title">Easy to Customize</h4>
                        <p class="desc">Duis in lorem placerat, iaculis nisi vitae, ultrices tortor. Vestibulum molestie ipsum nulla. Maecenas nec hendrerit eros, sit amet maximus leo.</p>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="service">
                    <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-paint-brush"></i></div>
                    <div class="info">
                        <h4 class="title">Clean & Careful Design</h4>
                        <p class="desc">Etiam nulla turpis, gravida et orci ac, viverra commodo ipsum. Donec nec mauris faucibus, congue nisi sit amet, lobortis arcu.</p>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="service">
                    <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-file"></i></div>
                    <div class="info">
                        <h4 class="title">Well Documented</h4>
                        <p class="desc">Ut vel laoreet tortor. Donec venenatis ex velit, eget bibendum purus accumsan cursus. Curabitur pulvinar iaculis diam.</p>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
        </div>
        <!-- end row -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="service">
                    <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-code"></i></div>
                    <div class="info">
                        <h4 class="title">Re-usable Code</h4>
                        <p class="desc">Aenean et elementum dui. Aenean massa enim, suscipit ut molestie quis, pretium sed orci. Ut faucibus egestas mattis.</p>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="service">
                    <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-shopping-cart"></i></div>
                    <div class="info">
                        <h4 class="title">Online Shop</h4>
                        <p class="desc">Quisque gravida metus in sollicitudin feugiat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
            <!-- begin col-4 -->
            <div class="col-md-4 col-sm-4">
                <div class="service">
                    <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-heart"></i></div>
                    <div class="info">
                        <h4 class="title">Free Support</h4>
                        <p class="desc">Integer consectetur, massa id mattis tincidunt, sapien erat malesuada turpis, nec vehicula lacus felis nec libero. Fusce non lorem nisl.</p>
                    </div>
                </div>
            </div>
            <!-- end col-4 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #about -->

<!-- beign #action-box -->
<div id="action-box" class="content has-bg" data-scrollview="true">
    <!-- begin content-bg -->
    <div class="content-bg">
        <img src="storage/frontend/assets/img/action-bg.jpg" alt="Action" />
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container" data-animation="true" data-animation-type="fadeInRight">
        <!-- begin row -->
        <div class="row action-box">
            <!-- begin col-9 -->
            <div class="col-md-9 col-sm-9">
                <div class="icon-large text-theme">
                    <i class="fa fa-binoculars"></i>
                </div> 
                <h3>CHECK OUT OUR ADMIN THEME!</h3>
                <p>
                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus faucibus magna eu lacinia eleifend.
                </p>
            </div>
            <!-- end col-9 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-3">
                <a href="#" class="btn btn-outline btn-block">Live Preview</a>
            </div>
            <!-- end col-3 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #action-box -->

<!-- begin #work -->
<div id="work" class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="container" data-animation="true" data-animation-type="fadeInDown">
        <h2 class="content-title">Our Latest Work</h2>
        <p class="content-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
            sed bibendum turpis luctus eget
        </p>
        <!-- begin row -->
        <div class="row row-space-10">
            @foreach($work AS $key=>$val)
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <!-- begin work -->
                <div class="work">
                    <div class="image">
                        <a href="#"><img src="{{url('/upload/work_image/resize/'.$val->image)}}" alt="{{$val->title}}" /></a>
                    </div>
                    <div class="desc">
                        <span class="desc-title">{{$val->title}}</span>
                        <span class="desc-text">{{$val->description}}</span>
                    </div>
                </div>
                <!-- end work -->
            </div>
            <!-- end col-3 -->
            @endforeach
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #work -->

<!-- begin #client -->
<div id="client" class="content has-bg bg-green" data-scrollview="true">
    <!-- begin content-bg -->
    <div class="content-bg">
        <img src="storage/frontend/assets/img/client-bg.jpg" alt="Client" />
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container" data-animation="true" data-animation-type="fadeInUp">
        <h2 class="content-title">Our Client Testimonials</h2>
        <!-- begin carousel -->
        <div class="carousel testimonials slide" data-ride="carousel" id="testimonials">
            <!-- begin carousel-inner -->
            <div class="carousel-inner text-center">
                @foreach($all_testimonial AS $key=>$val)
                
                <!-- begin item -->
                <div class="item @if($key == 0) active @endif">
                    <blockquote>
                        <i class="fa fa-quote-left"></i>
                        {{$val->client_comment}}
                        <i class="fa fa-quote-right"></i>
                    </blockquote>
                    <div class="name"> — <span class="text-theme">{{$val->client_name}}</span>, {{$val->client_designation}}</div>
                </div>
                <!-- end item -->
               
                @endforeach
            </div>
            <!-- end carousel-inner -->
            <!-- begin carousel-indicators -->
            <ol class="carousel-indicators">
                @foreach($all_testimonial AS $key=>$val)
                <li data-target="#testimonials" data-slide-to="{{$key}}" @if($key == 0) class="active" @endif></li>
                @endforeach
            </ol>
            <!-- end carousel-indicators -->
        </div>
        <!-- end carousel -->
    </div>
    <!-- end containter -->
</div>
<!-- end #client -->

<!-- begin #pricing -->
<div id="pricing" class="content" data-scrollview="true">
    <!-- begin container -->
    <div class="container">
        <h2 class="content-title">Our Price</h2>
        <p class="content-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
            sed bibendum turpis luctus eget
        </p>
        <!-- begin pricing-table -->
        <ul class="pricing-table col-4">
            @foreach($all_pricing AS $key=>$val)
            <li @if($key == 2) class="highlight" @endif data-animation="true" data-animation-type="fadeInUp">
                <div class="pricing-container">
                    <h3>{{$val->pricing_title}}</h3>
                    <div class="price">
                        <div class="price-figure">
                            <span class="price-number">{{$val->pricing_amount}}</span>
                        </div>
                    </div>
                    <ul class="features">
                        <li>{{$val->storage}} Storage</li>
                        <li>{{$val->no_of_clients}} Clients</li>
                        <li>{{$val->active_projects}} Active Projects</li>
                        <li>{{$val->colors}} Colors</li>
                        <li>{{$val->goodies}} Goodies</li>
                        <li>{{$val->email_support}} Email support</li>
                    </ul>
                    <div class="footer">
                        <a href="#" class="btn btn-inverse btn-block">Buy Now</a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- end container -->
</div>
<!-- end #pricing -->

<!-- begin #contact -->
<div id="contact" class="content bg-silver-lighter" data-scrollview="true">
    <!-- begin container -->
    <div class="container">
        <h2 class="content-title">Contact Us</h2>
        <p class="content-desc">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
            sed bibendum turpis luctus eget
        </p>
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-6" data-animation="true" data-animation-type="fadeInLeft">
                <h3>If you have a project you would like to discuss, get in touch with us.</h3>
                <p>
                    Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus.
                </p>
                <p>
                    <strong>{{$contact_details[0]['name']}}</strong><br />
                    {{$contact_details[0]['address']}}<br />
                    {{$contact_details[0]['city_name']}}, {{$contact_details[0]['state_name']}}, {{$contact_details[0]['countries']['name']}}, {{$contact_details[0]['pincode']}}<br />
                    P: {{$contact_details[0]['phone_no']}}<br />
                </p>
                <p>
                    <span class="phone">{{$contact_details[0]['phone_no']}}</span><br />
                    <a href="mailto:{{$contact_details[0]['email']}}">{{$contact_details[0]['email']}}</a>
                </p>
            </div>
            <!-- end col-6 -->
            <!-- begin col-6 -->
            <div class="col-md-6 form-col" data-animation="true" data-animation-type="fadeInRight">
                <form class="form-horizontal" action="javascript:void(0)" name="contact_us_form" id="contact_us_form">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name <span class="text-theme">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="contact_us_name" id="contact_us_name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Email <span class="text-theme">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="contact_us_email" id="contact_us_email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Message <span class="text-theme">*</span></label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="10" id="contact_us_msg" name="contact_us_msg"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9 text-left">
                            <button type="button" class="btn btn-theme btn-block" id="contact_us_submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end #contact -->
@stop