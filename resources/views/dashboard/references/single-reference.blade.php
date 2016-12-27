@extends("master.dashboard-layout")

@section("pageTitle")
    @if(!isset($reference->id))
        Add Reference
    @else
        Edit Reference {{$reference->title}}
    @endif
@stop

@section('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dropzone/dropzone.css') }}">
    <style>
        .dz-processing {
            opacity: 0.5;
        }

        .dz-processing.dz-complete {
            opacity: 1;
        }
    </style>
@stop

@section("content")

    <section id="dashboard-new-references">
        <div class="container">
            <div class="row">
                @include('dashboard.partials.component.breadcrumbs')
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4">
                            @include('dashboard.partials.widgets.references')
                        </div>
                        <div class="col-sm-8">
                            @include('dashboard.partials.references.info')
                            @include('dashboard.partials.references.scenes')
                            @include('dashboard.partials.component.dropzone-previews')
                            @if($store->package_name() == 'TopDiTop Store')
                            @include('dashboard.partials.references.products')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('footer')
    <script type="text/javascript" src="{{ asset('assets/dropzone/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/reference.js') }}"></script>
@stop