<div class="panel-heading">
    <div class="pull-right">
        <a class="btn btn-primary" title="{{ trans('admin.create') }}" href="#"
           data-page="{{json_encode($page)}}"
           data-submit-action="{{ route('admin.cms.pages.contacts.store', [$page->slug]) }}"
           data-toggle="modal" data-target="#createContactModal" >
            {{ trans('admin.create') }}
        </a>
    </div>
    <h5>Contacts</h5>
</div>
<div class="panel-body">
    @if (count($page->contacts)>0)

        <table class="table table-striped">
            <thead><tr><th>{{trans('cms.page.contact.name')}}</th><th>{{trans('cms.page.contact.body')}}</th><th>&nbsp;</th></tr></thead>
            <tbody>
            @foreach($page->contacts as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td>{!! $contact->body !!}</td>
                    <td>
                        @if($contact->active)
                            <form action="{{route('admin.cms.pages.contacts.deactivate', ['page' => $page->slug, 'contact' =>$contact->getKey()])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <button class="btn btn-xs btn-warning">{{trans('admin.deactivate')}}</button>
                            </form>
                        @else
                            <form action="{{route('admin.cms.pages.contacts.activate', ['page' => $page->slug, 'contact' =>$contact->getKey()])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <button class="btn btn-xs btn-warning">{{trans('admin.activate')}}</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <form action="{{route('admin.cms.pages.contacts.destroy', ['page' => $page->slug, 'contact' =>$contact->getKey()])}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a class="btn btn-primary btn-sm" title="edit" href="#"
                               data-contact="{{json_encode($contact)}}"
                               data-page="{{json_encode($contact->page)}}"
                               data-toggle="modal" data-target="#editContactModal" >
                                Edit
                            </a>
                            <button class="btn btn-xs btn-danger" title="delete" data-bannerid="{{$contact->getKey()}}" onclick="$(this).parent().parent().submit()">
                                {{trans('admin.delete')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>    @else
        <p>{{trans('cms.pages.contacts.no_records')}}</p>
    @endif
</div>
@include('admin.cms.pages.partial.contacts.create_modal')
@include('admin.cms.pages.partial.contacts.edit_modal')