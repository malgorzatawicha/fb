@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div
                id="projectInfo"
                data-submit-action="{{ route('admin.gallery.categories.projects.store', ['categories'=>$category->getKey()]) }}"
        ></div>
        <div class="panel-heading">
            <h4>{{trans('admin.gallery.projects.create')}} {{trans('admin.gallery.projects.in_category')}}: {{$category->title}}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <ul role="tablist" class="nav nav-pills nav-stacked col-sm-3" id="projectTabs">
                    <li class="active" role="presentation">
                        <a aria-expanded="true" aria-controls="basics" data-toggle="tab" role="tab" id="basics-tab" href="#basics">{{trans('admin.basic_data')}}</a>
                    </li>
                </ul>

                <div class="tab-content col-sm-9" id="projectTabsContent">
                    <div aria-labelledby="basics-tab" id="basics" class="tab-pane fade active in" role="tabpanel">
                        @include('admin.gallery.projects.partial.basics')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ elixir('js/admin/project.js') }}"></script>
@stop