@extends("master.front-layout")

@section("pageTitle") Homepage @stop

@section("header")
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/modal.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/transition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/dropdown.min.css') }}">
@stop

@section('content')
    @include('front.partials.homepage.slider')
    @include('front.partials.homepage.map')
    @include('front.partials.homepage.references')
    @include('front.partials.homepage.manufacturers')
    @include('front.partials.homepage.newsletter')
    @include('front.partials.modal.newsletter')
    @include('front.partials.homepage.brandreferences')
    @include('front.partials.homepage.products')
    @include('front.partials.modal.single-product')
@stop

@section("footer")
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrkUQEYz2K7WQ6L6RgLKncCfK727djyms&v=3.25&language=ee"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/map-script.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/home-scripts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/product-modal-front.js') }}"></script>
@stop
