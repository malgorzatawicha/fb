
@extends('layouts.admin')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('shop.product_images')}} - {{trans('admin.create')}}</h4>
        </div>
        <div class="panel-body">

            @include('common.errors')
            <form action="{{route('admin.products.images.store', ['product' => $product->slug])}}" method="POST" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <label for="image-name">Image Name:</label>
                    <input type="text" name="image_name" id="image-name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mobile-image-name">Mobile Image Name:</label>
                    <input type="text" name="mobile_image_name" id="mobile-image-name" class="form-control">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="active" value="0"/> Is Active
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_featured" value="0"/> Is Featured
                    </label>
                </div>
                <div class="form-group">
                    <label for="image">Primary Image:</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="mobile-image">Mobile Image:</label>
                    <input type="file" name="mobile_image" id="mobile-image">
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.products.images.index')}}" class="btn btn-primary">{{ trans('admin.back') }}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('shop.product_image.add') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection