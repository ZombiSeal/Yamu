<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@800&family=Ubuntu:wght@300;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>
<body>
@include('include.rightMenu')
@include('include.header')
<main>
    @yield('content')
</main>
@include('include.footer')
</body>
<script src="{{asset('/js/main.js')}}"></script>
</html>
