@extends("master.dashboard-layout")

@section("pageTitle")
    @if(!isset($product->id))
        Add Product
    @else
        Edit Product {{$product->title}}
    @endif
@stop

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dropzone/dropzone.css') }}">
@stop

@section("content")

    <section id="dashboard-new-product">
        <div class="container">
            <div class="row">

                @include('dashboard.partials.component.breadcrumbs-product')

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4">
                            @include('dashboard.partials.widgets.product-single')
                        </div>
                        <div class="col-sm-8">
                            @include('dashboard.partials.products.info')
                            @include('dashboard.partials.products.images')
                            @include('dashboard.partials.component.dropzone-previews-product')
                            @include('dashboard.partials.products.references-for-product')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('footer')
    <script type="text/javascript" src="{{ asset('assets/dropzone/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/product.js') }}"></script>
@stop