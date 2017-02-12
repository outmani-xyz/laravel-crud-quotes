<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8"/>

        <script src="{{ URL::to('js/jquery.min.js') }}"></script>
        <script src="{{ URL::to('bootstrap/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}"/>
        <link rel="stylesheet" href="{{ URL::to('bootstrap/bootstrap.min.css') }}"/>
        @yield('style')
    </head>
    <body>

        <div class="main">
            @yield('content')
        </div>
    </body>

</html>