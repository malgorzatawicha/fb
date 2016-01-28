<div class="row center-block">
    @if(count($page->friends) > 0)
        @foreach($page->friends->chunk(5) as $friends)
            <div class="row">
                @foreach($friends->slice(0,2) as $key => $friend)
                    <div class="col-md-4 @if($key == 0) col-md-offset-2 @endif">
                        <div class="panel">
                            <div class="panel-body">
                                <img src="{{$friend->path}}{{$friend->filename}}" title="{{$friend->name}}" style="width: 100%" />
                            </div>
                            <div class="panel-footer">
                                {{$friend->description}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                @foreach($friends->slice(2) as $key => $friend)
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-body">
                                <img src="{{$friend->path}}{{$friend->filename}}" title="{{$friend->name}}" style="width: 100%" />
                            </div>
                            <div class="panel-footer">
                                {{$friend->description}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>