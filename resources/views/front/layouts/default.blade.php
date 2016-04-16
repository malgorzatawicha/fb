<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$site->title}}</title>
    <meta name="description" content="{{$site->description}}" />
    <meta name="keywords" content="{{$site->keywords}}" />
    <link type="text/css" rel="stylesheet" href="{{ elixir('css/all.css') }}"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @yield('styles')
</head>

<body>
<div class="wrapper">
    <div class="container">
        <img class="img-responsive" src="{{route('image', ['fileId' => $site->banner_id, 'width' => 1170, 'height'=>336])}}"/>
        <div class="page-body">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row centered">
                    {!! $site->footer !!}
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ elixir('js/all.js') }}"></script>

@yield('scripts')
</body>
</html>