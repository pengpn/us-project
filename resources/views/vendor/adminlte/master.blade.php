<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- X-CSRF-TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/minimal/blue.css') }}">
    <!-- NProgress -->
    <link rel="stylesheet" href="{{ asset('plugins/nprogress/nprogress.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Css自定义 -->
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">


    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
</head>
<body class="hold-transition @yield('body_class')">

<!-- jQuery -->
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

@yield('body')

<!-- 后台公用 -->
<script src="{{ asset('js/admin-custom.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.js') }}"></script>
<!-- jquery pjax -->
<script src="{{ asset('plugins/pjax/jquery.pjax.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
<!-- SweetAlert -->
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- jsvalidation -->
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>
<!-- 插件参数设置 -->
<script src="{{ asset('js/plugins-setting.js') }}"></script>
<!-- Pjax全局处理 -->
<script src="{{ asset('js/pjax-custom.js') }}"></script>
<!-- JS路由生成（Laravel风格） -->
@routes

@yield('adminlte_js')

</body>
</html>
