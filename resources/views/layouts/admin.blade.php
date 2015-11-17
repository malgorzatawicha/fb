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

    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Fb shop</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="/admin">Home</a></li>
                    <li><a href="{{ route('admin.pages.index') }}">{{trans('cms.pages')}}</a></li>
                    <li><a href="{{ route('admin.products.index') }}">{{trans('shop.products')}}</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    @yield('content')
</div>
<script src="{{ elixir('js/all.js') }}"></script>
@yield('scripts')
</body>
</html>