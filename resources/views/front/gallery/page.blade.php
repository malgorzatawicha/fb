@extends('front.layouts.gallery')
@section('breadcrumb')
    @foreach($category->pathIn($page) as $bread)
    <li><a href="{{route('gallery', [$page->getSlug(), $bread->getSlug()])}}">{{$bread->title}}</a></li>
    @endforeach
@endsection
@section('custom_logo')
    @if ($category->logo_id)
        <div class="row"><img title="{{$page->title}}" alt="logo" src="{{route('image',['fileId'=>$category->logo_id])}}" width="100%"></div>
    @endif
@endsection
@section('gallery_content')
    <h1>{{$category->title}}</h1>
    {!! $category->description !!}
    @foreach($category->allProjects()->chunk(4) as $projects)
        <div class="row">
            <div class="col-md-12">
                @foreach($projects as $project)
                    <div class="col-md-3">
                        <a href="{{route('project', ['pages' => $page->slug, 'category' => $category->slug, 'project' => $project->slug])}}">
                            <img class="borderable"
                                 src="@if($project->hasMainImage()){{route('image', ['fileId' => $project->mainImage()->image_id])}}@else{{''}}@endif"
                                 style="width: 100%" alt="{{$project->title}}">
                        </a>
                        <div class="project-thumb-label">{{$project->short_title}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

@endsection
