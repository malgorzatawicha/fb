@extends('admin.layouts.default')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ trans('gallery.categories') }} - {{trans('gallery.category.update')}} {{$category->name}}</h4>
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('admin.gallery.categories.update', [$category->id]) }}" method="POST" class="form-horizontal">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div id="tree"></div>
                <input type="hidden" name="parent" id='parent' value="">
                <div class="form-group">
                    <label for="category-name" class="col-sm-3 control-label">{{trans('gallery.category.name')}}</label>
                    <div class="col-sm-6">
                        <input type="text" value="{{$category->name}}" name="name" id="category-name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <a href="{{route('admin.gallery.categories.index')}}" class="btn btn-primary">{{trans('admin.back')}}</a>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> {{trans('gallery.category.save')}}
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