@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.products.create')}}" class="btn btn-primary">{{ trans('admin.create') }}</a></div>
            <h4>{{trans('shop.products')}}</h4>
        </div>
        <div class="panel-body">
            @if (count($products) > 0)
                <table class="table table-striped">
                    <thead><tr><th>{{trans('shop.product.id')}}</th><th>{{trans('shop.product.name')}}</th><th>{{trans('shop.product.description')}}</th><th>&nbsp;</th></tr></thead>
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
                                    <a class="btn btn-xs btn-success" href="{{route('admin.products.show', [$product->slug])}}">{{trans('admin.view')}}</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('admin.products.edit', [$product->slug])}}">{{trans('admin.edit')}}</a>
                                    <button class="btn btn-xs btn-danger">{{trans('admin.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>{{trans('shop.products.no_records')}}</p>
            @endif
        </div>
    </div>

@stop