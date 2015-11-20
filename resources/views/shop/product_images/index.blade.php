@extends('layouts.admin')

@section('content')
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="pull-right"><a href="{{route('admin.products.images.create', ['product'=>$product->slug])}}" class="btn btn-primary">{{ trans('admin.create') }}</a></div>
                <h4>{{trans('shop.product_images')}}</h4>
            </div>
            <div class="panel-body">
                @if (count($product->images)>0)
                    <table class="table">
                        <tr>
                            <th>Id </th>
                            <th>Name </th>
                            <th>Thumbnail </th>
                            <th></th>
                        </tr>
                        @foreach($product->images as $image )

                            <tr>
                                <td>{{ $image->id }}  </td>
                                <td>{{ $image->image_name }} </td>

                                <td>
                                    <form action="{{route('admin.products.images.destroy', ['product'=>$product->slug, 'image' => $image->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{route('admin.products.images.show', ['product' => $product->slug, 'image' =>$image->id])}}">
                                            <img src="/images/products/thumbnails/{{ 'thumb-'. $image->image_name . '.' .
                               $image->image_extension . '?'. 'time='. time() }}"> </a>
                                        <a class="btn btn-xs btn-primary" href="{{route('admin.products.images.edit', ['product' => $product->slug, 'image' =>$image->id])}}">{{trans('admin.edit')}}</a>
                                        <button class="btn btn-xs btn-danger" onclick="return ConfirmDelete();">{{trans('admin.delete')}}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p>{{trans('shop.product_image.no_records')}}</p>
                @endif


            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

@endsection
