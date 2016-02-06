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
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie1" style="width: 100%" alt="Flower">
                        </div>
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie2" style="width: 100%" alt="Flower">
                        </div>
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie3" style="width: 100%" alt="Flower">
                        </div>
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie4" style="width: 100%" alt="Flower">
                        </div>
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
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie1" style="width: 100%" alt="Flower">
                        </div>
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie2" style="width: 100%" alt="Flower">
                        </div>
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie3" style="width: 100%" alt="Flower">
                        </div>
                        <div class="col-md-3">
                            <img src="http://dummyimage.com/200x200/000/fff&text=zdjecie4" style="width: 100%" alt="Flower">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach


@endsection
