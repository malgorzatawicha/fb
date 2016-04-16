@include('common.errors')
<form action="{{ route('admin.cms.pages.update', [$page->slug]) }}" method="POST" class="form-horizontal page-form"  enctype="multipart/form-data">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <span id="page" data-page="{{$page}}"></span>
    <div class="form-group">
        <label for="page-name" class="col-sm-2 control-label">{{ trans('cms.page.name') }}</label>
        <div class="col-sm-9">
            <input type="text" value="{{$page->name}}" name="name" id="page-name" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="page-title" class="col-sm-2 control-label">{{trans('cms.page.title')}}</label>
        <div class="col-sm-9">
            <input type="text" value="{{$page->title}}" name="title" id="page-title" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="page-type" class="col-sm-2 control-label">{{ trans('cms.page.type') }}</label>
        <div class="col-sm-9">
            <select name="type" id="page-type" class="form-control">
                @foreach($types as $type)
                    <option value="{{$type}}" @if($type == $page->type) selected @endif>{{$type}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="page-description" class="col-sm-2 control-label">{{ trans('cms.page.description') }}</label>
        <div class="col-sm-9">

            <textarea name="description" id="page-description" class="form-controll ckeditor" rows="3" cols="80">{{$page->description}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="page-body" class="col-sm-2 control-label">{{trans('cms.page.body')}}</label>
        <div class="col-sm-9">
            <textarea name="body" id="page-body" class="form-controll ckeditor" rows="10" cols="80">{{$page->body}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="logo" class="col-sm-2 control-label">logo:</label>
        <div class="col-sm-9">
            <input type="hidden" class="existing" name="logo_existing" id="page-logo_existing">
            <input type="file" name="logo" id="logo" data-image="{{json_encode([
                                'big' =>route('admin.image', ['fileId' => $page->logo_id]),
                                 'thumb' => route('admin.image', ['fileId' => $page->logo_id, 'width' => 213, 'height' => 160])
                               ])}}">
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox col-sm-offset-2">
            <input type="hidden" name="active" value="0">
            <label><input type="checkbox" @if (!empty($project->active)) checked="checked" @endif name="active" id="page-active" value="1">Is Active</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <a href="{{route('admin.cms.pages.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span> {{trans('cms.page.save')}}
            </button>
        </div>
    </div>
</form>