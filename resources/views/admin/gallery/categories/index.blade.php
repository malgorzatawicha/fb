@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <form data-href="{{route('admin.gallery.categories.destroy')}}" action="#" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button id="destroy-category" class="btn btn-danger btn-disabled disabled" disabled>{{trans('admin.delete')}}</button>
                </form>
            </div>
            <div class="pull-right"><a id="projects-category" data-href="{{route('admin.gallery.categories.projects.index')}}" disabled href="#" class="btn btn-default btn-disabled disabled">{{ trans('admin.projects') }}</a></div>
            <div class="pull-right"><a id="edit-category" data-href="{{route('admin.gallery.categories.edit')}}" disabled href="#" class="btn btn-default btn-disabled disabled">{{ trans('admin.edit') }}</a></div>
            <div class="pull-right"><a id="create-category" data-href="{{route('admin.gallery.categories.create')}}" href="{{route('admin.gallery.categories.create')}}" class="btn btn-primary">{{ trans('admin.create') }}</a></div>
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
    <script src="{{ elixir('js/admin/gallery.js') }}"></script>
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
        var $projectsCategory = $("#projects-category");
        var $destroyCategory = $("#destroy-category");

        $tree.on('nodeUnselected', function() {
            $editCategory.attr('href', '#');
            $projectsCategory.attr('href', '#');
            $destroyCategory.parent().attr('action', '#');
            disableButton($editCategory);
            disableButton($projectsCategory);
            disableButton($destroyCategory);
        });
        $tree.on('nodeSelected', function(event, data) {
            disableButton($editCategory);
            disableButton($projectsCategory);
            disableButton($destroyCategory);
            if (data.id) {
                $editCategory.attr('href', decodeURI($editCategory.data('href')).replace("\{categories\}", data.id));
                $projectsCategory.attr('href', decodeURI($projectsCategory.data('href')).replace("\{categories\}", data.id));
                $destroyCategory.parent().attr('action', decodeURI($destroyCategory.parent().data('href')).replace("\{categories\}", data.id));
                enableButton($editCategory);
                enableButton($projectsCategory);
                enableButton($destroyCategory);
            }
        });

        function enableButton($button)
        {
            $button.removeClass('btn-disabled').removeClass('disabled').removeAttr('disabled');
        }

        function disableButton($button)
        {
            $button.addClass('btn-disabled').addClass('disabled').prop('disabled', true);
        }
    </script>
@stop