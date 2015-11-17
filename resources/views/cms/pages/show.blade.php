@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{$page->title}}</h4>
        </div>
        <div class="panel-body">
          {!! $page->body !!}
        </div>

        <div class="centered">
            <a href="{{route('admin.pages.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop