@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{$product->name}}</h4>
        </div>
        <div class="panel-body">
          {!! $product->description !!}
        </div>

        <div class="centered">
            <a href="{{route('admin.shop.products.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
        </div>
    </div>

@stop