@extends("master.front-layout")

@section("pageTitle") Single Product @stop

@section("header")
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick-theme.css') }}">
@stop

@section("content")

    @include('front.partials.stores.top')

    @if(!$store->isLight())
        @include('front.partials.stores.datablock')

        @include('front.partials.stores.references')

        @include('front.partials.stores.products')
    @else
        <section style="height: 120px"></section>
    @endif

    @include('front.partials.homepage.newsletter')

    @include('front.partials.modal.newsletter-store')

    @include('front.partials.stores.manufacturers')

    @include('front.partials.modal.single-product')

@stop

@section("footer")
	<script type="text/javascript" src="{{ asset('assets/js/lib/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/product-modal-front.js') }}"></script>
@stop