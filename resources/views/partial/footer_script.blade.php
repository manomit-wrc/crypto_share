<!-- ================== BEGIN BASE JS ================== -->
    
    {!! Html::script('storage/frontend/assets/plugins/jquery/jquery-1.9.1.min.js') !!}
    
    {!! Html::script('storage/frontend/assets/plugins/jquery/jquery-migrate-1.1.0.min.js') !!}

    @if(Request::segment(1) === 'login' )
        {!! Html::script('storage/frontend/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') !!}
    @endif

    
    
    {!! Html::script('storage/frontend/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
    <!--[if lt IE 9]>
        <script src="storage/frontend/assets/crossbrowserjs/html5shiv.js"></script>
        <script src="storage/frontend/assets/crossbrowserjs/respond.min.js"></script>
        <script src="storage/frontend/assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    @if(Request::segment(1) === 'login' )
        {!! Html::script('storage/frontend/assets/plugins/slimscroll/jquery.slimscroll.min.js') !!}
    @endif
    {!! Html::script('storage/frontend/assets/plugins/jquery-cookie/jquery.cookie.js') !!}
    
    {!! Html::script('storage/frontend/assets/plugins/scrollMonitor/scrollMonitor.js') !!}
    
    {!! Html::script('storage/frontend/assets/js/apps.min.js') !!}
    <!-- ================== END BASE JS ================== -->
    
    <script>    
        $(document).ready(function() {
            App.init();
        });
    </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');

</script>