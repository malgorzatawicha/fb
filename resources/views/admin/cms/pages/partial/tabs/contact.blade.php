<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.pages.contacts.create') }}" href="#"
           data-page="{{escapeJson($page)}}"
           data-submit-action="{{ route('admin.cms.pages.contacts.store', [$page->slug]) }}"
           data-toggle="modal" data-target="#contactModal" >
            {{ trans('admin.pages.contacts.create') }}
        </a>
    </div>
    <h5>{{trans('admin.pages.types.contact')}}</h5>
</div>
<div class="panel-body">
    @if (count($page->contacts)>0)

        <table class="table table-striped">
            <thead><tr><th>{{trans('admin.pages.contacts.name')}}</th><th>{{trans('admin.pages.contacts.body')}}</th><th>&nbsp;</th></tr></thead>
            <tbody>
            @foreach($page->contacts as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td>{!! $contact->body !!}</td>
                    <td style="width: 100px;">
                        @if($contact->active)
                            <form action="{{route('admin.cms.pages.contacts.deactivate', ['page' => $page->slug, 'contact' =>$contact->getKey()])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <button class="btn btn-sm btn-warning">{{trans('admin.deactivate')}}</button>
                            </form>
                        @else
                            <form action="{{route('admin.cms.pages.contacts.activate', ['page' => $page->slug, 'contact' =>$contact->getKey()])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <button class="btn btn-sm btn-warning">{{trans('admin.activate')}}</button>
                            </form>
                        @endif
                    </td>
                    <td style="width: 250px;">
                        <form action="{{route('admin.cms.pages.contacts.destroy', ['page' => $page->slug, 'contact' =>$contact->getKey()])}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a class="btn btn-primary btn-sm" title="edit" href="#"
                               data-contact="{{escapeJson($contact)}}"
                               data-page="{{escapeJson($contact->page)}}"
                               data-edit-title="{{trans('admin.pages.contacts.edit')}}"
                               data-submit-action="{{ route('admin.cms.pages.contacts.update', [ 'pages' => $page->getKey(), 'contact' => $contact->getKey()]) }}"
                               data-toggle="modal" data-target="#contactModal" >
                                {{trans('admin.pages.contacts.edit')}}
                            </a>
                            <button class="btn btn-sm btn-danger" title="delete" data-bannerid="{{$contact->getKey()}}" onclick="$(this).parent().parent().submit()">
                                {{trans('admin.delete')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>{{trans('admin.pages.contacts.no_records')}}</p>
    @endif
</div>
@include('admin.cms.pages.partial.contact_modal')