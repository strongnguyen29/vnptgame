<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::user()->api_token ?? '' }}">
    <meta name="robots" content="noindex">

    <title>CMS {{ config('app.name') }} | @yield('head_title')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/admin-lte-v3/css/adminlte.min.css') }}">

    @stack('head_link_css')
    <!-- App style -->
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">

    <!-- Google Font: Source Sans Pro -->
    {{--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    @stack('head_end')
</head>
<body class="hold-transition sidebar-mini @stack('body_class')">
@stack('body_start')

<div class="wrapper">

    <!-- Navbar -->
    @include('backend.layouts.navbar')
    <!-- /.navbar -->

        <!-- Main Sidebar Container -->
    @include('backend.layouts.main_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex align-items-center">
                        <h1 class="m-0 text-dark">{{ $pageData['title'] ?? 'Page Title' }}</h1>
                        <div class="btn-actions ml-3">
                            @yield('content-header-actions')
                        </div>
                    </div><!-- /.col -->
                    @include('backend.layouts.breadcrumb', ['breadcrumb' => $pageData['breadcrumb'] ?? []])
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @include('backend.layouts.alert')

                @yield('main_content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-sm-inline">Version 1.0</div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2021 .</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/admin-lte-v3/js/adminlte.min.js') }}"></script>

@stack('body_end_link_js')
<!-- App script -->
<script src="{{ asset('backend/js/app.js') }}"></script>

@stack('body_end')
{{-- Show toast success message --}}
@if ($message = Session::get('success'))

    <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success('{{ $message ?? 'Thành công' }}')
    </script>
@endif
</body>
</html>
