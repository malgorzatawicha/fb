@extends('front.layouts.default')
@section('content')
    <nav class="navbar navbar-inverse">
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                @foreach($pages as $item)
                    <li @if($item->id == $page->id)class="active"@endif><a href="{{route('page', ['page' => $item->slug])}}">{{$item->title}}</a></li>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="page-content">
        @if ($page->logo_filename or $page->description)
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