@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Products - Update Product {{$product->name}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.products', [$product->slug]) }}" method="POST" class="form-horizontal">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <label for="product-name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$product->name}}" name="name" id="product-name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="product-description" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-6">
                        <textarea name="description" id="product-description" class="form-controll ckeditor" rows="10" cols="80">{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.products.index')}}" class="btn btn-primary">Back</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> Save Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
@stop