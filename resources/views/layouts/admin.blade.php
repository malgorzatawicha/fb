<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FB Shop</title>

    <link type="text/css" rel="stylesheet" href="{{ elixir('css/all.css') }}"/>
</head>

<body>

<div class="container" role="main">
    @yield('navbar')
    @yield('content')
</div>
<script type="text/javascript" src="{{ elixir('js/all.js') }}"></script>
</body>
</html>