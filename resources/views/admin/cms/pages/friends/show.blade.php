@extends('admin.layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <img src="{{$friend->path}}{{$friend->filename}}?time={{time()}}">
        </div>
    </div>
@endsection