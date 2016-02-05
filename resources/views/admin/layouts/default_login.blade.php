<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FB Shop</title>

    <link type="text/css" rel="stylesheet" href="{{ elixir('css/admin.css') }}"/>
    @yield('styles')
</head>

<body>

<div class="container" role="main">
    @yield('content')
</div>
<script src="{{ elixir('js/all.js') }}"></script>
@yield('scripts')
</body>
</html>