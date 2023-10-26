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
        <h2>Upload Image</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vision-search') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="image">Choose Image:</label>
                <input type="file" class="form-control-file" id="image" name="image"
                    accept="image/*;capture=camera">
            </div>
            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>
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
