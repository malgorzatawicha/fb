@extends('front.layouts.page')
@section('page_description')
    @if($page->logo_id)
        <div class="row"><img title="{{$page->title}}" alt="logo" src="{{route('image', ['fileId' => $page->logo_id])}}" width="100%"></div>
    @endif

    @if($page->description)
        <div class="row page-description">{!! $page->description !!}</div>
    @endif
    <div class="tree" id="tree"></div>
@endsection
@section('page_content')
    <div class="breadcrumb"><a href="/">{{$site->breadcrumb}}</a> / @yield('breadcrumb')</div>
    <div class="row mobile-tree" id="tree"></div>
    <div class="row row-content">
        @include('front.main.partial.banner')
{{--        <h1>{{$category->title}}</h1>--}}
        {!! $page->body !!}
        @yield('gallery_content')
    </div>

@endsection

@section('scripts')
    <script>
        var $tree = $(".tree");
        $tree.treeview({
            enableLinks: true,
            expandIcon: 'fa fa-caret-down',
            collapseIcon: 'fa fa-caret-right',
            borderColor: '#444444',
            onhoverColor: 'rgba(68,68,68, 0.5)',
            selectedBackColor: 'rgba(0, 252, 255, 0.3)',
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
            expandIcon: 'fa fa-caret-down',
            collapseIcon: 'fa fa-caret-right',
            borderColor: '#444444',
            onhoverColor: 'rgba(68,68,68, 0.5)',
            selectedBackColor: 'rgba(0, 252, 255, 0.3)',
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