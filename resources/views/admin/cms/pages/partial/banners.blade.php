<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.create') }}" href="#"
           data-page="{{json_encode($page)}}"
           data-submit-action="{{ route('admin.cms.pages.banners.store', [$page->slug]) }}"
           data-toggle="modal" data-target="#createBannerModal" >
            {{ trans('admin.create') }}
        </a>
    </div>
    <h5>Banners</h5>
</div>
<div class="panel-body">
    @if (count($page->banners)>0)
        <div class="row page-banners">
            @foreach($page->banners as $banner )
                <div class="col-sm-3 thumb">
                    <a class="thumbnail" href="{{route('admin.cms.pages.banners.show', ['page' => $page->slug, 'banner' =>$banner->id])}}">
                        <img class="img-responsive" src="{{$banner->path }}{{ $banner->filename . '?'. 'time='. time() }}">
                    </a>
                    <form action="{{route('admin.cms.pages.banners.destroy', ['page' => $page->slug, 'banner' => $banner->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-primary btn-sm" title="edit" href="#"
                               data-banner="{{json_encode($banner)}}"
                               data-page="{{json_encode($banner->page)}}"
                               data-toggle="modal" data-target="#editBannerModal" >
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>

                            <a class="btn btn-danger btn-sm" title="delete" data-bannerid="{{$banner->id}}" onclick="$(this).parent().parent().submit()">
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
@include('admin.cms.pages.partial.banners.create_modal')
@include('admin.cms.pages.partial.banners.edit_modal')