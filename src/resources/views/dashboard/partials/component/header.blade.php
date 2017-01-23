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
                <a class="navbar-brand" href="{{ route("default") }}">Top<span
                            class="navbar-brand--logo-mod">di</span>Top
                    H.O.M.E.</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">{{ trans('messages.locations') }}<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($locations_footer as $location)
                                <li>
                                    <a href="{{ route("front_stores_by_location", $location) }}">{{$location->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Stores <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route("front_stores") }}"><i class="fa fa-fw fa-cog"></i>{{ trans('messages.all') }}</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle">Dashboard<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route("dashboard_home") }}"><i class="fa fa-fw fa-cog"></i> {{ trans('messages.home') }}</a>
                            </li>
                            <li><a href="{{ route("dashboard_settings") }}"><i class="fa fa-fw fa-cog"></i> {{ trans('messages.settings') }}</a>
                            </li>
                            <li><a href="{{ route("dashboard_references") }}"><i class="fa fa-fw fa-cog"></i>
                                    {{ trans('messages.references') }}</a></li>
                            <li><a href="{{ route("dashboard_products") }}"><i class="fa fa-fw fa-cog"></i> {{ trans('messages.products') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left alt" action="{{route('front_show_store_results')}}"
                          method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon search-icon"><i class="fa fa-search"></i></span>
                                <input type="text" name="search_store" class="form-control" placeholder="{{ trans('messages.search_stores') }}">
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                </ul>
            </div>
        </div>
    </nav>
</header>
