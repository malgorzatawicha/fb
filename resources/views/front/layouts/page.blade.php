@extends('front.layouts.default')
@section('content')
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand">{{$site->title}}</div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    @foreach($pages as $item)
                        <li @if($item->id == $page->id)class="active"@endif><a href="{{route('page', ['page' => $item->slug])}}">{{$item->title}}</a></li>
                    @endforeach
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
    <div class="page-content">
        @if ($page->logo_filename or $page->description or $page->type == 'gallery')
                <div class="left-side">
                    @yield('page_description')
                </div>
                <div class="right-side">
                    @yield('page_content')
                </div>
            @else
                <div class="full-width">
                    @yield('page_content')

                </div>
            @endif
    </div>
@endsection