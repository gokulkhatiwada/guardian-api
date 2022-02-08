<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ settings('name') }} | @yield('title')</title>
  <link rel="stylesheet" href="{{ asset('back/css/app.css') }}">
  <script src="{{ asset('back/js/app.js') }}"></script>
  @yield('style')
</head>
<body data-sidebar="dark" class="vertical-collpsed">
<div id="loader">
</div>
<!-- Begin page -->
<div id="layout-wrapper">


