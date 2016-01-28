@extends('admin.layouts.default')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ trans('cms.pages') }} - {{trans('cms.page.update')}} {{$page->title}}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <ul role="tablist" class="nav nav-pills nav-stacked col-sm-3" id="pageTabs">
                    <li class="active" role="presentation">
                        <a aria-expanded="true" aria-controls="basics" data-toggle="tab" role="tab" id="basics-tab" href="#basics">Basics</a>
                    </li>
                    <li role="presentation" class="">
                        <a aria-controls="banners" data-toggle="tab" id="banners-tab" role="tab" href="#banners" aria-expanded="false">Banners</a>
                    </li>
                    @if(\View::exists('admin.cms.pages.partial.tabs.' . $page->type))
                        <li role="presentation" class="">
                            <a aria-controls="custom" data-toggle="tab" id="custom-tab" role="tab" href="#custom" aria-expanded="false">{{ucfirst($page->type)}} - customs</a>
                        </li>
                    @endif
                </ul>

                <div class="tab-content col-sm-9" id="pageTabsContent">
                    <div aria-labelledby="basics-tab" id="basics" class="tab-pane fade active in" role="tabpanel">
                        @include('admin.cms.pages.partial.edit_basics', ['page' => $page])
                    </div>
                    <div aria-labelledby="banners-tab" id="banners" class="tab-pane fade" role="tabpanel">
                        @include('admin.cms.pages.partial.banners', ['page'=>$page])
                    </div>

                    @if(\View::exists('admin.cms.pages.partial.tabs.' . $page->type))
                        <div aria-labelledby="custom-tab" id="custom" class="tab-pane fade {{$page->type}}" role="tabpanel">
                            @include('admin.cms.pages.partial.tabs.' . $page->type)
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/js/admin/pages.js"></script>
@stop