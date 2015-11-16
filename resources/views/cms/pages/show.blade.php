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
            <h4>{{$page->title}}</h4>
        </div>
        <div class="panel-body">
          {!! $page->body !!}
        </div>

        <div class="centered">
            <a href="{{route('pages.index')}}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop