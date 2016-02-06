@extends('front.layouts.page')
@section('page_description')
    @if($page->logo_filename)
        <div class="row"><img title="{{$page->title}}" alt="logo" src="{{$page->logo_path}}/{{$page->logo_filename}}" width="100%"></div>
    @endif

    @if($page->description)
        <div class="row">{!! $page->description !!}</div>
    @endif
@endsection

@section('page_content')
    <div class="breadcrumb">Home > {{$page->title}}</div>
    <div class="row row-content">
        @include('front.main.partial.banner')
        <h1>{{$page->title}}</h1>
        {!! $page->body !!}

        @if(\View::exists('front.main.boxes.' . $page->type))
            @include('front.main.boxes.' . $page->type)
        @endif
    </div>

@endsection