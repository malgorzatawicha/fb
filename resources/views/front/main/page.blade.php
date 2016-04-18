@extends('front.layouts.page')
@section('page_description')
    @if($page->logo_id)
        <div class="row col-sm-2 col-md-12">
            <img title="{{$page->title}}" alt="logo" src="{{route('image',['fileId'=>$page->logo_id, 'width'=>300, 'height' => 300])}}" width="100%">
        </div>
    @endif

    @if($page->description)
        <div class="row col-sm-10 page-description">{!! $page->description !!}</div>
    @endif
@endsection

@section('page_content')
    @if($page->type!= 'main')
    <div class="breadcrumb"> <a href="/">{{$site->breadcrumb}}</a> / {{$page->title}}</div>
    @endif
    <div class="row row-content">
        @include('front.main.partial.banner')
        <h1>{{$page->title}}</h1>
        {!! $page->body !!}

        @if(\View::exists('front.main.boxes.' . $page->type))
            @include('front.main.boxes.' . $page->type)
        @endif
    </div>

@endsection