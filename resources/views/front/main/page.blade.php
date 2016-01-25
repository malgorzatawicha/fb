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
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb">Home > {{$page->title}}</div>

            <h1>{{$page->title}}</h1>
            {!! $page->body !!}
        </div>
    </div>

@endsection