<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$site->title}} - Admin</title>
    <meta name="description" content="{{$site->description}}" />
    <meta name="keywords" content="{{$site->keywords}}" />
    <link type="text/css" rel="stylesheet" href="{{ elixir('css/admin.css') }}"/>
    @yield('styles')
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
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
                <a href="/" class="navbar-brand">{{$site->title}}</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="/admin">Home</a></li>
                    <li><a href="{{route('admin.site.edit')}}">Site management</a></li>
                    <li><a href="{{ route('admin.cms.pages.index') }}">{{trans('cms.pages')}}</a></li>
{{--
                    <li><a href="{{ route('admin.shop.products.index') }}">{{trans('shop.products')}}</a></li>
--}}
                    <li class="dropdown">
                        <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">{{trans('gallery.categories')}} <span class="caret"></span></a>
                        <ul class="dropdown-menu inverse-dropdown">
                            <li><a href="{{ route('admin.gallery.categories.index') }}">{{trans('gallery.categories')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    @yield('content')
</div>
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script src="{{ elixir('js/all.js') }}"></script>
<script src="{{ elixir('js/admin/admin.js') }}"></script>

@yield('scripts')
</body>
</html>