@extends('front.layouts.default')
@section('content')
    @if ($page->logo or $page->description)
        <div class="col-md-3 left-menu">
            @yield('page_description')
        </div>
        <div class="col-md-9">
            @yield('page_content')
        </div>
    @else
        <div class="col-md-12">
            @yield('page_content')
        </div>
    @endif
@endsection