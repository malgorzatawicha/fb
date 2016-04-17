@include('common.errors')
<form action="{{ route('admin.gallery.pages.attach', [$page->slug]) }}" method="POST" class="form-horizontal">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="form-group">
        <label for="gallery-category" class="col-sm-2 control-label">{{ trans('admin.pages.gallery.category') }} <span class="required">*</span></label>
        <div class="col-sm-9">
            <select name="category" id="gallery-category" class="form-control">
                @foreach($categories as $id => $category)
                    <option value="{{$id}}" @if($page->gallery && $id == $page->gallery->gallery_category_id) selected @endif>{{str_replace(' ', '&nbsp;', $category)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <a href="{{route('admin.cms.pages.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span> {{trans('admin.save')}}
            </button>
        </div>
    </div>
</form>