<div class="single-item item-shadow">
    <img class="img-responsive full-width"
         src="{{$reference->getImageByThumb($thumbSlug)}}"
         alt="">
    <div class="item-info">
        <div class="item-info-top clearfix">
            <div class="width-fix">
            <span class="title">
                @if($reference->store->package_name() == 'TopDiTop Store')
                    <a href="{{ route("front_references_single", $reference) }}">{{$reference->title}}</a>
                @else
                    {{$reference->title}}
                @endif
            </span>
            <span class="number-of pull-left">({{$reference->getNumberOfImages()}} {{ trans('messages.scene') }})</span></div>
            <span class="date pull-right">{{$reference->getNiceDate()}}</span>
        </div>
        <div class="item-info-bottom">
            <a href="{{route('front_show_store', $reference->store)}}"><i
                        class="icon-shopping-cart"></i>{{$reference->package_name()}}
                : {{$reference->store->store_name}}</a>
            @if($reference->store->package_name() == 'TopDiTop Store')
                <a class="shareBtn" href="{{ route("front_references_single", $reference) }}">+ {{ trans('messages.share') }}</a>
            @else
                <a href=""></a>
            @endif
        </div>
    </div>
</div>