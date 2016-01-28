<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.create') }}" href="#"
           data-page="{{json_encode($page)}}"
           data-submit-action="{{ route('admin.cms.pages.friends.store', [$page->slug]) }}"
           data-toggle="modal" data-target="#createFriendModal" >
            {{ trans('admin.create') }}
        </a>
    </div>
    <h5>Banners</h5>
</div>
<div class="panel-body">
    @if (count($page->friends)>0)
        <div class="row page-banners">
            @foreach($page->friends as $friend )
                <div class="col-sm-3 thumb">
                    <a class="thumbnail" href="{{route('admin.cms.pages.friends.show', ['page' => $page->slug, 'friend' =>$friend->getKey()])}}">
                        <img class="img-responsive" src="{{$friend->path }}{{ $friend->filename . '?'. 'time='. time() }}">
                    </a>
                    <form action="{{route('admin.cms.pages.friends.destroy', ['page' => $page->slug, 'friend' => $friend->getKey()]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-primary btn-sm" title="edit" href="#"
                               data-friend="{{json_encode($friend)}}"
                               data-page="{{json_encode($friend->page)}}"
                               data-toggle="modal" data-target="#editFriendModal" >
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>

                            <a class="btn btn-danger btn-sm" title="delete" data-friendid="{{$friend->getKey()}}" onclick="$(this).parent().parent().submit()">
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
@include('admin.cms.pages.partial.friends.create_modal')
@include('admin.cms.pages.partial.friends.edit_modal')