@extends('front.layouts.gallery')
@section('breadcrumb')
    {{implode(' > ', $category->pathIn($page))}}
@endsection
@section('gallery_content')
    @foreach($category->children as $child)
        <div class="row">
            <div class="col-md-12">
                <h2><a href="{{route('gallery', ['pages' => $page->slug, 'category' => $child->slug])}}">{{$child->title}}</a></h2>
                <div class="row gallery">
                    <a href="{{route('gallery', ['pages' => $page->slug, 'category' => $child->slug])}}">
                        @foreach($child->randomImages(4) as $image)
                            <div class="col-md-3"><img src="{{$image->thumb_path}}{{$image->thumb_filename}}" style="width: 100%" alt="{{$image->name}}"></div>
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
                            <div class="col-md-3"><img src="{{$image->thumb_path}}{{$image->thumb_filename}}" style="width: 100%" alt="{{$image->name}}"></div>
                        @endforeach
                    </a>
                </div>
            </div>
        </div>
    @endforeach


@endsection
