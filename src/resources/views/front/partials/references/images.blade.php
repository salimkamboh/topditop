<div class="container width-container">
    <div class="row special-margin">
        <?php
        if(isset($imagesByReference[0])) {
        $image1 = $imagesByReference[0];
        ?>
        <div class="col-md-6 special-padding">
            <div class="single-item item-shadow .special-height">
                <a href="{{route('front_show_store', $reference->store)}}">
                    <img alt="" class="img-responsive full-width"
                         src="{{ $image1->getImageByThumb('gallery_1') }}">
                </a>
                <div class="item-info">
                    <div class="item-info-top clearfix">
                        <div class="width-fix">
                            <span class="title">{{$reference->title}}</span>
                            <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{trans('messages.scene')}}
                                )</span></div>
                        <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                    </div>
                    <div class="item-info-bottom">
                        <a href="{{route('front_show_store', $reference->store)}}"><i
                                    class="icon-shopping-cart"></i>{{$reference->package_name()}}
                            : {{$reference->store->store_name}}</a>
                        <a class="shareBtn"
                           href="{{ route('front_references_single',$reference) }}">+ {{trans('messages.share')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div class="col-md-6 special-padding">
            <div class="row special-margin">
                <?php
                if(isset($imagesByReference[1])) {
                $image2 = $imagesByReference[1];
                ?>
                <div class="col-sm-12 special-padding">
                    <div class="single-item item-shadow">
                        <a href="{{route('front_show_store', $reference->store)}}">
                            <img alt="" class="img-responsive full-width"
                                 src="{{ $image2->getImageByThumb('gallery_2') }}">
                        </a>
                        <div class="item-info">
                            <div class="item-info-top clearfix">
                                <div class="width-fix">
                                    <span class="title">{{$reference->title}}</span>
                                    <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{trans('messages.scene')}}
                                        )</span></div>
                                <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                            </div>
                            <div class="item-info-bottom">
                                <a href="{{route('front_show_store', $reference->store)}}"><i
                                            class="icon-shopping-cart"></i>{{$reference->package_name()}}
                                    : {{$reference->store->store_name}}</a>
                                <a class="shareBtn"
                                   href="{{ route('front_references_single',$reference) }}">+ {{trans('messages.share')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                <?php
                if(isset($imagesByReference[2])) {
                $image3 = $imagesByReference[2];
                ?>
                <div class="col-md-6 special-padding">
                    <div class="single-item item-shadow">
                        <a href="{{route('front_show_store', $reference->store)}}">
                            <img alt="" class="img-responsive"
                                 src="{{ $image3->getImageByThumb('gallery_3') }}">
                        </a>
                        <div class="item-info">
                            <div class="item-info-top clearfix">
                                <div class="width-fix">
                                    <span class="title">{{$reference->title}}</span>
                                    <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{trans('messages.scene')}}
                                        )</span></div>
                                <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                            </div>
                            <div class="item-info-bottom">
                                <a href="{{route('front_show_store', $reference->store)}}"><i
                                            class="icon-shopping-cart"></i>{{$reference->package_name()}}
                                    : {{$reference->store->store_name}}</a>
                                <a class="shareBtn"
                                   href="{{ route('front_references_single',$reference) }}">+ {{trans('messages.share')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }

                if(isset($imagesByReference[3])) {
                $image4 = $imagesByReference[3];
                ?>
                <div class="col-md-6 special-padding">
                    <div class="single-item item-shadow">
                        <a href="{{route('front_show_store', $reference->store)}}">
                            <img alt="" class="img-responsive full-width"
                                 src="{{ $image4->getImageByThumb('gallery_3') }}">
                        </a>
                        <div class="item-info">
                            <div class="item-info-top clearfix">
                                <div class="width-fix">
                                    <span class="title">{{$reference->title}}</span>
                                    <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{trans('messages.scene')}}
                                        )</span></div>
                                <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                            </div>
                            <div class="item-info-bottom">
                                <a href="{{route('front_show_store', $reference->store)}}"><i
                                            class="icon-shopping-cart"></i>{{$reference->package_name()}}
                                    : {{$reference->store->store_name}}</a>
                                <a class="shareBtn"
                                   href="{{ route('front_references_single',$reference) }}">+ {{trans('messages.share')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row special-margin">
        <?php
        if(isset($imagesByReference[4])) {
        $image5 = $imagesByReference[4];
        ?>
        <div class="col-md-6 text-center special-padding">
            <div class="single-item item-shadow">
                <a href="{{route('front_show_store', $reference->store)}}">
                    <img alt="" class="img-responsive full-width"
                         src="{{ $image5->getImageByThumb('gallery_1') }}">
                </a>
                <div class="item-info">
                    <div class="item-info-top clearfix">
                        <div class="width-fix">
                            <span class="title">{{$reference->title}}</span>
                            <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{trans('messages.scene')}}
                                )</span></div>
                        <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                    </div>
                    <div class="item-info-bottom">
                        <a href="{{route('front_show_store', $reference->store)}}"><i
                                    class="icon-shopping-cart"></i>{{$reference->package_name()}}
                            : {{$reference->store->store_name}}</a>
                        <a class="shareBtn"
                           href="{{ route('front_references_single',$reference) }}">+ {{trans('messages.share')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }

        if(isset($imagesByReference[5])) {
        $image6 = $imagesByReference[5];
        ?>
        <div class="col-md-6 text-center special-padding">
            <div class="single-item item-shadow">
                <a href="{{route('front_show_store', $reference->store)}}">
                    <img alt="" class="img-responsive full-width"
                         src="{{ $image6->getImageByThumb('gallery_1') }}">
                </a>
                <div class="item-info">
                    <div class="item-info-top clearfix">
                        <div class="width-fix">
                            <span class="title">{{$reference->title}}</span>
                            <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{trans('messages.scene')}}
                                )</span></div>
                        <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                    </div>
                    <div class="item-info-bottom">
                        <a href="{{route('front_show_store', $reference->store)}}"><i
                                    class="icon-shopping-cart"></i>{{$reference->package_name()}}
                            : {{$reference->store->store_name}}</a>
                        <a class="shareBtn"
                           href="{{ route('front_references_single',$reference) }}">+ {{trans('messages.share')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    <?php
    if(isset($imagesByReference[6])) {

    $image7 = $imagesByReference[6];
    ?>
    <div class="row special-margin">
        <div class="col-md-12 special-padding">
            <div class="single-item item-shadow">
                <a href="{{route('front_show_store', $reference->store)}}">
                    <img alt="" class="img-responsive full-width"
                         src="{{ $image7->getImageByThumb('gallery_4') }}">
                </a>
                <div class="item-info">
                    <div class="item-info-top clearfix">
                        <div class="width-fix">
                            <span class="title">{{$reference->title}}</span>
                            <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{trans('messages.scene')}}
                                )</span></div>
                        <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                    </div>
                    <div class="item-info-bottom">
                        <a href="{{route('front_show_store', $reference->store)}}"><i
                                    class="icon-shopping-cart"></i>{{$reference->package_name()}}
                            : {{$reference->store->store_name}}</a>
                        <a class="shareBtn"
                           href="{{ route('front_references_single',$reference) }}">+ {{trans('messages.share')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>