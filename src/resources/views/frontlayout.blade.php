<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/slavisa.css') }}">

    <title>TopDiTop</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    @yield("header")
</head>

<body>

@include('front.partials.modal.registration')

@include('front.partials.components.header')

@yield("content")

@include('dashboard.partials.component.footer')

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrkUQEYz2K7WQ6L6RgLKncCfK727djyms&v=3.25&language=ee"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/script.js')}}"></script>

@yield("footer")

</body>
</html>