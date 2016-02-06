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
                <div class="item active">
                    <a href="http://dummyimage.com/1500x1000/000/fff&text=zdjecie1" data-lightbox="roadtrip" data-title="zdjecie1">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie1" style="width: 100%" alt="zdjecie1">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie2" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie2" style="width: 100%" alt="Chania">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie3" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie3" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie4" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie4" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>
                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie5" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie5" style="width: 100%" alt="Chania">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie6" data-lightbox="roadtrip" data-title="My caption">
                    <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie6" style="width: 100%" alt="Flower">
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie7" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie7" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>
                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie8" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie8" style="width: 100%" alt="zdjecie1">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie9" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie9" style="width: 100%" alt="Chania">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie10" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie10" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie11" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie11" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>
                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie12" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie12" style="width: 100%" alt="Chania">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie13" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie13" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie14" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie14" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>
                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie15" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie15" style="width: 100%" alt="zdjecie1">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie16" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie16" style="width: 100%" alt="Chania">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie17" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie17" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie18" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie18" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>
                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie19" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie19" style="width: 100%" alt="Chania">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie20" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie20" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>

                <div class="item">
                    <a href="http://dummyimage.com/2000x1000/000/fff&text=zdjecie21" data-lightbox="roadtrip" data-title="My caption">
                        <img src="http://dummyimage.com/800x400/000/fff&text=zdjecie21" style="width: 100%" alt="Flower">
                    </a>
                    <p>It is a long established fact that a reader will be distracted by the readable content of It is a long established fact that a reader will be distracted by the readable content of</p>
                </div>
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
{{--
            <!-- Indicators -->
            <ol class="carousel-indicators" style="position: unset">
                <li data-target="#myCarousel" data-slide-to="0" class="active"><img src="http://dummyimage.com/150x150/000/fff&text=zdjecie1" style="width: 100%" alt="Flower"></li>
                <li data-target="#myCarousel" data-slide-to="1" class="active"><img src="http://dummyimage.com/150x150/000/fff&text=zdjecie2" style="width: 100%" alt="Flower"></li>
                <li data-target="#myCarousel" data-slide-to="2" class="active"><img src="http://dummyimage.com/150x150/000/fff&text=zdjecie3" style="width: 100%" alt="Flower"></li>
                <li data-target="#myCarousel" data-slide-to="3" class="active"><img src="http://dummyimage.com/150x150/000/fff&text=zdjecie4" style="width: 100%" alt="Flower"></li>
                <li data-target="#myCarousel" data-slide-to="4" class="active"><img src="http://dummyimage.com/150x150/000/fff&text=zdjecie2" style="width: 100%" alt="Flower"></li>
                <li data-target="#myCarousel" data-slide-to="5" class="active"><img src="http://dummyimage.com/150x150/000/fff&text=zdjecie3" style="width: 100%" alt="Flower"></li>
                <li data-target="#myCarousel" data-slide-to="6" class="active"><img src="http://dummyimage.com/150x150/000/fff&text=zdjecie4" style="width: 100%" alt="Flower"></li>

            </ol>--}}
        </div><!-- End Carousel -->

    </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="well">
                <!-- Carousel
                ================================================== -->
                <div id="thumbnailCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-md-3"><a data-item="0" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie1" alt="Thumb11"></a>
                                </div>
                                <div class="col-md-3"><a data-item="1" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie2" alt="Thumb12"></a>
                                </div>
                                <div class="col-md-3"><a data-item="2" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie3" alt="Thumb13"></a>
                                </div>
                                <div class="col-md-3"><a data-item="3" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie4" alt="Thumb14"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3"><a data-item="4" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie5" alt="Thumb11"></a>
                                </div>
                                <div class="col-md-3"><a data-item="5" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie6" alt="Thumb12"></a>
                                </div>
                                <div class="col-md-3"><a data-item="6" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie7" alt="Thumb13"></a>
                                </div>
                                <div class="col-md-3"><a data-item="7" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie8" alt="Thumb14"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3"><a data-item="8" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie9" alt="Thumb11"></a>
                                </div>
                                <div class="col-md-3"><a data-item="9" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie10" alt="Thumb12"></a>
                                </div>
                                <div class="col-md-3"><a data-item="10" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie11" alt="Thumb13"></a>
                                </div>
                                <div class="col-md-3"><a data-item="11" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie12" alt="Thumb14"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3"><a data-item="12" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie13" alt="Thumb11"></a>
                                </div>
                                <div class="col-md-3"><a data-item="13" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie14" alt="Thumb12"></a>
                                </div>
                                <div class="col-md-3"><a data-item="14" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie15" alt="Thumb13"></a>
                                </div>
                                <div class="col-md-3"><a data-item="15" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie16" alt="Thumb14"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3"><a data-item="16" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie17" alt="Thumb11"></a>
                                </div>
                                <div class="col-md-3"><a data-item="17" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie18" alt="Thumb12"></a>
                                </div>
                                <div class="col-md-3"><a data-item="18" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie19" alt="Thumb13"></a>
                                </div>
                                <div class="col-md-3"><a data-item="19" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie20" alt="Thumb14"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3"><a data-item="20" href="#" class="thumbnail"><img class="img-responsive" src="http://dummyimage.com/150x150/000/fff&text=zdjecie21" alt="Thumb11"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="left carousel-control" href="#thumbnailCarousel" data-slide="prev"><i class="fa fa-chevron-left fa-2x"></i></a>
                    <a class="right carousel-control" href="#thumbnailCarousel" data-slide="next"><i class="fa fa-chevron-right fa-2x"></i></a>

                    <ol class="carousel-indicators">
                        <li data-target="#thumbnailCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#thumbnailCarousel" data-slide-to="1"></li>
                        <li data-target="#thumbnailCarousel" data-slide-to="2"></li>
                        <li data-target="#thumbnailCarousel" data-slide-to="3"></li>
                        <li data-target="#thumbnailCarousel" data-slide-to="4"></li>
                        <li data-target="#thumbnailCarousel" data-slide-to="5"></li>
                    </ol>
                </div><!-- End Carousel -->
            </div><!-- End Well -->

        </div>

    </div>
@endsection

@section('gallery_scripts')
    <script src="/vendor/lightbox/lightbox.js"></script>
    <script>
        var $tree = $("#tree");
        $tree.treeview({
            data: {!! createTree($categories) !!}
        });
    </script>
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