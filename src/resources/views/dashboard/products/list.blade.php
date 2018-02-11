@extends("master.dashboard-layout")

@section("pageTitle") All Products @stop

@section("header")
@stop

@section("content")

    <section id="dashboard-product">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 pagination-main">
                    <a href="{{ route("dashboard_home") }}"><i
                                class="icon-arrow-left"></i><span>{{ trans('messages.back_dashboard') }}</span></a>
                    <span>&gt;</span>
                    <a href="{{ route("dashboard_products") }}"><span>{{ trans('messages.manage_product') }}</span></a>
                    <h3>{{ trans('messages.manage_product') }}</h3>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        @include('dashboard.partials.widgets.products')
                        <div class="col-sm-8">
                            <div class="row list-all-products">
                                @foreach($products as $product)
                                    <div class="col-md-6">
                                        <div class="single-item item-shadow">
                                            <img alt="" class="img-responsive"
                                                 src="@if($product->getImageByThumb('reference_thumb') !== null) {{$product->getImageByThumb('reference_thumb')}} @endif">
                                            <div class="item-info">
                                                <div class="item-info-top clearfix">
                                                    <div class="width-fix">
                                                    <span class="title">
                                                    <a href="{{ route('dashboard_product_edit', $product) }}">{{$product->title}}</a>
                                                    </span>
                                                        <span class="number-of pull-left">({{ count($product->references)}}
                                                            {{ trans('messages.references') }})</span></div>
                                                    <span class="price"><i
                                                                class="icon-eur"></i>{{$product->price}}</span>
                                                </div>
                                                <div class="item-info-bottom">
                                                    <a href="#" class="pull-left separator-bottom"><i
                                                                class="fa fa-bookmark"></i>
                                                        {{$product->manufacturer->name}}</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <a href="{{ route('dashboard_product_edit', $product) }}"
                                                   class="click-button">{{ trans('messages.manage_product') }}</a>
                                                <a href="{{ route("dashboard_product_delete", $product) }}"
                                                   class="click-button">{{ trans('messages.delete_product') }}</a>
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

@stop

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/products-filter-dashboard.js') }}"></script>
@stop