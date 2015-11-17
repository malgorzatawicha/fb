@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.pages.create')}}" class="btn btn-primary">Create</a></div>
            <h4>Pages</h4>
        </div>
        <div class="panel-body">
            @if (count($pages) > 0)
                <table class="table table-striped">
                    <thead><tr><th>ID</th><th>Title</th><th>Body</th><th>&nbsp;</th></tr></thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->title}}</td>
                            <td>{!! $page->body !!}</td>
                            <td>
                                <form action="{{route('admin.pages.destroy', [$page->slug])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-xs btn-success" href="{{route('admin.pages.show', [$page->slug])}}">View</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('admin.pages.edit', [$page->slug])}}">Edit</a>
                                    <button class="btn btn-xs btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No pages</p>
            @endif
        </div>
    </div>

@stop