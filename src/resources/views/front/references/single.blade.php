@extends("master.front-layout")

@section("pageTitle") Reference | {{$reference->title}} @stop

@section("header")
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/embed.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/slick-theme.css') }}">
@stop

@section('content')
    @include('front.partials.components.modal-video')
    <section id="reference-single">
        @include('front.partials.references.info')
        @include('front.partials.references.images')
        @include('front.partials.references.products')
        @include('front.partials.modal.single-product')
    </section>
@endsection

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/lib/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/embed.min.js') }}"></script>
    <script type="text/javascript">
        $('.ui.dropdown').dropdown();
        $('.ui.embed').embed();

        var htmlSaved = $('modal-body-video').html();

        $('.ui.modal.modal-video').modal({
            onHide: function () {
                var htmlSaved = $('modal-body-video').html();
                $('modal-body-video').html('');
                $('modal-body-video').html(htmlSaved);
                $('.ui.embed').embed();
            }, onShow: function () {
                $('modal-body-video').html(htmlSaved);

            }, onVisible: function() {
                $('.ui.modal.modal-video').modal('refresh');
            }
        }).modal('attach events', '.show-video-modal', 'show');
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/embed.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/product-modal-front.js') }}"></script>
@stop