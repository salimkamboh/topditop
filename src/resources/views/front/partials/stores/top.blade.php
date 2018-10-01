<section id="store-cover">
    <div class="store-heading">
        <hr>
        <h3><span>{{$store->store_name}}</span></h3>
    </div>
    <div class="container-fluid bg-black">
        <div class="row">
            <div class="col-md-8 no-padding store-cover__wrapper">
                @if ($store->isLight() & !$store->hasCoverImage())
                    <iframe
                            id="store-google-map-iframe"
                            width="100%"
                            height="450"
                            frameborder="0" style="border:0"
                            src="https://www.google.com/maps/embed/v1/place?key={{ config('services.google_maps.api_key') }}&q={{ $store->getGoogleQueryString() }}" allowfullscreen>
                    </iframe>
                @else
                    <img alt="" class="img-responsive store-cover__wrapper__light-image" src="{{$store->getStoreCoverImage()}}">
                @endif
            </div>
            <div class="col-md-4" id="front-store-info">
                <div class="content">
                    <div class="text-center hidden">
                    </div>
                    <h1>{{$store->store_name}}</h1>
                    <p>{{$datablock["description"]}}</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Address</h3>
                            <p>{!! $datablock["address"] !!}</p>
                            <p>PLZ: {{ $datablock["postal_code"] }}</p>
                            <p><a target="_blank" href="https://www.google.com/maps/place/{!! $datablock["address"] !!}"><i
                                            class="fa fa-map-marker" aria-hidden="true"></i> View map</a>
                            </p>
                        </div>
                        <div class="col-sm-6 text-left uhr">
                            <h3>Geöffnet</h3>
                            <p>Werktags: {{$datablock["from_working_days"]}} bis {{$datablock["to_working_days"]}}
                                Uhr</p>
                            <p>Samstags: {{$datablock["from_weekends"]}} bis {{$datablock["to_weekends"]}} Uhr</p>
                            <p>Telefonnummer: {{ $datablock["telephone_number"] }}</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('footer')
    @parent

    @if($store->isLight() & !$store->hasCoverImage())
        <script>
            var storeInfoEl = document.getElementById('front-store-info');
            var googleMapIframe = document.getElementById('store-google-map-iframe');
            resizeGoogleMap();
            $(window).resize(resizeGoogleMap);

            function resizeGoogleMap() {
                if (!storeInfoEl || !googleMapIframe) {
                    return;
                }
                googleMapIframe.style.height = storeInfoEl.offsetHeight + 'px';
            }
        </script>
    @endif
@endsection
