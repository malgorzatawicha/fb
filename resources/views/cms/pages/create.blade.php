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
            Pages - Create
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ route('pages.store') }}" method="POST" class="form-horizontal">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <label for="page-title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-6">
                        <input type="text" name="title" id="page-title" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="page-body" class="col-sm-3 control-label">Body</label>
                    <div class="col-sm-6">
                        <input type="text" name="body" id="page-body" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus-sign"></span> Add Page
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop