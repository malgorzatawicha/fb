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
            <div class="pull-right"><a href="{{route('products.create')}}" class="btn btn-primary">Create</a></div>
            <h4>Products</h4>
        </div>
        <div class="panel-body">
            @if (count($products) > 0)
                <table class="table table-striped">
                    <thead><tr><th>ID</th><th>Name</th><th>Description</th><th>&nbsp;</th></tr></thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{!! $product->description !!}</td>
                            <td>
                                <form action="{{route('products.destroy', [$product->slug])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-xs btn-success" href="{{route('products.show', [$product->slug])}}">View</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('products.edit', [$product->slug])}}">Edit</a>
                                    <button class="btn btn-xs btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No products</p>
            @endif
        </div>
    </div>

@stop