@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{$gallery->name}}</h4>
        </div>
        <div class="panel-body">
            {!! $gallery->description !!}
        </div>
        <div class="centered">
            <a href="{{route('admin.galleries.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
        </div>
    </div>

@stop