<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <img src="{{ asset('assets/img/topditop-logo-inverse.jpg') }}" class="topditop-logo img-responsive" alt="TopDiTop Home Logo">
            </div>
            <div class="col-xs-6">
                @if (Auth::check())
                    <div class="pull-right">
                        <a href="{{route('dashboard_settings_profile')}}" class="btn btn-default">{{ trans('messages.edit_profil_footer') }}</a>
                        <a href="{{url('/logout')}}" class="btn btn-default">Log Out</a>
                    </div>
                @else
                    <div class="pull-right">
                        <a class="btn btn-default login-modal-open" href="{{url('/login')}}">Login</a>
                        <a class="btn btn-default registration-button" href="javascript:void(0)">Sign up</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="row">
            <div class="col-md-2 col-sm-6">
                <div class="list-group">
                    <h5 class="list-title">{{ trans('messages.cities') }}</h5>
                    <ul class="list-unstyled list-items">
                        @foreach($locations_footer as $location)
                            <li>
                                <a href="{{route('front_stores_by_location', $location)}}">{{$location->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="list-group">
                    <h5 class="list-title">Stores</h5>
                    <ul class="list-unstyled list-items">
                        @foreach($stores_footer as $store)
                            <li><a href="{{route('front_show_store', $store)}}">{{$store->store_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="list-group">
                    <h5 class="list-title">{{ trans('messages.products') }}</h5>
                    <ul class="list-unstyled list-items">
                        @foreach($products_footer as $product)
                            <li><a href="{{route('front_products')}}#{{$product->id}}">{{$product->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="list-group">
                    <h5 class="list-title">About</h5>
                    <ul class="list-unstyled list-items">
                        <li><a href="{{ route('front_terms_page') }}">AGBs</a></li>
                        <li><a href="{{ route('front_impressum_page') }}">Impressum</a></li>
                        <li><a href="{{ route('front_privacy_page') }}">Datenschutz</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>