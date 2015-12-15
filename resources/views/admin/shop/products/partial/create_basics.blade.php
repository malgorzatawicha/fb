@include('common.errors')
<form action="{{ route('admin.shop.products.store') }}" method="POST" class="form-horizontal">
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <div class="form-group">
        <label for="product-name" class="col-sm-2 control-label">{{trans('shop.product.name')}}</label>
        <div class="col-sm-9">
            <input type="text" name="name" id="product-name" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="product-description" class="col-sm-2 control-label">{{trans('shop.product.description')}}</label>
        <div class="col-sm-9">

            <textarea name="description" id="product-description" class="form-controll ckeditor" rows="10" cols="80"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <a href="{{route('admin.shop.products.index')}}" class="btn btn-primary">{{ trans('admin.back') }}</a>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('shop.product.add') }}
            </button>
        </div>
    </div>
</form>