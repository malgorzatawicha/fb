@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.gallery.categories.create')}}" class="btn btn-primary">{{ trans('admin.create') }}</a></div>
            <h4>{{trans('gallery.categories')}}</h4>
        </div>
        <div class="panel-body">
            @if (count($categories) > 0)
                <div id="tree"></div>
            @else
                <p>{{trans('gallery.gallery.no_records')}}</p>
            @endif
        </div>
    </div>

@stop