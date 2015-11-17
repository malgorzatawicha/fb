@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.galleries.create')}}" class="btn btn-primary">{{ trans('admin.create') }}</a></div>
            <h4>{{trans('gallery.galleries')}}</h4>
        </div>
        <div class="panel-body">
            @if (count($galleries) > 0)
                <table class="table table-striped">
                    <thead><tr><th>{{trans('gallery.gallery.id')}}</th><th>{{trans('gallery.gallery.name')}}</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>
                    <tbody>
                    @foreach($galleries as $gallery)
                        <tr>
                            <td>{{$gallery->id}}</td>
                            <td>{{$gallery->name}}</td>
                            <td>
                                @if($gallery->active)
                                    <form action="{{route('admin.galleries.deactivate', [$gallery->slug])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-xs btn-warning">{{trans('admin.deactivate')}}</button>
                                    </form>
                                @else
                                    <form action="{{route('admin.galleries.activate', [$gallery->slug])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-xs btn-warning">{{trans('admin.activate')}}</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{route('admin.galleries.destroy', [$gallery->slug])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-xs btn-success" href="{{route('admin.galleries.show', [$gallery->slug])}}">{{trans('admin.view')}}</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('admin.galleries.edit', [$gallery->slug])}}">{{trans('admin.edit')}}</a>
                                    <button class="btn btn-xs btn-danger">{{trans('admin.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>{{trans('gallery.gallery.no_records')}}</p>
            @endif
        </div>
    </div>

@stop