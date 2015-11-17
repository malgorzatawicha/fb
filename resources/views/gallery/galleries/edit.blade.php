@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('gallery.galleries')}} - {{trans('gallery.gallery.update')}} {{$gallery->name}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.galleries.update', [$gallery->slug]) }}" method="POST" class="form-horizontal">
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <label for="gallery-name" class="col-sm-3 control-label">{{trans('gallery.gallery.name')}}</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$gallery->name}}" name="name" id="gallery-name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.galleries.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> {{trans('gallery.gallery.save')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
