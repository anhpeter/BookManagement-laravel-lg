<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes/head')
</head>

<body id="page-top" class="position-relative">

        @include('partials/message_toast')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('includes/sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('includes/nav')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

            <!-- Footer -->
            @include('includes/main-footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    @include('includes/footer')

    <!-- SCRIPTS -->
    @include('includes/scripts')
</body>

</html>
