<!DOCTYPE html>
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : SimpleWork
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140225

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
{{--    <link href="../public/default.css" rel="stylesheet" type="text/css" media="all" />--}}
{{--    <link href="../public/fonts.css" rel="stylesheet" type="text/css" media="all" />--}}
    <link href="{{ asset('css/default.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    @yield('head')
</head>
<body>
@include('partials.navbar')
@yield('content')
@include('partials.footer')
<script src="/js/app.js"></script>
</body>
</html>
