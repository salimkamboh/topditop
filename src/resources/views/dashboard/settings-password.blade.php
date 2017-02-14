@extends("master.dashboard-layout")

@section("pageTitle") Profile Settings @stop

@section("header")
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/settings.css') }}">
@stop

@section("content")
    <section id="dashboard-settings">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 pagination-main">
                    <a href="{{ route('dashboard_home') }}">
                        <i class="icon-arrow-left"></i>
                        <span class="back-dashboard">{{ trans('messages.back_dashboard') }}</span>
                    </a>
                    <h3>{{ trans('messages.store_settings') }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <div class="widget item-shadow">
                        @if(isset($store->image))
                            <img src="{{$store->image->getImageUrl()}}" alt="">
                        @endif
                        <h3>{{$store->store_name}}</h3>

                        <a href="{{route("dashboard_settings_image")}}"><span class="replace-logo"><i
                                        class="icon-refresh"></i>{{ trans('messages.replace_logo') }}</span></a>
                    </div>
                </div>
                <div class="col-sm-8 big-white-block store-image item-shadow">

                    <h3>{{ trans('messages.profil_edit') }}</h3>

                    <form action="{{route("dashboard_settings_password_edit")}}" method="post"
                          enctype="multipart/form-data">
                        <div>
                            <p>{{ trans('messages.change_pass') }}</p>
                            <p>{{ trans('messages.rules') }}:</p>
                            <ul>
                                <li>{{ trans('messages.pass_contain') }}</li>
                                <li>{{ trans('messages.pass_character') }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <input class="password-change" type="password" name="old_password" placeholder="Old pass"/>
                        </div>

                        <div class="form-group">
                            <input class="password-change" type="password" name="password" placeholder="New pass"/>
                        </div>

                        <h3>{{ trans('messages.newsletter_data') }}</h3>
                        <div class="form-group">
                            <input class="password-change" type="text" name="newsletter_key_1" placeholder="API KEY"
                                   value="{{$store->profile->getApi1('newsletter_key_1')}}"/>
                        </div>

                        <div class="form-group">
                            <input class="password-change" type="text" name="newsletter_key_2" placeholder="List ID"
                                   value="{{$store->profile->getApi1('newsletter_key_2')}}"/>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="{{ trans('messages.profil_edit') }}" class="click-button">
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/store-settings.js') }}"></script>
@stop
