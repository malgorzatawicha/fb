@if (count($product->images)>0)
    <div class="row product-images">
        @foreach($product->images as $image )
            <div class="col-sm-3 thumb">
                    <a class="thumbnail" href="{{route('admin.products.images.show', ['product' => $product->slug, 'image' =>$image->id])}}">
                        <img class="img-responsive" src="/images/products/thumbnails/{{ 'thumb-'. $image->image_name . '.' .
           $image->image_extension . '?'. 'time='. time() }}">
                    </a>
                <div class="btn-group btn-group-justified">
                    <a class="btn btn-primary btn-sm" title="edit" data-imageid="{{$image->id}}" href="#">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" title="delete" data-imageid="{{$image->id}}" href="#">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>{{trans('shop.product_image.no_records')}}</p>
@endif
