<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset(' ')}}" >
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="frontend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="frontend/css/shop-homepage.css" rel="stylesheet">
    <link href="frontend/css/my.css" rel="stylesheet">
    @yield('css')
</head>
<body>

  @include('layout.header')
  @yield('content')
  <script src="frontend/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="frontend/js/bootstrap.min.js"></script>
    <script src="frontend/js/my.js"></script>
  @yield('script')

</body>
</html>
