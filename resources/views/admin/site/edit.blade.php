@extends('admin.layouts.default')
@section('styles')

@stop
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('admin.menu.site_management')}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.site.update') }}" method="POST" class="form-horizontal site-form" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <span id="site" data-site="{{$site}}"></span>
                <div class="form-group">
                    <label for="site-title" class="col-sm-3 control-label">{{trans('admin.site.title')}} <span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$site->title}}" name="title" id="site-title" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site-breadcrumb" class="col-sm-3 control-label">{{trans('admin.site.breadcrumb')}}</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$site->breadcrumb}}" name="breadcrumb" id="site-breadcrumb" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site-description" class="col-sm-3 control-label">{{trans('admin.site.seo.description')}}</label>
                    <div class="col-sm-6">
                        <textarea name="description" id="site-description" class="form-control" rows="2" cols="80">{{$site->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site-keywords" class="col-sm-3 control-label">{{trans('admin.site.seo.keywords')}}</label>
                    <div class="col-sm-6">
                        <textarea name="keywords" id="site-keywords" class="form-control" rows="2" cols="80">{{$site->keywords}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site-footer" class="col-sm-3 control-label">{{trans('admin.site.footer')}}</label>
                    <div class="col-sm-6">
                        <textarea name="footer" id="site-footer" class="form-control" rows="2" cols="80">{{$site->footer}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="favicon" class="col-sm-3 control-label">{{trans('admin.site.favicon')}}</label>
                    <div class="col-sm-6 favicon">
                        <input type="hidden" class="existing" name="favicon_existing" id="site-favicon_existing">
                        <input type="file" name="favicon" id="favicon" data-image="{{json_encode(['big'=>'/favicon.ico', 'thumb'=>'/favicon.ico'])}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="banner" class="col-sm-3 control-label">{{trans('admin.site.banner')}}</label>
                    <div class="col-sm-6">
                        <input type="hidden" class="existing" name="banner_existing" id="site-banner_existing">
                        <input type="file" name="banner" id="banner" data-image="{{json_encode([
                                'big' =>route('admin.image', ['fileId' => $site->banner_id]),
                                 'thumb' => route('admin.image', ['fileId' => $site->banner_id, 'width' => 213, 'height' => 160])
                               ])}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.home')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span>{{trans('admin.save')}}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{elixir('js/admin/site.js')}}"></script>
@stop
