@extends("master.dashboard-layout")

@section("pageTitle") Dashboard @stop

@section("header")

@stop

@section("content")

    <section id="dashboard-home">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-left">Store Dashboard</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 first">
                    <div class="card-item item-shadow">
                        <div class="image-holder">
                            <a href="{{route("dashboard_settings_image")}}"><span class="replace-logo"><i
                                            class="icon-refresh"></i>{{ trans('messages.replace_logo') }}</span></a>
                            <img class="img-responsive" src="{{$store->getStoreLogo()}}">
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3>{{$store->store_name}}</h3>
                            </div>
                            <div class="col-md-6 separator-bottom">
                                <a href="{{ route('dashboard_settings') }}"><i
                                            class="icon-cogs"></i><span>{{ trans('messages.edit_general') }}</span></a>
                                <a href="{{ route('dashboard_settings') }}"><i class="icon-asterisk"></i><span>{{ trans('messages.top_settings') }}</span></a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('dashboard_settings') }}"><i
                                            class="icon-phone"></i><span>{{ trans('messages.info_contact') }}</span></a>
                                <a href="{{ route('dashboard_settings') }}"><i
                                            class="icon-group"></i><span>{{ trans('messages.partners') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @if($store->package_name() !== \App\Package::LOWEST)
                    <div class="col-sm-4 text-center">
                        <div class="card-item item-shadow">
                            <h1>{{$numberOfReferences}}</h1>
                            <h2>{{ trans('messages.references') }}</h2>
                            <a class="click-button" href="{{ route("dashboard_references") }}">{{ trans('messages.manage_reference') }}</a>
                            <a class="click-button" href="{{ route("dashboard_reference_new") }}">{{ trans('messages.new_reference') }}</a>
                        </div>
                    </div>
                    <div class="col-sm-4 text-center">
                        <div class="card-item item-shadow">
                            <h1>{{$numOfProducts}}</h1>
                            <h2>{{ trans('messages.products') }}</h2>
                            <a class="click-button" href="{{ route('dashboard_products') }}">{{ trans('messages.manage_product') }}</a>
                            <a class="click-button" href="{{ route('dashboard_product_new') }}">{{ trans('messages.new_product') }}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@stop

@section("footer")
    <script type="text/javascript">
        $('.ui.dropdown').dropdown();
    </script>
@stop