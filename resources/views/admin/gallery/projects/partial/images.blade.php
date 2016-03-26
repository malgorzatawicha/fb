<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.create') }}" href="#"
           data-category="{{json_encode($category)}}"
           data-project="{{json_encode($project)}}"
           data-submit-action="{{ route('admin.gallery.categories.projects.images.store', ['categories'=>$category->getKey(), 'projects' => $project->getKey()]) }}"
           data-toggle="modal" data-target="#imageModal" >
            {{ trans('admin.create') }}
        </a>
    </div>
    <h5>Images</h5>
</div>
<div class="panel-body">
    @if (count($project->images)>0)
        <div class="row project-images">
            @foreach($project->images as $image )
                <div class="col-sm-3 thumb">
                    <a class="thumbnail" href="{{route('admin.gallery.categories.projects.images.show', ['categories' => $category->getKey(), 'projects' => $project->getKey(), 'images' =>$image->getKey()])}}">
                        <img class="img-responsive"
                             src="{{route('admin.image', ['fileId' => !empty($image->thumb_id)?$image->thumb_id:$image->image_id, 'width' => 150, 'height' => 150, 'crop' => true])}}">
                    </a>
                    <form action="{{route('admin.gallery.categories.projects.images.destroy', ['categories' => $category->getKey(), 'projects' => $project->getKey(), 'images' =>$image->getKey()]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-primary btn-sm" title="edit" href="#"
                               data-image="{{json_encode($image)}}"
                               data-image-src="{{route('admin.image', ['fileId' => $image->image_id, 'width' => 213, 'height'=> 160])}}"
                               data-thumb-src="{{route('admin.image', ['fileId' => $image->thumb_id, 'width' => 160, 'height'=> 160])}}"
                               data-project="{{json_encode($project)}}"
                               data-category="{{json_encode($category)}}"
                               data-submit-action="{{ route('admin.gallery.categories.projects.images.update', ['categories'=>$category->getKey(), 'projects' => $project->getKey(), 'images' => $image->getKey()]) }}"
                               data-toggle="modal" data-target="#imageModal" >
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>

                            <a class="btn btn-danger btn-sm" title="delete" data-imageid="{{$image->getKey()}}" onclick="$(this).parent().parent().submit()">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p>{{trans('cms.pages.banners.no_records')}}</p>
    @endif
</div>
@include('admin.gallery.projects.partial.image_modal')
