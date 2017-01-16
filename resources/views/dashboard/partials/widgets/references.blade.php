<h3 class="page-heading">{{ trans('messages.manage_ref_details') }}</h3>

@if(isset($reference->id))

    <div class="single-item item-shadow">
        <img src="{{ $reference->getImageByThumb('reference_thumb') }}" alt="" class="img-responsive">
        <div class="item-info show-info">
            <div class="item-info-top clearfix">
                <span class="title">{{ $reference->title }}</span>
                <span class="number-of pull-left">({{ $reference->getNumberOfImages() }} {{ trans('messages.scene') }})</span>
            </div>
            <div class="item-info-bottom">
                <a href="#" class=""><i class="icon-shopping-cart"></i>{{$reference->package_name()}}
                    : {{ $reference->store->store_name }}</a>
                <a href="#" class=" pull-right">+ {{ trans('messages.share') }}</a>
            </div>
        </div>
    </div>

@endif

<div class="side-bar item-shadow">
    <div class="side-bar-top">
        <span>{{$numberOfReferences}}</span>
        <h3>{{ trans('messages.references') }}</h3>
        <span><a href="{{ route("dashboard_reference_new") }}"><i class="icon-plus"></i></a></span>
    </div>
    <div class="side-bar-bottom"></div>
</div>
