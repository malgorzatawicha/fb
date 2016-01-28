@extends('admin.layouts.default')
@section('styles')

@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Site edit</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.site.update') }}" method="POST" class="form-horizontal"  enctype="multipart/form-data">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <label for="site-title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$site->title}}" name="title" id="site-title" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site-description" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-6">
                        <textarea name="description" id="site-description" class="form-control" rows="2" cols="80">{{$site->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site-keywords" class="col-sm-3 control-label">Keywords</label>
                    <div class="col-sm-6">
                        <textarea name="keywords" id="site-keywords" class="form-control" rows="2" cols="80">{{$site->keywords}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site-footer" class="col-sm-3 control-label">Footer</label>
                    <div class="col-sm-6">
                        <textarea name="footer" id="site-footer" class="form-control" rows="2" cols="80">{{$site->footer}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="favicon" class="col-sm-3 control-label">Favicon:</label>
                    <div class="col-sm-6 favicon">
                        <input type="file" name="favicon" id="favicon">
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" id="banner-path" value="{{$site->banner_path}}">
                    <input type="hidden" id="banner-filename" value="{{$site->banner_filename}}">
                    <label for="banner" class="col-sm-3 control-label">Banner File name:</label>
                    <div class="col-sm-6">
                        <input type="file" name="banner" id="banner">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.home')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> Save
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/js/admin/site.js"></script>
@stop
