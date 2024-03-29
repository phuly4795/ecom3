<!DOCTYPE html>
<html>

<head>
    @include('admin.dashboard.components.head')
</head>

<body>
    <div id="wrapper">
        @include('admin.dashboard.components.sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('admin.dashboard.components.navbar')
            @yield('content')
            @include('admin.dashboard.components.footer')
        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }} "></script>
    <script src="{{ asset('js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }} "></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }} "></script>

    <!-- jQuery UI -->
    <script src=" {{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>


    <!-- Peity -->
    <script src=" {{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src=" {{ asset('js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src=" {{ asset('js/inspinia.js') }}"></script>
    <script src=" {{ asset('js/plugins/pace/pace.min.js') }}"></script>



    <!-- Jvectormap -->
    <script src=" {{ asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src=" {{ asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- EayPIE -->
    <script src=" {{ asset('js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

    <!-- Sparkline -->
    <script src=" {{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src=" {{ asset('js/demo/sparkline-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('js')
</body>

</html>
