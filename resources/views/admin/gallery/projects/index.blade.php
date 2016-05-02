@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.gallery.projects.create')}}" class="btn btn-primary">{{trans('admin.gallery.projects.create')}}</a></div>
            <h4>{{trans('admin.gallery.categories.projects')}}</h4>
        </div>
        <div class="panel-body">
            @if (count($projects) > 0)

                <table class="table table-striped table-hover">
                    <thead><tr><th>&nbsp;</th><th>{{trans('admin.gallery.projects.category')}}</th><th>{{trans('admin.gallery.projects.title')}}</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>
                    <tbody class="sortable" data-entityname="projects">
                    @foreach ($projects as $project)
                        <tr data-itemId="{{{ $project->getKey() }}}">
                            <td class="sortable-handle"><span class="glyphicon glyphicon-sort"></span></td>
                            <td>{{$project->category->title}}</td>
                            <td>{{$project->title}}</td>
                            <td style="width: 100px;">
                                @if($project->active)
                                    <form action="{{route('admin.gallery.projects.deactivate', [ 'projects'=>$project->getKey()])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-sm btn-warning">{{trans('admin.deactivate')}}</button>
                                    </form>
                                @else
                                    <form action="{{route('admin.gallery.projects.activate', ['projects'=>$project->getKey()])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-sm btn-warning">{{trans('admin.activate')}}</button>
                                    </form>
                                @endif
                            </td>
                            <td style="width: 250px;">
                                <form action="{{route('admin.gallery.projects.destroy', ['projects'=>$project->getKey()])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-sm btn-primary" href="{{route('admin.gallery.projects.edit', ['projects'=>$project->getKey()])}}">{{trans('admin.gallery.projects.edit')}}</a>
                                    <button class="btn btn-sm btn-danger">{{trans('admin.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>{{trans('admin.gallery.projects.no_records')}}</p>
            @endif
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

        var changePosition = function(requestData){

            $.ajax({
                'url': '{{route('admin.sort')}}',
                'type': 'POST',
                'data': requestData
            });
        };

        $(document).ready(function(){
            var $sortableTable = $('.sortable');
            if ($sortableTable.length > 0) {
                $sortableTable.sortable({
                    handle: '.sortable-handle',
                    axis: 'y',
                    update: function(a, b){

                        var entityName = $(this).data('entityname');
                        var $sorted = b.item;

                        var $previous = $sorted.prev();
                        var $next = $sorted.next();

                        if ($previous.length > 0) {
                            changePosition({
                                parentId: $sorted.data('parentid'),
                                type: 'moveAfter',
                                entityName: entityName,
                                id: $sorted.data('itemid'),
                                positionEntityId: $previous.data('itemid')
                            });
                        } else if ($next.length > 0) {
                            changePosition({
                                parentId: $sorted.data('parentid'),
                                type: 'moveBefore',
                                entityName: entityName,
                                id: $sorted.data('itemid'),
                                positionEntityId: $next.data('itemid')
                            });
                        }
                    },
                    cursor: "move"
                });
            }
            $('.sortable td').each(function(){
                $(this).css('width', $(this).width() +'px');
            });
        });
    </script>
@stop