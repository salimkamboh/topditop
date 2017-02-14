<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>TopDiTop - @yield('pageTitle')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.google-analytics')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/transition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/dropdown.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/modal.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slavisa.css') }}">

    <script>
        _globalLang = "{{$locale}}";
        if (_globalLang == "")
            _globalLang = "en";

        _globalRoute = "{{ url('/') }}";
    </script>

    @yield("header")
</head>

<body>

@include('dashboard.partials.component.admin-header')

@include('dashboard.partials.component.flash-statuses')

@yield("content")

@include('dashboard.partials.component.footer')

<script type="text/javascript" src="{{ asset('assets/js/lib/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/jquery-validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/transition.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/dropdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/dimmer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lib/modal.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/lang.dist.js') }}"></script>
<script>
    Lang.setLocale(_globalLang);
</script>

<script src="{{ asset('assets/js/script.js')}}"></script>

@yield("footer")

</body>
</html>
