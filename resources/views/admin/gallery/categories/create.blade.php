@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('admin.gallery.categories.create')}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.gallery.categories.store') }}" method="POST" class="form-horizontal category-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="category-parent" class="col-sm-3 control-label">{{trans('admin.gallery.categories.parent')}}</label>
                    <div class="col-sm-9">
                        <div id="tree"></div>
                        <input type="hidden" name="parent" id='parent' value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category-name" class="col-sm-3 control-label">{{ trans('admin.gallery.categories.name') }} <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="category-name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category-title" class="col-sm-3 control-label">{{ trans('admin.gallery.categories.title') }} <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="title" id="category-title" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category-description" class="col-sm-3 control-label">{{ trans('admin.gallery.categories.description') }}</label>
                    <div class="col-sm-9">

                        <textarea name="description" id="category-description" class="form-controll ckeditor" rows="10" cols="80"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo" class="col-sm-3 control-label">{{trans('admin.gallery.categories.logo')}}</label>
                    <div class="col-sm-9">
                        <input type="file" name="logo" id="logo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox col-sm-offset-3">
                        <input type="hidden" name="active" value="0">
                        <label><input type="checkbox" name="active" id="active" value="1">{{trans('admin.gallery.categories.active')}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <a href="{{route('admin.gallery.categories.index')}}" class="btn btn-primary">{{ trans('admin.back') }}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> {{ trans('admin.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ elixir('js/admin/gallery.js') }}"></script>
    <script>
        $("#tree").treeview({
            data: {!! createTree($categories, $parent) !!}
        });

        @if($parent)
            $('#parent').val({{$parent->getKey()}});
        @endif

        var selectedNodes = $('#tree').treeview('getSelected');
        if (selectedNodes.length) {
            var selected = selectedNodes[0];
            $("#tree").treeview('revealNode', selected);
        }
        $('#tree').on('nodeSelected', function(event, data) {
            $('#parent').val(data.id);
        });
    </script>
@stop