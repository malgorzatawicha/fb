@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.products.create')}}" class="btn btn-primary">Create</a></div>
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
                                <form action="{{route('admin.products.destroy', [$product->slug])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-xs btn-success" href="{{route('admin.products.show', [$product->slug])}}">View</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('admin.products.edit', [$product->slug])}}">Edit</a>
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