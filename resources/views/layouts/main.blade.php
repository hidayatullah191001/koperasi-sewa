<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | Rental dan travel Koperasi Putra Mandiri Sukses</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<!-- body start -->

<body class="loading" data-layout-mode="detached"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @include('includes.topbar')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('includes.left-sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                @yield('content')

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('includes.footer-main')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    {{-- <!-- Right Sidebar -->
    @include('includes.right-sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div> --}}

    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')

</body>

</html>
