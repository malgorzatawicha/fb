@extends('admin.layouts.default')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ trans('cms.pages') }} - {{trans('cms.page.update')}} {{$page->title}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.cms.pages.update', [$page->slug]) }}" method="POST" class="form-horizontal">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <label for="page-title" class="col-sm-3 control-label">{{trans('cms.page.title')}}</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$page->title}}" name="title" id="page-title" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="page-body" class="col-sm-3 control-label">{{trans('cms.page.body')}}</label>
                    <div class="col-sm-6">
                        <textarea name="body" id="page-body" class="form-controll ckeditor" rows="10" cols="80">{{$page->body}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.cms.pages.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> {{trans('cms.page.save')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
@stop