
@extends('layouts.admin')

@section('content')
    <h1>Edit {{ $image->image_name. '.' . $image->image_extension }}</h1>
    <hr/>
    @include('common.errors')
    <div>
        Note: name and path values cannot be changed.  If you wish to change these, then delete and create a new photo:
    </div>
    <br>
    <form class='form' action="{{route('admin.products.images.update', ['product' => $product->slug, 'image' => $image->id])}}" method="POST" class="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        {{ method_field('PATCH') }}
        <div>
            <ul>
                <li><h4>Image Name:   {{ $image->image_name. '.' . $image->image_extension }}  </h4></li>
                <li><h4>Image Path:   {{ $image->image_path }} </h4> </li>
                <li><h4>Mobile Name:   {{ $image->mobile_image_name. '.' . $image->mobile_extension }} </h4> </li>
                <li><h4>Mobile Path:   {{ $image->mobile_image_path }} </h4></li>

            </ul>
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
@endsection
