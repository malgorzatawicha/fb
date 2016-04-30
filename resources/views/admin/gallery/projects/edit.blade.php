@extends('admin.layouts.default')
@section('content')
    <div class="panel panel-default">
        <div
                id="projectInfo"
                data-project="{{escapeJson($project)}}"
                data-logo="{{json_encode([
                                'big' =>route('admin.image', ['fileId' => $project->logo_id]),
                                 'thumb' => route('admin.image', ['fileId' => $project->logo_id, 'width' => 160, 'height' => 160])
                               ])}}"
                data-submit-action="{{ route('admin.gallery.categories.projects.update', ['categories'=>$category->getKey(), 'projects' => $project->getKey()]) }}"

        ></div>
        <div class="panel-heading">
            <h3>{{ trans('admin.gallery.projects.edit') }}: {{$category->title}} {{trans('admin.gallery.projects.in_category')}}: {{$project->title}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <ul role="tablist" class="nav nav-pills nav-stacked col-sm-3" id="projectTabs">
                    <li class="active" role="presentation">
                        <a aria-expanded="true" aria-controls="basics" data-toggle="tab" role="tab" id="basics-tab" href="#basics">{{trans('admin.basic_data')}}</a>
                    </li>
                    <li role="presentation" class="">
                        <a aria-controls="images" data-toggle="tab" id="images-tab" role="tab" href="#images" aria-expanded="false">{{trans('admin.gallery.projects.images.page_title')}}</a>
                    </li>
                </ul>

                <div class="tab-content col-sm-9" id="projectTabsContent">
                    <div aria-labelledby="basics-tab" id="basics" class="tab-pane fade active in" role="tabpanel">
                        @include('admin.gallery.projects.partial.basics', ['category' => $category, 'project' => $project])
                    </div>
                    <div aria-labelledby="images-tab" id="images" class="tab-pane fade" role="tabpanel">
                        @include('admin.gallery.projects.partial.images', ['category' => $category, 'project' => $project])
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ elixir('js/admin/project.js') }}"></script>
@stop