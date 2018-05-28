<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer_logo">
                    Top<span class="logo-inverse">Di</span>Top H.O.M.E.
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">

                    <div class="col-md-2">
                        <div class="list-group">
                            <h5 class="list-title">Users</h5>
                            <ul class="list-unstyled list-items">
                                @if (Auth::check())
                                    <li><a href="{{route('dashboard_settings_profile')}}">{{ trans('messages.edit_profil_footer') }}</a></li>
                                    <li><a href="{{url('/logout')}}">Log Out</a></li>
                                @else
                                    <li><a class="log-sig login-modal-open" href="{{url('/login')}}">Login</a></li>
                                    <li><a class="log-sig registration-button" href="javascript:void(0)">Sign up</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <div class="list-group">
                            <h5 class="list-title">Stores</h5>
                            <ul class="list-unstyled list-items">
                                @foreach($stores_footer as $store)
                                    <li><a href="{{route('front_show_store', $store)}}">{{$store->store_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
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
                    <div class="col-md-2">
                        <div class="list-group">
                            <h5 class="list-title">Connect</h5>
                            <ul class="list-unstyled list-items">
                                <li><a href="https://www.facebook.com/">Facebook</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="list-group">
                            <h5 class="list-title">About</h5>
                            <ul class="list-unstyled list-items">
                                <li><a href="{{ route('front_terms_page') }}">AGBs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>