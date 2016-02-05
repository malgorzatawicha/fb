@extends('front.layouts.page')
@section('page_description')
    @if($page->logo_filename)
        <div class="row"><img title="{{$page->title}}" alt="logo" src="{{$page->logo_path}}/{{$page->logo_filename}}" width="100%"></div>
    @endif

    @if($page->description)
        <div class="row">{!! $page->description !!}</div>
    @endif
    <div id="tree"></div>
@endsection

@section('page_content')
    <div class="breadcrumb">Home > {{$page->title}}</div>
    <div class="row row-content">
        @if(count($page->banners) > 0)
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach ($page->banners as $index => $banner)
                        <li data-target="#myCarousel" data-slide-to="{{$index}}" @if($index == 0) class="active" @endif></li>
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach ($page->banners as $index => $banner)
                        <div class="item @if($index == 0) active @endif">
                            <img src="{{$banner->path}}{{$banner->filename}}" style="width: 100%" alt="{{$banner->name}}">
                        </div>
                    @endforeach
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif
        <h1>{{$page->title}}</h1>
        {!! $page->body !!}

        @if(\View::exists('front.main.boxes.' . $page->type))
            @include('front.main.boxes.' . $page->type)
        @endif
    </div>

@endsection

@section('scripts')
    <script>
        var $tree = $("#tree");
        $tree.treeview({
            data: {!! createTree($categories) !!}
        });
    </script>
    @yield('gallery_scripts')
@endsection