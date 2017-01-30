<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Dashboard</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/slavisa.css') }}">

    @yield("header")
</head>

<body class="dashboard-ui">

<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route("dashboard_home") }}">Top<span
                            class="navbar-brand--logo-mod">di</span>Top
                    H.O.M.E.</a>
            </div>


            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Locations <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href=""><i class="fa fa-fw fa-cog"></i> All</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Stores <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route("front_stores") }}"><i class="fa fa-fw fa-cog"></i> All</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">References <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route("dashboard_references")}}">All</a></li>
                            <li><a href="{{route("dashboard_reference_new")}}">Add New</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Contact us</a></li>
                    <li><a href="{{route("dashboard_home")}}">Dashboard<span class="caret"></span></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left alt">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon search-icon"><i class="fa fa-search"
                                                                               ></i></span>
                                <input type="text" class="form-control" placeholder="Search Stores">
                                <span class="navmenu-search text-center x-icon pull-right"><i
                                            class="icon-plus"></i></span>
                            </div>
                        </div>
                    </form>

                    @if (Auth::check())
                        <li><a href="{{url('/logout')}}">Log Out</a></li>
                    @else
                        <li><a class="log-sig" href="#">Login</a></li>
                        <li class="top-14-correct">/</li>
                        <li><a class="log-sig registration-button" href="javascript:void(0)">Sign up</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <div class="flash-message">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            @if (session('fail'))
                <div class="alert alert-danger">
                    {{ session('fail') }}
                </div>
            @endif
    </div> <!-- end .flash-message -->
</div>

@if (session('message'))
    <div class="alert alert-info">{{ session('message') }}</div>
@endif

<div class="content-holder">
    <div class="container">
        <div class="row">
            @yield("content")
        </div>
    </div>
</div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer_logo">
                        Top<span class="footer_logo--inverse">di</span>Top H.O.M.E.
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="footer_list_group">
                                <h5 class="footer_list_group__header">Cities</h5>
                                <ul class="list-unstyled footer_list_group__items">
                                    <li><a href="#">München</a></li>
                                    <li><a href="#">Düsseldorf</a></li>
                                    <li><a href="#">Hamburg</a></li>
                                    <li><a href="#">Wien</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="footer_list_group">
                                <h5 class="footer_list_group__header">Stores</h5>
                                <ul class="list-unstyled footer_list_group__items">
                                    <li><a href="/store">Geringer</a></li>
                                    <li><a href="/store">Wetscher</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="footer_list_group">
                                <h5 class="footer_list_group__header">Products</h5>
                                <ul class="list-unstyled footer_list_group__items">
                                    <li><a href="#">Chairs</a></li>
                                    <li><a href="#">Sofas</a></li>
                                    <li><a href="#">Beds</a></li>
                                    <li><a href="#">Kitchen</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="footer_list_group">
                                <h5 class="footer_list_group__header">Connect</h5>
                                <ul class="list-unstyled footer_list_group__items">
                                    <li><a href="#">Facebook</a></li>
                                    <li><a href="#">LinkedIn</a></li>
                                    <li><a href="#">Twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- jQuery -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/jquery-validation.js') }}"></script>
<script src="{{ asset('js/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dimmer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/modal.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/script.js')}}"></script>

@yield("footer")

</body>
</html>