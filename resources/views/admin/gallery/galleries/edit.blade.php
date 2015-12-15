@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('gallery.galleries')}} - {{trans('gallery.gallery.update')}} {{$gallery->name}}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <ul role="tablist" class="nav nav-pills nav-stacked col-sm-3" id="galleryTabs">
                    <li class="active" role="presentation">
                        <a aria-expanded="true" aria-controls="basics" data-toggle="tab" role="tab" id="basics-tab" href="#basics">Basics</a>
                    </li>
                    <li role="presentation" class="">
                        <a aria-controls="images" data-toggle="tab" id="images-tab" role="tab" href="#images" aria-expanded="false">Images</a>
                    </li>
                </ul>

                <div class="tab-content col-sm-9" id="galleryTabsContent">
                    <div aria-labelledby="basics-tab" id="basics" class="tab-pane fade active in" role="tabpanel">
                        @include('admin.gallery.galleries.partial.edit_basics', ['gallery' => $gallery])
                    </div>
                    <div aria-labelledby="images-tab" id="images" class="tab-pane fade" role="tabpanel">
                        @include('admin.gallery.galleries.partial.images', ['gallery'=>$gallery])
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/js/admin.galleries.js"></script>
@stop