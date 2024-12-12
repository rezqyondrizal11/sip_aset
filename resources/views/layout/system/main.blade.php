<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIP ASET | @yield('title', 'Dashboard') </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('admin') }}/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/iCheck/flat/blue.css">
    {{-- <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/morris/morris.css"> --}}
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <style>
        .dataTables_wrapper .dataTables_paginate {
            float: right;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
            /* Dropdown di kiri */
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            /* Search box di kanan */
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('home.index') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>SI</b>P</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SIP ASET</b>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>


            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('admin') }}/dist/img/avatar5.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p> {{ Auth::user() ? Auth::user()->name : '' }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                @include('layout.system.sidebar')


            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Sistem Informasi Data Aset Kantor Walinagari Sipinang

                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">@yield('title', 'Dashboard')</li>
                </ol>
            </section>
            @yield('content')


            <!-- /.content -->
        </div>
        @include('layout.system.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.0 -->
    <script src="{{ asset('admin') }}/plugins/jQuery/jQuery-2.2.0.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('admin') }}/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> --}}
    {{-- <script src="{{ asset('admin') }}/plugins/morris/morris.min.js"></script> --}}
    <!-- Sparkline -->
    <script src="{{ asset('admin') }}/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="{{ asset('admin') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin') }}/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="{{ asset('admin') }}/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('admin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('admin') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin') }}/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin') }}/dist/js/app.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if (
        !request()->routeIs('asettetap.index') &&
            !request()->routeIs('asettetap.indexwali') &&
            !request()->routeIs('penghapusanaset.index') &&
            !request()->routeIs('penghapusanasetwali.index'))
        <script>
            $(function() {
                $("#example1").DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "dom": '<"d-flex justify-content-between"lf>rt<"bottom"ip><"clear">' // Flexbox untuk memisahkan elemen
                });
            });
        </script>
    @endif

    @yield('datatable')

    @yield('script')
    <script>
        function klikDelete(link) {

            // let $form = $(this).closest('form');
            Swal.fire({

                title: "Are you sure?",

                text: "You will delete the data",

                icon: "warning",

                showCancelButton: true,

                confirmButtonText: "Yes, delete it!"

            }).then(function(result) {

                // submit form

                if (result.value) {

                    window.location.href = link;

                }



            });





        };
    </script>


</body>

</html>
