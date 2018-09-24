<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('/').'/public/css/app.css'}}" />
    <link rel="stylesheet" href="{{url('/').'/public/css/AdminLTE.min.css'}}" />
    <link rel="stylesheet" href="{{url('/').'/public/css/skins/_all-skins.min.css'}}" />
    <link rel="stylesheet" href="{{url('/').'/public/font-awesome/css/font-awesome.min.css'}}" />
    @yield('stylesheets')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('elements.header')
        @include('elements.sidebar')
        @yield('content')
    </div>
    <script src="{{url('/').'/public/js/jquery/dist/jquery.min.js'}}"></script>
    <script src="{{url('/').'/public/js/bootstrap/dist/js/bootstrap.min.js'}}"></script>
    <script src="{{ url('/').'/public/js/adminlte.min.js'}}"></script>
    @yield('scripts')
</body>
</html>
