@extends('admin.layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <img src="{{$banner->path}}{{$banner->filename}}?time={{time()}}">
        </div>
    </div>
@endsection