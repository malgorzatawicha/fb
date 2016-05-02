@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.gallery.projects.create')}}" class="btn btn-primary">{{trans('admin.gallery.projects.create')}}</a></div>
            <h4>{{trans('admin.gallery.categories.projects')}}</h4>
        </div>
        <div class="panel-body">
            @if (count($projects) > 0)
                <table class="table table-striped">
                    <thead><tr><th>{{trans('admin.gallery.projects.title')}}</th><th>{{trans('admin.gallery.projects.description')}}</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->title}}</td>
                            <td>{!! $project->description !!}</td>
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