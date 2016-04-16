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
    @foreach($category->children as $child)
        <div class="row">
            <div class="col-md-12">
                <h2><a href="{{route('gallery', ['pages' => $page->slug, 'category' => $child->slug])}}">{{$child->title}}</a></h2>
                <div class="row gallery">
                    <a href="{{route('gallery', ['pages' => $page->slug, 'category' => $child->slug])}}">
                        @foreach($child->randomImages(4) as $image)
                            <div class="col-md-3"><img class="borderable" src="{{route('image', ['fileId' => $image->thumb_id])}}" style="width: 100%" alt="{{$image->name}}"></div>
                        @endforeach
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    @foreach($category->projects as $project)
        <div class="row">
            <div class="col-md-12">
                <h2><a href="{{route('project', ['pages' => $page->slug, 'category' => $category->slug, 'project' => $project->slug])}}">{{$project->title}}</a></h2>
                <div class="row gallery">
                    <a href="{{route('project', ['pages' => $page->slug, 'category' => $category->slug, 'project' => $project->slug])}}">
                        @foreach($project->randomImages(4) as $image)
                            <div class="col-md-3"><img class="borderable" src="{{route('image', ['fileId' => $image->thumb_id])}}" style="width: 100%" alt="{{$image->name}}"></div>
                        @endforeach
                    </a>
                </div>
            </div>
        </div>
    @endforeach


@endsection
