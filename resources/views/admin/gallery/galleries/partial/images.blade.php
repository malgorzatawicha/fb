<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.create') }}" href="#"
           data-gallery="{{json_encode($gallery)}}"
           data-submit-action="{{ route('admin.gallery.galleries.images.store', [$gallery->slug]) }}"
           data-toggle="modal" data-target="#createImageModal" >
            {{ trans('admin.create') }}
        </a>
    </div>
    <h5>Images</h5>
</div>
<div class="panel-body">
    @if (count($gallery->images)>0)
        <div class="row gallery-images">
            @foreach($gallery->images as $image )
                <div class="col-sm-3 thumb">
                        <a class="thumbnail" href="{{route('admin.gallery.galleries.images.show', ['gallery' => $gallery->slug, 'image' =>$image->id])}}">
                            <img class="img-responsive" src="{{$image->image_thumbnail_path }}{{ $image->image_thumbnail_filename . '?'. 'time='. time() }}">
                        </a>
                    <form action="{{route('admin.gallery.galleries.images.destroy', ['gallery' => $gallery->slug, 'image' => $image->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-primary btn-sm" title="edit" href="#"
                           data-image="{{json_encode($image)}}"
                           data-gallery="{{json_encode($image->gallery)}}"
                           data-toggle="modal" data-target="#editImageModal" >
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>

                        <a class="btn btn-danger btn-sm" title="delete" data-imageid="{{$image->id}}" onclick="$(this).parent().parent().submit()">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>

                    </div>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p>{{trans('gallery.gallery_image.no_records')}}</p>
    @endif
</div>
@include('admin.gallery.galleries.partial.images.create_modal')
@include('admin.gallery.galleries.partial.images.edit_modal')