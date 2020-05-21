@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - {{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/css/fontawesome-5.7.0.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/css/font-awesome/4.7.0/css/font-awesome.min.css')}}">
</head>
<body class="app sidebar-mini">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    <main class="app-content" id="app">
        @yield('content')
    </main>

    <script type="text/javascript" src="{{asset('/backend/js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/backend/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/backend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/backend/js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('/backend/js/plugins/pace.min.js')}}"></script>
    @stack('scripts')
</body>
@else
    404
@endif
