@extends('front.layouts.gallery')
@section('breadcrumb')
    @foreach($category->pathIn($page) as $bread)
        <li><a href="{{route('gallery', [$page->getSlug(), $bread->getSlug()])}}">{{$bread->title}}</a></li>
    @endforeach
    <li>{{$project->title}}</li>
@endsection
@section('custom_logo')
    @if ($project->logo_id)
        <div class="row"><img title="{{$project->title}}" alt="logo" src="{{route('image',['fileId'=>$project->logo_id])}}" width="100%"></div>
    @endif
@endsection
@section('gallery_content')
<div class="row">
    <div class="col-md-12">
        <h1>{{$project->title}}</h1>
        <!-- Carousel
           ================================================== -->
        <div id="myCarousel" class="carousel slide borderable">

            <div class="carousel-inner" role="listbox">
                @foreach ($project->images as $index => $image)
                    <div class="item @if($index == 0) active @endif">
                        <a href="{{route('image', ['fileId' => $image->image_id])}}" data-lightbox="roadtrip" data-title="{{$image->name}}">
                            <img class="img-responsive" src="{{route('image', ['fileId' => $image->image_id, 'width' => 800, 'height' => 538])}}" alt="{{$image->name}}">
                        </a>
                        {{$image->description}}
                    </div>
                @endforeach
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="fa fa-chevron-circle-left icon-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="fa fa-chevron-circle-right icon-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
     </div><!-- End Carousel -->
    </div>
    </div>
    <div class="image-list">
        @foreach ($project->images as $index => $image)
            <div class="row">
                 <img class="img-responsive borderable" src="{{route('image', ['fileId' => $image->image_id])}}" alt="{{$image->name}}">
                {{$image->description}}
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="well">
                <!-- Carousel
                ================================================== -->
                <?php $counter = 0; $chunkCount = 0;?>
                <div id="thumbnailCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach($project->images->chunk(4) as $items)
                            <div class="item @if($counter == 0) active @endif">
                                <div class="row">
                                    @foreach($items as $image)
                                        <div class="col-sm-3">
                                            <a data-item="{{$counter}}" href="#" class="thumbnail">
                                                <img class="img-responsive borderable" src="{{route('image', ['fileId' => $image->thumb_id, 'width' => 150, 'height' => 150])}}" alt="{{$image->name}}">
                                            </a>
                                        </div>
                                        <?php $counter++ ?>
                                    @endforeach
                                </div>
                            </div>
                            <?php $chunkCount++ ?>
                        @endforeach
                    </div>

                    <a class="left carousel-control" href="#thumbnailCarousel" data-slide="prev"><i class="fa fa-chevron-circle-left icon-left"></i></a>
                    <a class="right carousel-control" href="#thumbnailCarousel" data-slide="next"><i class="fa fa-chevron-circle-right  icon-right"></i></a>

                    <ol class="carousel-indicators">
                        @for($i = 0; $i < $chunkCount; $i++)
                            <li data-target="#thumbnailCarousel" data-slide-to="{{$i}}" class="@if($i==0)active @endif "></li>
                        @endfor

                    </ol>
                </div><!-- End Carousel -->
            </div><!-- End Well -->

        </div>

    </div>
    <div class="row project-description">
        {!! $project->description !!}
    </div>
@endsection

@section('gallery_scripts')
    <script>
        $('.carousel').carousel('pause')

        $(document).ready(function(){
           $("#thumbnailCarousel a").click(function(e){
               e.preventDefault();
               $('#myCarousel').carousel($(this).data('item'));
               $('#myCarousel').carousel('pause');

           });
        });

        $('.lb-next').html('<span class="fa fa-chevron-circle-right"></span>');
        $('.lb-next').addClass('right carousel-control').removeClass('lb-next');

        $('.lb-prev').html('<span class="fa fa-chevron-circle-left"></span>');
        $('.lb-prev').addClass('left carousel-control').removeClass('lb-prev');
    </script>
@endsection