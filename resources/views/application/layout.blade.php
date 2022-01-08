<!DOCTYPE HTML>
<html lang="en">

<head>
    @include('application.partials._head')
</head>

<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner">
            <div class="loader-inner-cirle"></div>
        </div>
    </div>
    <!--loader end-->
    <!-- main start  -->
    <div id="main">
        <!-- header -->
        <header class="main-header">
            @include('application.partials._header')
  
        </header>
        <!-- header end-->
        <!-- wrapper-->
        <div id="wrapper">
            <!-- content-->
            <div class="content">
                @yield('contant')
            </div>
            <!--content end-->
        </div>
        <!-- wrapper end-->
        @include('application.partials._footer')
        
        <a class="to-top"><i class="fas fa-caret-up"></i></a>
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    @include('application.partials._js')
  
</body>

</html>