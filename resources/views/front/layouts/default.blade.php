<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$site->title}}</title>

    <link type="text/css" rel="stylesheet" href="{{ elixir('css/all.css') }}"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @yield('styles')
</head>

<body>
<div class="container" role="main">
    @yield('content')
</div>
<footer class="footer"></footer>
<script src="{{ elixir('js/all.js') }}"></script>

@yield('scripts')
</body>
</html>