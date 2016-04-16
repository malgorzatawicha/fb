<div class="row center-block">
    @if(count($page->contacts) > 0)
        @foreach($page->contacts as $contact)
            <div class="col-lg-6">
                <h5>{{$contact->name}}</h5>
                {!! $contact->body !!}
            </div>
        @endforeach
    @endif
</div>