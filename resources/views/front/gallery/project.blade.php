@extends('front.layouts.gallery')
@section('breadcrumb')
    {{implode(' > ', $category->pathIn($page))}} > {{$project->title}}
@endsection
@section('gallery_content')
<div class="row">
    <div class="col-md-12">

        <!-- Carousel
           ================================================== -->
        <div id="myCarousel" class="carousel slide">

            <div class="carousel-inner" role="listbox">
                @foreach ($project->images as $index => $image)
                    <div class="item @if($index == 0) active @endif">
                        <a href="{{$image->big_path}}{{$image->big_filename}}" data-lightbox="roadtrip" data-title="{{$image->name}}">
                            <img class="img-responsive" src="{{$image->base_path}}{{$image->base_filename}}" alt="{{$image->name}}">
                        </a>
                        {{$image->description}}
                    </div>
                @endforeach
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
     </div><!-- End Carousel -->

    </div>
    </div>
    <div class="image-list">
        @foreach ($project->images as $index => $image)
            <div class="row">
                 <img class="img-responsive" src="{{$image->mobile_path}}{{$image->mobile_filename}}" alt="{{$image->name}}">
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
                                                <img class="img-responsive" src="{{$image->thumb_path}}{{$image->thumb_filename}}" alt="{{$image->name}}">
                                            </a>
                                        </div>
                                        <?php $counter++ ?>
                                    @endforeach
                                </div>
                            </div>
                            <?php $chunkCount++ ?>
                        @endforeach
                    </div>

                    <a class="left carousel-control" href="#thumbnailCarousel" data-slide="prev"><i class="fa fa-chevron-left fa-2x"></i></a>
                    <a class="right carousel-control" href="#thumbnailCarousel" data-slide="next"><i class="fa fa-chevron-right fa-2x"></i></a>

                    <ol class="carousel-indicators">
                        @for($i = 0; $i < $chunkCount; $i++)
                            <li data-target="#thumbnailCarousel" data-slide-to="{{$i}}" class="@if($i==0)active @endif "></li>
                        @endfor

                    </ol>
                </div><!-- End Carousel -->
            </div><!-- End Well -->

        </div>

    </div>
@endsection

@section('gallery_scripts')
    <script src="/vendor/lightbox/lightbox.js"></script>
    <script>
        $('.carousel').carousel('pause')

        $(document).ready(function(){
           $("#thumbnailCarousel a").click(function(e){
               e.preventDefault();
               $('#myCarousel').carousel($(this).data('item'));
               $('#myCarousel').carousel('pause');

           });
        });
    </script>
@endsection