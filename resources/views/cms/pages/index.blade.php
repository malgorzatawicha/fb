@extends('layouts.admin')

@section('navbar')
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">Project name</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Pages
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
                                <form action="{{route('pages.destroy', [$page->id])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-xs btn-success" href="{{route('pages.show', [$page->id])}}">View</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('pages.edit', [$page->id])}}">Edit</a>
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