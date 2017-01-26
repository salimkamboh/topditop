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
                    <h3>{{ trans('messages.upload_logo') }}</h3>
                    <form action="{{route("dashboard_settings_image_save")}}" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="store_image" id="store_image" class="form-control">
                        </div>
                        @if(isset($store->image))
                            <img style="max-width:200px; height:auto" src="{{$store->image->getImageUrl()}}" alt="">
                        @endif

                        <div class="form-group">
                            <input type="submit" value="{{ trans('messages.edit_logo') }}" class="click-button">
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
