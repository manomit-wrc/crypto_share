<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Mirrored from seantheme.com/color-admin-v3.0/frontend/one-page-parallax/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Sep 2017 04:21:06 GMT -->
<head>
    <meta charset="utf-8" />
    <title>Crypto Share</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    {!! Html::style('storage/frontend/assets/plugins/bootstrap/css/bootstrap.min.css') !!}
    
    {!! Html::style('storage/frontend/assets/plugins/font-awesome/css/font-awesome.min.css') !!}
    
    {!! Html::style('storage/frontend/assets/css/animate.min.css') !!}
    
    {!! Html::style('storage/frontend/assets/css/style.min.css') !!}
    
    {!! Html::style('storage/frontend/assets/css/style-responsive.min.css') !!}
    
    {!! Html::style('storage/frontend/assets/css/theme/default.css') !!}
    
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    {!! Html::script('storage/frontend/assets/plugins/pace/pace.min.js') !!}
    
    <!-- ================== END BASE JS ================== -->
</head>
<body data-spy="scroll" data-target="#header-navbar" data-offset="51">
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        @include('partial/header')
        <!-- end #header -->
        
        @yield('content')
        
        <!-- begin #footer -->
        @include('partial/footer')
        <!-- end #footer -->
        
        <!-- begin theme-panel -->
        {{-- <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                </ul>
            </div>
        </div> --}}
        <!-- end theme-panel -->
    </div>
    <!-- end #page-container -->
    
    @include('partial/footer_script')
</body>

</html>