@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{trans('admin.pages.create')}}</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <ul role="tablist" class="nav nav-pills nav-stacked col-sm-3" id="pageTabs">
                    <li class="active" role="presentation">
                        <a aria-expanded="true" aria-controls="basics" data-toggle="tab" role="tab" id="basics-tab" href="#basics">{{trans('admin.basic_data')}}</a>
                    </li>
                </ul>

                <div class="tab-content col-sm-9" id="pageTabsContent">
                    <div aria-labelledby="basics-tab" id="basics" class="tab-pane fade active in" role="tabpanel">
                        @include('admin.cms.pages.partial.create_basics')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{elixir('js/admin/page.js')}}"></script>
@stop