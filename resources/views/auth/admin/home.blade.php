@extends("master.admin-layout")

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
                <div class="col-sm-6 text-center">
                    <div class="card-item item-shadow">
                        <h2>References</h2>
                        <a class="click-button"
                           href="{{ route("dashboard_references") }}">{{ trans('messages.manage_reference') }}</a>
                        <a class="click-button"
                           href="{{ route("dashboard_reference_new") }}">{{ trans('messages.new_reference') }}</a>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="card-item item-shadow">
                        <h2>Products</h2>
                        <a class="click-button"
                           href="{{ route('dashboard_products') }}">{{ trans('messages.manage_product') }}</a>
                        <a class="click-button"
                           href="{{ route('dashboard_product_new') }}">{{ trans('messages.new_product') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section("footer")
@stop