@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('gallery.categories')}} - {{trans('admin.create')}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.gallery.categories.store') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div id="tree"></div>
                <div class="form-group">
                    <label for="category-name" class="col-sm-3 control-label">{{ trans('gallery.category.name') }}</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="category-name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.gallery.categories.index')}}" class="btn btn-primary">{{ trans('admin.back') }}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('gallery.category.add') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $("#tree").treeview({
            data: {!! createTree($categories, $parent) !!}
        });
    </script>
@stop