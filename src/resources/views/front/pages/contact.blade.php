@extends("master.front-layout")

@section("header")

@stop

@section("pageTitle") Contact Us @stop

@section('content')

    <section id="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <a class="navbar-brand" href="http://78.46.218.38/topditop2">Top<span
                                class="navbar-brand--logo-mod">di</span>Top
                        H.O.M.E.</a>
                    <div class="clearfix"></div>
                    <div class="data-holder">
                        <p><i class="fa fa-map-marker"></i>Margaretenstrassen 52, Vienna</p>
                        <p>
                            <i class="fa fa-clock-o"></i><span>Mon - Fri 10-19</span><span>Sat 10-18</span><span>Sun closed</span>
                        </p>
                        <p><i class="fa fa-globe"></i><a href="#" class="brown-color">wwww.wienfurniture.au</a></p>
                        <p><i class="fa fa-phone"></i><a href="#" class="brown-color">+4369911820719</a></p>
                        <div class="social-icon-holder">
                            <a href="#"><i class="fa fa-facebook-square"></i></a>
                        </div>
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