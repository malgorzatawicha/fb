@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.gallery.categories.projects.create', ['categories' => $category->getKey()])}}" class="btn btn-primary">{{trans('admin.create')}}</a></div>
            <h4>{{trans('gallery.projects')}} of {{$category->title}}</h4>
        </div>
        <div class="panel-body">
            @if (count($category->projects) > 0)
                <table class="table table-striped">
                    <thead><tr><th>{{trans('gallery.project.title')}}</th><th>{{trans('gallery.project.description')}}</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>
                    <tbody>
                    @foreach($category->projects as $project)
                        <tr>
                            <td>{{$project->title}}</td>
                            <td>{!! $project->description !!}</td>
                            <td>
                                @if($project->active)
                                    <form action="{{route('admin.gallery.categories.projects.deactivate', ['categories'=>$category->getKey(), 'projects'=>$project->getKey()])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-xs btn-warning">{{trans('admin.deactivate')}}</button>
                                    </form>
                                @else
                                    <form action="{{route('admin.gallery.categories.projects.activate', ['categories'=>$category->getKey(), 'projects'=>$project->getKey()])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-xs btn-warning">{{trans('admin.activate')}}</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{route('admin.gallery.categories.projects.destroy', ['categories'=>$category->getKey(), 'projects'=>$project->getKey()])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-xs btn-primary" href="{{route('admin.gallery.categories.projects.edit', ['categories'=>$category->getKey(), 'projects'=>$project->getKey()])}}">{{trans('admin.edit')}}</a>
                                    <button class="btn btn-xs btn-danger">{{trans('admin.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>{{trans('gallery.projects.no_records')}}</p>
            @endif
        </div>
    </div>

@stop