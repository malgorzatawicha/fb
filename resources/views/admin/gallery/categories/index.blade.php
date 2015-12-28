@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a id="destroy-category" data-href="{{route('admin.gallery.categories.destroy')}}" href="#" class="btn btn-danger btn-disabled disabled">{{ trans('admin.delete') }}</a></div>
            <div class="pull-right"><a id="edit-category" data-href="{{route('admin.gallery.categories.edit')}}" href="#" class="btn btn-default btn-disabled disabled">{{ trans('admin.edit') }}</a></div>
            <div class="pull-right"><a id="create-category" data-href="{{route('admin.gallery.categories.create')}}" href="#" class="btn btn-primary">{{ trans('admin.create') }}</a></div>
            <h4>{{trans('gallery.categories')}}</h4>
        </div>
        <div class="panel-body">
            @if (count($categories) > 0)
                <div id="tree"></div>
            @else
                <p>{{trans('gallery.gallery.no_records')}}</p>
            @endif
        </div>
    </div>

@stop

@section('scripts')
    <script>
        var $tree = $("#tree");
        $tree.treeview({
            data: {!! createTree($categories) !!}
        });

        $("#create-category").click(function(e){
            e.preventDefault();
            var url = $(this).attr("href");
            var node = $("#tree").treeview('getSelected');
            if (node.length) {
                $(this).attr('href', url + '?node=' + node[0].id);
            }

            location.href = $(this).attr('href');
        });

        var $editCategory = $("#edit-category");
        var $destroyCategory = $("#destroy-category");

        $tree.on('nodeUnselected', function(event, data) {
            $editCategory.attr('href', '#');
            $destroyCategory.attr('href', '#');
            $editCategory.addClass('btn-disabled').addClass('disabled');
            $destroyCategory.addClass('btn-disabled').addClass('disabled');
        });
        $tree.on('nodeSelected', function(event, data) {
            $editCategory.addClass('btn-disabled').addClass('disabled');
            $destroyCategory.addClass('btn-disabled').addClass('disabled');
            if (data.id) {
                $editCategory.attr('href', decodeURI($editCategory.data('href')).replace("\{categories\}", data.id));
                $destroyCategory.attr('href', decodeURI($destroyCategory.data('href')).replace("\{categories\}", data.id));
                $editCategory.removeClass('btn-disabled').removeClass('disabled');
                $destroyCategory.removeClass('btn-disabled').removeClass('disabled');
            }
        });
    </script>
@stop