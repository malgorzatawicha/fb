@extends('admin.layouts.default')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ trans('gallery.categories') }} - {{trans('gallery.category.update')}} {{$category->name}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.gallery.categories.update', [$category->id]) }}" method="POST" class="form-horizontal category-form" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <span id="category" data-category="{{$category}}"></span>
                <div id="tree"></div>
                <input type="hidden" name="parent" id='parent' value="">
                <div class="form-group">
                    <label for="category-name" class="col-sm-3 control-label">{{trans('gallery.category.name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" value="{{$category->name}}" name="name" id="category-name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category-title" class="col-sm-3 control-label">{{ trans('gallery.category.title') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" value="{{$category->title}}" id="category-title" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category-description" class="col-sm-3 control-label">{{ trans('gallery.category.description') }}</label>
                    <div class="col-sm-9">

                        <textarea name="description" id="category-description" class="form-controll ckeditor" rows="10" cols="80">{{$category->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo" class="col-sm-3 control-label">logo:</label>
                    <div class="col-sm-9">
                        <input type="hidden" class="existing" name="logo_existing" id="category-logo_existing">
                        <input type="file" name="logo" id="logo" data-image="{{json_encode([
                                'big' =>route('admin.image', ['fileId' => $category->logo_id]),
                                 'thumb' => route('admin.image', ['fileId' => $category->logo_id, 'width' => 213, 'height' => 160])
                               ])}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox col-sm-offset-3">
                        <input type="hidden" name="active" value="0">
                        <label><input type="checkbox" @if (!empty($category->active)) checked="checked" @endif name="active" id="category-active" value="1">Is Active</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
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
    <script src="{{ elixir('js/admin/gallery.js') }}"></script>
    <script>
        $("#tree").treeview({
            data: {!! createTree($categories, $parent) !!}
        });

        @if(!empty($parent))
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