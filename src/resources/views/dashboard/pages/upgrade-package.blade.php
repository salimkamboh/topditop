@extends("master.dashboard-layout")

@section("pageTitle") Dashboard - Upgrade @stop

@section("header")

@stop

@section("content")

    <section id="dashboard-home">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="text-left">{{ trans('messages.available_res') }}
                        <a href="#">{{ trans('messages.upgrade') }}</a>.</h3>
                </div>
            </div>
        </div>
    </section>

@stop

@section("footer")
@stop