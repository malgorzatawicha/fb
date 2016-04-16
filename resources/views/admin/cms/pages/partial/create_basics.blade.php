@include('common.errors')
<form action="{{ route('admin.cms.pages.store') }}" method="POST" class="form-horizontal page-form"  enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="page-name" class="col-sm-2 control-label">{{ trans('cms.page.name') }}</label>
        <div class="col-sm-9">
            <input type="text" name="name" id="page-name" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="page-title" class="col-sm-2 control-label">{{ trans('cms.page.title') }}</label>
        <div class="col-sm-9">
            <input type="text" name="title" id="page-title" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="page-type" class="col-sm-2 control-label">{{ trans('cms.page.type') }}</label>
        <div class="col-sm-9">
            <select name="type" id="page-type" class="form-control">
                @foreach($types as $type)
                    <option value="{{$type}}">{{$type}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="page-description" class="col-sm-2 control-label">{{ trans('cms.page.description') }}</label>
        <div class="col-sm-9">

            <textarea name="description" id="page-description" class="form-controll ckeditor" rows="3" cols="80"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="page-body" class="col-sm-2 control-label">{{ trans('cms.page.body') }}</label>
        <div class="col-sm-9">

            <textarea name="body" id="page-body" class="form-controll ckeditor" rows="10" cols="80"></textarea>
        </div>
    </div>
    <div class="form-group">
        <input type="hidden" id="logo-path" value="">
        <input type="hidden" id="logo-filename" value="">
        <label for="logo" class="col-sm-2 control-label">logo:</label>
        <div class="col-sm-9">
            <input type="file" name="logo" id="logo">
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox col-sm-offset-2">
            <input type="hidden" id="is_active" value="0">
            <input type="hidden" name="active" value="0">
            <label><input type="checkbox" name="active" id="active" value="1">Is Active</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <a href="{{route('admin.cms.pages.index')}}" class="btn btn-primary">{{ trans('admin.back') }}</a>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('cms.page.add') }}
            </button>
        </div>
    </div>
</form>