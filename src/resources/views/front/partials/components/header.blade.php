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
                <a href="{{ route('default') }}">
                    <img src="{{ asset('assets/img/topditop-logo.jpg') }}" class="topditop-logo img-responsive" alt="TopDiTop Home Logo">
                </a>
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
                    <li>
                        <a href="{{ route("front_stores") }}">{{ trans('messages.stores') }}</a>
                    </li>
                    <li>
                        <a href="{{route("front_brand_references_index")}}">{{ trans('messages.references') }}</a>
                    </li>
                    <li><a href="{{route('front_contact_page')}}">{{ trans('messages.contact_us') }}</a></li>

                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle">{{ trans('messages.dashboard') }} <span
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
                    @else
                        <li><a class="registration-button" href="#">{{trans('messages.open_your_store_online')}}</a></li>
                    @endif

                    <li class="mobile-app-link mobile-app-ios">
                        <a href="https://itunes.apple.com/us/app/topditop-home/id1266287332?mt=8" target="_blank">
                            <img src="https://developer.apple.com/app-store/marketing/guidelines/images/badge-example-preferred.png" alt="Download on the App Store">
                        </a>
                    </li>
                    <li class="mobile-app-link mobile-app-android">
                        <a href='https://play.google.com/store/apps/details?id=com.topditop.recognition&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1' target="_blank">
                            <img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png'/>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left alt" action="{{route('front_show_store_results')}}"
                          method="get">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon search-icon"><i class="fa fa-search"></i></span>
                                <input type="text" name="name" class="form-control" placeholder="{{ trans('messages.search_stores') }}">
                            </div>
                        </div>
                    </form>
                    <li>
                        <a href="#" class="open-newsletter-in-navbar-modal">Newsletter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@include('front.partials.modal.newsletter-navbar')