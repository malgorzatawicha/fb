@extends('admin.layouts.default')

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <h2>{{$image->image_name}}</h2>
            </div>
            <div>
                <img src="{{$image->image_path}}{{$image->image_filename}}?time={{time()}}">
            </div>
            <div>
                <h2>{{$image->mobile_name}} - mobile</h2>
            </div>
            <div>
                <img src="{{$image->mobile_path}}{{$image->mobile_filename}}?time={{time()}}">
            </div>
        </div>
    </div>
@endsection