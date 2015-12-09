@if (count($product->images)>0)
    <div class="row">
        @foreach($product->images as $image )
            <div class="col-sm-4"> <a href="{{route('admin.products.images.show', ['product' => $product->slug, 'image' =>$image->id])}}">
                    <img src="/images/products/thumbnails/{{ 'thumb-'. $image->image_name . '.' .
           $image->image_extension . '?'. 'time='. time() }}"> </a></div>
        @endforeach
    </div>
@else
    <p>{{trans('shop.product_image.no_records')}}</p>
@endif
