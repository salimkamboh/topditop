@extends("master.front-layout")

@section("pageTitle") Products @stop

@section("header")
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick-theme.css') }}">
@stop

@section("content")

    <section id="front-products">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 pagination-main">
                    <a href="{{route('default')}}"><i
                                class="icon-arrow-left"></i><span>{{ trans('messages.back_homepage') }}</span></a>
                    <span>&gt;</span>
                    <a href="#"><span>{{ trans('messages.products') }}</span></a>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4 filter">
                            @include('front.partials.widgets.products.filter')
                        </div>
                        <div class="col-sm-8">
                            <h3 class="page-heading">{{ trans('messages.products') }}</h3>
                            <div class="row list-all-products">
                                @foreach($products as $product)
                                    <div class="col-md-6">
                                        <div class="single-item single-item-product item-shadow"
                                             data-product-id="{{$product->id}}">
                                            <img alt="" class="img-responsive"
                                                 src="{{$product->getImageByThumb('reference_thumb')}}">
                                            <div class="item-info">
                                                <div class="item-info-top clearfix">
                                                    <div class="width-fix">
                                                    <span class="title">
                                                        <a href="javascript:void(0)"
                                                           data-product-id="{{$product->id}}">{{$product->title}}</a>
                                                    </span>
                                                    <span class="number-of pull-left">({{$product->getNumberOfReferences()}}
                                                        {{ trans('messages.references') }})</span></div>
                                                    <span class="price"><i
                                                                class="icon-eur"></i>{{$product->price}}</span>

                                                </div>
                                                <div class="item-info-bottom">
                                                    <a href="{{route("front_show_store", $product->store)}}" class=""><i
                                                                class="icon-shopping-cart"></i>{{ $product->store->store_name }}
                                                    </a>
                                                    <a class="product-no-link-brand" href="#" class="pull-left"><i
                                                                class="fa fa-bookmark"></i>{{$product->getManufacturerName()}}
                                                    </a>
                                                    <a href="{{route('front_products')}}#{{$product->id}}"
                                                       class="shareBtn pull-right">+ {{trans('messages.share')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front.partials.modal.single-product')

@stop

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/lib/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/dropdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/products-front.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/products-filter-front.js') }}"></script>
@stop