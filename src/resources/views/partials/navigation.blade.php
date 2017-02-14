<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route("admin", App::getLocale()) }}">Top<span class="admin-logo-mod">Di</span>Top
            H.O.M.E. <span
                    class="admin-logo-mod-subtext">Admin Panel: {{$store->store_name}}</span></a>
    </div>

    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle"><i class="fa fa-user"></i> John Smith <b
                        class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('view_profile', $store->profile) }}"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a target="_blank" href="{{ route('front_show_store', $store) }}"><i
                                class="fa fa-fw fa-envelope"></i> Preview Store</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{url('/logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="{{ route("admin", App::getLocale()) }}"><i class="fa fa-fw fa-dashboard"></i> Overview</a>
            </li>
            <li>
                <a href="{{ route("settings") }}"><i class="fa fa-fw fa-cog"></i> Settings</a>
                <ul>
                    <li><a href="{{ route("allstores") }}"><i class="fa fa-fw fa-plus"></i> Temporary Stores</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route("references") }}"><i class="fa fa-fw fa-list"></i> References</a>
                <ul>
                    <li><a href="{{ route("add_reference") }}"><i class="fa fa-fw fa-plus"></i> Add Reference</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route("products") }}"><i class="fa fa-fw fa-list-alt"></i> Products</a>
            </li>
            <li>
                <a href="{{ route("add_fieldtype") }}"><i class="fa fa-fw fa-list-alt"></i> Add Field Type</a>
            </li>
            <li>
                <a href="{{ route("add_field") }}"><i class="fa fa-fw fa-list-alt"></i> Add Field</a>
            </li>
            <li>
                <a href="{{ route("add_fieldgroup") }}"><i class="fa fa-fw fa-list-alt"></i> Add Field Group</a>
            </li>
            <li>
                <a href="{{ route("show_packages") }}"><i class="fa fa-fw fa-list"></i> Packages</a>
                <ul>
                    <li>
                        {{--<a href="{{ route("add_package") }}"><i class="fa fa-fw fa-list-alt"></i> Add Package</a>--}}
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>