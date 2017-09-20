<div id="header" class="header navbar navbar-transparent navbar-fixed-top">
            <!-- begin container -->
    <div class="container">
        <!-- begin navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <span class="brand-logo"></span>
                <span class="brand-text">
                    <span class="text-theme">Crypto</span> Share
                </span>
            </a>
        </div>
        <!-- end navbar-header -->
        <!-- begin navbar-collapse -->
        <div class="collapse navbar-collapse" id="header-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#home" data-click="scroll-to-target">HOME</a></li>
                <li><a href="#about" data-click="scroll-to-target">ABOUT</a></li>
                <li><a href="#team" data-click="scroll-to-target">TEAM</a></li>
                <li><a href="#service" data-click="scroll-to-target">SERVICES</a></li>
                <li><a href="#work" data-click="scroll-to-target">WORK</a></li>
                <li><a href="#client" data-click="scroll-to-target">CLIENT</a></li>
                <li><a href="#pricing" data-click="scroll-to-target">PRICING</a></li>
                <li><a href="#contact" data-click="scroll-to-target">CONTACT</a></li>
                @if(Auth::guard('crypto')->check())
                    <li><a href="/dashboard">DASHBOARD</a></li>
                @else
                    <li><a href="/login">LOGIN</a></li>
                @endif
            </ul>
        </div>
        <!-- end navbar-collapse -->
    </div>
            <!-- end container -->
</div>