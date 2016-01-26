@extends('admin.layouts.default')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right"><a href="{{route('admin.cms.pages.create')}}" class="btn btn-primary">{{trans('admin.create')}}</a></div>
            <h4>{{trans('cms.pages')}}</h4>
        </div>
        <div class="panel-body">
            @if (count($pages) > 0)
                <table class="table table-striped">
                    <thead><tr><th>{{trans('cms.page.id')}}</th><th>{{trans('cms.page.title')}}</th><th>{{trans('cms.page.body')}}</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->title}}</td>
                            <td>{!! $page->body !!}</td>
                            <td>
                                @if($page->active)
                                    <form action="{{route('admin.cms.pages.deactivate', [$page->slug])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-xs btn-warning">{{trans('admin.deactivate')}}</button>
                                    </form>
                                @else
                                    <form action="{{route('admin.cms.pages.activate', [$page->slug])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button class="btn btn-xs btn-warning">{{trans('admin.activate')}}</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{route('admin.cms.pages.destroy', [$page->slug])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a class="btn btn-xs btn-success" href="{{route('page', ['page'=>$page->slug, 'isPreview'=>true ])}}">{{trans('admin.view')}}</a>
                                    <a class="btn btn-xs btn-primary" href="{{route('admin.cms.pages.edit', [$page->slug])}}">{{trans('admin.edit')}}</a>
                                    <button class="btn btn-xs btn-danger">{{trans('admin.delete')}}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>{{trans('cms.page.no_records')}}</p>
            @endif
        </div>
    </div>

@stop