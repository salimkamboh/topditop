@extends('master.front-layout')

@section('pageTitle')
    Homepage
@endsection

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/modal.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/transition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/dropdown.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Review search results page</h2>
        @if ($result['error'])
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $result['message'] }}</li>
                </ul>
            </div>
        @else
            @foreach ($result['items'] as $item)
                <div>
                    <img src="https://topditop.com/images/full_size/{{ $item->image_name }}" width="200">
                    {{ $item->score }}%
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('footer')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrkUQEYz2K7WQ6L6RgLKncCfK727djyms&v=3.25&language=ee">
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/map-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/home-scripts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/product-modal-front.js') }}"></script>
@endsection