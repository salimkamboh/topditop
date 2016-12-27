<h3 class="page-heading">{{ trans('messages.manage_prod_details') }}</h3>

@if(isset($product->id))

    <div class="single-item item-shadow">
        <img src="{{ $product->getImageByThumb('reference_thumb') }}" alt="" class="img-responsive">
        <div class="item-info show-info">
            <div class="item-info-top clearfix">
                <div class="width-fix">
                <span class="title">
                    <a href="{{ route('front_products') }}#{{$product->id}}">{{ $product->title }}</a>
                </span>
                <span class="number-of pull-left">({{ $product->getNumberOfReferences() }} {{ trans('messages.references') }})</span></div>
                <span class="price"><i class="icon-eur"></i>{{ $product->price }}</span>
            </div>
            <div class="item-info-bottom">
                <a href="{{ route('front_show_store', $product->store) }}" class=""><i class="icon-shopping-cart"></i>{{ $product->store->store_name }}</a>
                <a href="#" class="pull-left"><i class="fa fa-bookmark"></i>{{ $product->manufacturer->name }}</a>
                <a href="#" class=" pull-right">+ {{ trans('messages.share') }}</a>
            </div>
        </div>
    </div>

@endif

<div class="side-bar item-shadow">
    <div class="side-bar-top">
        <span>{{$numberOfProducts}}</span>
        <h3>{{ trans('messages.products') }}</h3>
        <span><a href="{{ route("dashboard_product_new") }}"><i class="icon-plus"></i></a></span>
    </div>
    <div class="side-bar-bottom"></div>
</div>