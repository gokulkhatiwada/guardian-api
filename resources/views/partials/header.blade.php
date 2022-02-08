<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ settings('name') }} | @yield('title') </title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
<div id="app">

<nav-component></nav-component>
<div class="container">
  <router-view></router-view>
</div>

</div>