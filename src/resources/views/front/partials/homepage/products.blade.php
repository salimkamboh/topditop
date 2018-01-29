<section id="home-references">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>{{ trans('messages.month_products') }}</h3>
            </div>
            <div class="col-sm-4">
                <div class="sortable">
                    <button type="button"
                            class="pull-left show-home-newest-prod">{{ trans('messages.newest') }}</button>
                    <button type="button"
                            class="pull-right show-home-most-prod active">{{ trans('messages.most_viewed') }}</button>
                </div>
            </div>
        </div>

        <div class="row products-home-newest home-design hidden-block">
            @if(isset($products_newest))
                @foreach($products_newest as $product)
                    <div class="col-md-4">
                        <div class="single-item item-shadow single-item-product" data-product-id="{{$product->id}}">
                            <a href="{{route("front_show_store", $product->store)}}" class="">
                                <img alt="" class="img-responsive"
                                     src="@if($product->getImageByThumb('reference_thumb') !== null) {{$product->getImageByThumb('reference_thumb')}} @endif">
                            </a>
                            <div class="item-info">
                                <div class="item-info-top clearfix">
                                    <div class="width-fix">
                                    <span class="title">
                                        <a href="javascript:void(0)"
                                           data-product-id="{{$product->id}}">{{$product->title}}</a>
                                    </span>
                                        <span class="number-of pull-left">({{$product->getNumberOfReferences()}}
                                            {{ trans('messages.scene') }})</span></div>
                                    <span class="price pull-right"><i class="icon-eur"></i>{{$product->price}}</span>
                                </div>
                                <div class="item-info-bottom">
                                    <a href="{{route("front_show_store", $product->store)}}"><i
                                                class="icon-shopping-cart"></i>{{$product->store->store_name}}</a>
                                    @if($product->show_brand_link == 1)
                                        <a class="product-no-link-brand"
                                           href="{{ route("front_brand_stores", $product->manufacturer_id) }}"><i
                                                    class="fa fa-bookmark"></i>{{$product->manufacturer->name}}</a>
                                    @endif
                                    <a href="{{route("front_products")}}#{{$product->id}}">+ {{ trans('messages.share') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row products-home-most home-design">
            @if(isset($products_most))
                @foreach($products_most as $product)
                    <div class="col-md-4">
                        <div class="single-item item-shadow single-item-product" data-product-id="{{$product->id}}">
                            <a href="{{route("front_show_store", $product->store)}}" class="">
                                <img alt="" class="img-responsive"
                                     src="@if($product->getImageByThumb('reference_thumb') !== null) {{$product->getImageByThumb('reference_thumb')}} @endif">
                            </a>
                            <div class="item-info">
                                <div class="item-info-top clearfix">
                                    <div class="width-fix">
                                    <span class="title">
                                        <a href="javascript:void(0)"
                                           data-product-id="{{$product->id}}">{{$product->title}}</a>
                                    </span>
                                        <span class="number-of pull-left">({{$product->getNumberOfReferences()}}
                                            {{ trans('messages.scene') }})</span></div>
                                    <span class="price pull-right"><i class="icon-eur"></i>{{$product->price}}</span>
                                </div>
                                <div class="item-info-bottom">
                                    <a href="{{route("front_show_store", $product->store)}}"><i
                                                class="icon-shopping-cart"></i>{{$product->store->store_name}}</a>
                                    @if($product->show_brand_link == 1)
                                        <a class="product-no-link-brand"
                                           href="{{ route("front_brand_stores", $product->manufacturer_id) }}"><i
                                                    class="fa fa-bookmark"></i>{{$product->manufacturer->name}}</a>
                                    @endif
                                    <a href="{{route("front_products")}}#{{$product->id}}">+ {{ trans('messages.share') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="text-center">
            <a href="{{route("front_products")}}" class="click-button">{{ trans('messages.all_products') }}﻿</a>
        </div>
    </div>
</section>