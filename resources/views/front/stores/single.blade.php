@extends("master.front-layout")

@section("pageTitle") Single Product @stop

@section("content")

    @include('front.partials.stores.top')

    @include('front.partials.stores.datablock')

    @include('front.partials.stores.references')

    @include('front.partials.stores.products')

    @include('front.partials.homepage.newsletter')

    @include('front.partials.modal.newsletter-store')

    @include('front.partials.stores.manufacturers')

    @include('front.partials.modal.single-product')

@stop

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/product-modal-front.js') }}"></script>
@stop