@include('common.errors')
<form action="{{ route('admin.galleries.store') }}" method="POST" class="form-horizontal">
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <div class="form-group">
        <label for="gallery-name" class="col-sm-2 control-label">{{trans('gallery.gallery.name')}}</label>
        <div class="col-sm-9">
            <input type="text" name="name" id="gallery-name" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="gallery-description" class="col-sm-2 control-label">{{trans('gallery.gallery.description')}}</label>
        <div class="col-sm-9">

            <textarea name="description" id="gallery-description" class="form-controll ckeditor" rows="10" cols="80"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <a href="{{route('admin.galleries.index')}}" class="btn btn-primary">{{ trans('admin.back') }}</a>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('gallery.gallery.add') }}
            </button>
        </div>
    </div>
</form>