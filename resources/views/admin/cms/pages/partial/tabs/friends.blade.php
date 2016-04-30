<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.pages.friends.create') }}" href="#"
           data-page="{{escapeJson($page)}}"
           data-submit-action="{{ route('admin.cms.pages.friends.store', [$page->slug]) }}"
           data-toggle="modal" data-target="#friendModal" >
            {{ trans('admin.pages.friends.create') }}
        </a>
    </div>
    <h4>{{trans('admin.pages.types.friends')}}</h4>
</div>
<div class="panel-body">
    @if (count($page->friends)>0)
        <div class="row page-friends">
            @foreach($page->friends as $friend )
                <div class="col-sm-3 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive"
                             src="{{route('admin.image', ['fileId' => $friend->file_id, 'width' => 150, 'height' => 150, 'crop' => true])}}">
                    </a>
                    <form action="{{route('admin.cms.pages.friends.destroy', ['page' => $page->slug, 'friend' => $friend->getKey()]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-primary btn-sm" title="edit" href="#"
                               data-friend="{{escapeJson($friend)}}"
                               data-file="{{json_encode([
                                'big' =>route('admin.image', ['fileId' => $friend->file_id]),
                                 'thumb' => route('admin.image', ['fileId' => $friend->file_id, 'width' => 213, 'height' => 160])
                               ])}}"
                               data-page="{{escapeJson($friend->page)}}"
                               data-edit-title="{{trans('admin.pages.friends.edit')}}"
                               data-submit-action="{{ route('admin.cms.pages.friends.update', [ 'pages' => $page->getKey(), 'friends' => $friend->getKey()]) }}"
                               data-toggle="modal" data-target="#friendModal" >
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>

                            <a class="btn btn-danger btn-sm" title="{{trans('admin.delete')}}" data-friendid="{{$friend->getKey()}}" onclick="$(this).parent().parent().submit()">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>

                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p>{{trans('admin.pages.friends.no_records')}}</p>
    @endif
</div>
@include('admin.cms.pages.partial.friend_modal')