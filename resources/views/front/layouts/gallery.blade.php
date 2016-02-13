@extends('front.layouts.page')
@section('page_description')
    @if($page->logo_filename)
        <div class="row"><img title="{{$page->title}}" alt="logo" src="{{$page->logo_path}}/{{$page->logo_filename}}" width="100%"></div>
    @endif

    @if($page->description)
        <div class="row">{!! $page->description !!}</div>
    @endif
    <div class="tree" id="tree"></div>
@endsection
@section('page_content')
    <div class="breadcrumb">Home > @yield('breadcrumb')</div>
    <div class="row mobile-tree" id="tree"></div>
    <div class="row row-content">
        @include('front.main.partial.banner')
        <h1>{{$page->title}}</h1>
        {!! $page->body !!}
        @yield('gallery_content')
    </div>

@endsection

@section('scripts')
    <script>
        var $tree = $(".tree");
        $tree.treeview({
            enableLinks: true,
            data: {!! createFrontTree($categories, $page, $category) !!}
        });

        var selectedNodes = [];
        @if($category)
             selectedNodes = JSON.parse('{!! json_encode($category->pathIn($page, 'slug')) !!}');
        @endif

        $tree = $(".mobile-tree");
        $tree.treeview({
            enableLinks: true,
            levels: 0,
            selectable: false,
            data: {!! createMobileFrontTree($categories, $page, $category) !!}
        });
        $tree.on('nodeExpanded', function(event, data) {
            for (var i in data.nodes) {
                var node = data.nodes[i];
                if ($.inArray(node.id, selectedNodes) != -1) {
                    $tree.treeview('selectNode', [ node.nodeId, {silent: true} ]);
                    $tree.treeview('unselectNode', [ data.nodeId, {silent: true} ]);
                }
            }
        });
        $tree.on('nodeCollapsed', function(event, data) {
            if ($.inArray(data.id, selectedNodes) != -1) {
                $tree.treeview('selectNode', [ data.nodeId, { silent: true } ]);
            }
        });
    </script>
    @yield('gallery_scripts')
@endsection