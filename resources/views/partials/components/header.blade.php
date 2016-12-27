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
                <a class="navbar-brand" href="{{route("default")}}">Top<span class="navbar-brand--logo-mod">di</span>Top
                    H.O.M.E.</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Locations <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Stores<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route("front_stores") }}"><i class="fa fa-fw fa-cog"></i> All</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">References <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("front_references")}}">All</a></li>

                        </ul>
                    </li>
                    <li><a href="#">Open your online Store</a></li>
                    <li><a href="{{route("contact_page")}}">Contact us</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left alt ">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon search-icon"><i class="fa fa-search"
                                                                               aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Search Stores">
                                <span class="navmenu-search text-center x-icon pull-right"><i
                                            class="icon-plus"></i></span>

                            </div>
                        </div>
                    </form>
                    @if (Auth::check())
                        <li><a href="{{url('/logout')}}">Log Out</a></li>
                    @else
                        <li><a class="log-sig" href="{{url('/login')}}">Login</a></li>
                        <li class="top-14-correct">/</li>
                        <li><a class="log-sig registration-button" href="javascript:void(0)">Sign up</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>