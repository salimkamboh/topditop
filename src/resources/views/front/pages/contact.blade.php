@extends("master.front-layout")

@section("header")

@stop

@section("pageTitle") Contact Us @stop

@section('content')

    <section id="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <a class="navbar-brand" href="{{ route('default') }}">Top<span
                                class="navbar-brand--logo-mod">Di</span>Top
                        H.O.M.E.</a>
                    <div class="clearfix"></div>
                    <div class="data-holder">
                        <p>TopDiTop H.O.M.E.</p>
                        <p><a href="https://goo.gl/maps/FFG4K2tdH612" target="_blank">Schlesische Straße 29/30</a></p>
                        <p>Aufgang M / 3. Stock</p>
                        <p>10997 Berlin</p>
                        <p>Tel.: +49 (0)30 611308-0</p>
                        <p>Fax: +49 (0)30 611308-8</p>
                        <p>E-Mail: <a href="mailto:info@topditop.com" target="_blank">info@topditop.com</a></p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <h3 class="page-heading">{{ trans('messages.free_to_contact') }}</h3>
                    <form method="post" id="contact-form-form" action="{{route('post_contact_page')}}">
                        <div class="form-group">
                            <label for="customer_name">Name:</label>
                            <input id="customer_name" name="customer_name" type="text" placeholder="NAME">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('messages.email_address') }}:</label>
                            <input id="email" name="customer_email" type="text" placeholder="EMAIL">
                        </div>
                        <div class="form-group">
                            <input type="text" name="customer_phone" placeholder="{{ trans('messages.telefon') }}">
                        </div>
                        <div class="form-group">
                            <textarea cols="20" rows="5" id="contact-message" name="customer_message"
                                      placeholder="Enter your message here"></textarea>
                        </div>
                        <button style="width: 100%;max-width: 100%;" class="click-button send-contact-email">{{ trans('messages.send_message') }}
                        </button>
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/contact-script.js')}}"></script>
@stop