@include('common.errors')
<span class="project-form">
<form method="POST" class="form-horizontal" enctype="multipart/form-data">
    {{ method_field('POST') }}
    {{ csrf_field() }}
    <div class="form-group">
        <label for="project-name" class="col-sm-3 control-label">{{ trans('admin.gallery.projects.name') }} <span class="required">*</span></label>
        <div class="col-sm-9">
            <input type="text" name="name" value="" id="project-name" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="project-title" class="col-sm-3 control-label">{{ trans('admin.gallery.projects.title') }} <span class="required">*</span></label>
        <div class="col-sm-9">
            <input type="text" name="title" value="" id="project-title" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="project-short-title" class="col-sm-3 control-label">{{ trans('admin.gallery.projects.short_title') }}</label>
        <div class="col-sm-9">
            <input type="text" name="short_title" value="" id="project-short-title" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label for="project-description" class="col-sm-3 control-label">{{ trans('admin.gallery.projects.description') }}</label>
        <div class="col-sm-9">

            <textarea name="description" id="project-description" class="form-controll ckeditor" rows="10" cols="80"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="logo" class="col-sm-3 control-label">{{trans('admin.gallery.projects.logo')}}</label>
        <div class="col-sm-9">
            <input type="hidden" class="existing" name="logo_existing" id="project-logo_existing">
            <input type="file" name="logo" id="logo">
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox col-sm-offset-3">
            <input type="hidden" name="active" id="project-active-hidden" value="0">
            <label><input type="checkbox" name="active" id="active" value="1">{{trans('admin.gallery.projects.active')}}</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <a href="{{route('admin.gallery.categories.projects.index', [$category->getKey()])}}" class="btn btn-primary">{{ trans('admin.back') }}</a>
            <button type="submit" class="btn btn-default submit-form">
                <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('admin.save') }}
            </button>
        </div>
    </div>
</form>
</span>