@include('common.errors')
<form action="{{ route('admin.gallery.galleries.update', [$gallery->slug]) }}" method="POST" class="form-horizontal">
    {{ method_field('PUT') }}
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <div class="form-group">
        <label for="gallery-name" class="col-sm-2 control-label">{{trans('gallery.gallery.name')}}</label>
        <div class="col-sm-9">
            <input type="text" value="{{$gallery->name}}" name="name" id="gallery-name" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="gallery-description" class="col-sm-2 control-label">{{trans('gallery.gallery.description')}}</label>
        <div class="col-sm-9">
            <textarea name="description" id="gallery-description" class="form-controll ckeditor" rows="10" cols="80">{{$gallery->description}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <a href="{{route('admin.gallery.galleries.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span> {{trans('gallery.gallery.save')}}
            </button>
        </div>
    </div>
</form>