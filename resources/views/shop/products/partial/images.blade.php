<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.create') }}" href="#"
           data-product="{{json_encode($product)}}"
           data-toggle="modal" data-target="#createImageModal" >
            {{ trans('admin.create') }}
        </a>
    </div>
    <h5>Images</h5>
</div>
<div class="panel-body">
    @if (count($product->images)>0)
        <div class="row product-images">
            @foreach($product->images as $image )
                <div class="col-sm-3 thumb">
                        <a class="thumbnail" href="{{route('admin.products.images.show', ['product' => $product->slug, 'image' =>$image->id])}}">
                            <img class="img-responsive" src="/images/products/thumbnails/{{ 'thumb-'. $image->image_name . '.' .
               $image->image_extension . '?'. 'time='. time() }}">
                        </a>
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary btn-sm" title="edit" href="#"
                           data-image="{{json_encode($image)}}"
                           data-product="{{json_encode($image->product)}}"
                           data-toggle="modal" data-target="#editImageModal" >
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
</div>
@include('shop.products.partial.images.create_modal')
@include('shop.products.partial.images.edit_modal')