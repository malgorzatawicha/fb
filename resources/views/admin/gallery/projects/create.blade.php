@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('gallery.projects')}} of {{$category->title}} - {{trans('admin.create')}}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <ul role="tablist" class="nav nav-pills nav-stacked col-sm-3" id="projectTabs">
                    <li class="active" role="presentation">
                        <a aria-expanded="true" aria-controls="basics" data-toggle="tab" role="tab" id="basics-tab" href="#basics">Basics</a>
                    </li>
                </ul>

                <div class="tab-content col-sm-9" id="projectTabsContent">
                    <div aria-labelledby="basics-tab" id="basics" class="tab-pane fade active in" role="tabpanel">
                        @include('admin.gallery.projects.partial.create_basics')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/js/admin/galleryProjects.js"></script>
@stop