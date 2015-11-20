
@extends('layouts.admin')

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <div>
                <h2>{{$image->image_name}}</h2>
            </div>
            <div>
                <img src="/images/products/{{$image->image_name}}.{{$image->image_extension}}?time={{time()}}">
            </div>
            <div>
                <h2>{{$image->image_name}} - thumbnail</h2>
            </div>
            <div>
                <img src="/images/products/thumbnails/thumb-{{$image->image_name}}.{{$image->image_extension}}?time={{time()}}">
            </div>

            <div>
                <h2>{{$image->mobile_image_name}} - mobile</h2>
            </div>
            <div>
                <img src="/images/products/mobile/{{$image->mobile_image_name}}.{{$image->image_extension}}?time={{time()}}">
            </div>

        </div>
    </div>
@endsection