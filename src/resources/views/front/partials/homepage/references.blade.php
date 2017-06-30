<section id="home-references">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>{{ trans('messages.store_reference') }}</h3>
            </div>
            <div class="col-sm-4">
                <div class="sortable">
                    <button type="button" class="pull-left show-home-newest">{{ trans('messages.newest') }}</button>
                    <button type="button"
                            class="pull-right show-home-most active">{{ trans('messages.most_viewed') }}</button>
                </div>
            </div>
        </div>

        <div class="row references-home-newest home-design hidden-block">
            @if(isset($references_newest))
                @foreach($references_newest as $reference)
                    <div class="col-md-4">
                        <div class="single-item item-shadow">
                            <img alt="" class="img-responsive"
                                 src="@if($reference->getImageByThumb('reference_thumb') !== null) {{$reference->getImageByThumb('reference_thumb')}} @endif">
                            <div class="item-info">
                                <div class="item-info-top clearfix">
                                    <div class="width-fix">
                                        <span class="title">
                                            @if($reference->store->package_name() == \App\Package::HIGHEST)
                                                <a href="{{ route("front_references_single", $reference) }}">{{$reference->title}}</a>
                                            @else
                                                {{$reference->title}}
                                            @endif
                                        </span>
                                        <span class="number-of pull-left">({{$reference->getNumberOfImages()}}
                                            {{ trans('messages.scene') }})</span>
                                    </div>
                                    <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                                </div>
                                <div class="item-info-bottom">
                                    <a href="{{ route('front_show_store', $reference->store)}}"><i
                                                class="icon-shopping-cart"></i>{{$reference->package_name()}}
                                        : {{$reference->store->store_name}}</a>
                                    @if($reference->store->package_name() == \App\Package::HIGHEST)
                                        <a class="shareBtn"
                                           href="{{ route("front_references_single", $reference) }}">+ {{ trans('messages.share') }}</a>
                                    @else
                                        <a href=""></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row references-home-most home-design">
            @if(isset($references_most))
                @foreach($references_most as $reference)
                    <div class="col-md-4">
                        <div class="single-item item-shadow">
                            <img alt="" class="img-responsive"
                                 src="@if($reference->getImageByThumb('reference_thumb') !== null) {{$reference->getImageByThumb('reference_thumb')}} @endif">
                            <div class="item-info">
                                <div class="item-info-top clearfix">
                                    <div class="width-fix">
                                        <span class="title">
                                            @if($reference->store->package_name() == \App\Package::HIGHEST)
                                                <a href="{{ route("front_references_single", $reference) }}">{{$reference->title}}</a>
                                            @else
                                                {{$reference->title}}
                                            @endif
                                        </span>
                                        <span class="number-of pull-left">({{$reference->getNumberOfImages()}}
                                            {{ trans('messages.scene') }})</span></div>
                                    <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                                </div>
                                <div class="item-info-bottom">
                                    <a href="{{ route('front_show_store', $reference->store)}}"><i
                                                class="icon-shopping-cart"></i>{{$reference->package_name()}}
                                        : {{$reference->store->store_name}}</a>
                                    @if($reference->store->package_name() == \App\Package::HIGHEST)
                                        <a class="shareBtn"
                                           href="{{ route("front_references_single", $reference) }}">+ {{ trans('messages.share') }}</a>
                                    @else
                                        <a href=""></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="text-center">
            <a href="{{ route("front_references") }}" class=click-button>{{ trans('messages.all_references') }}</a>
        </div>
    </div>
</section>