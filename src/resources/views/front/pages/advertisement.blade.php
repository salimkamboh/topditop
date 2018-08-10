@extends("master.front-layout")

@section("pageTitle") Advertisement @stop

@section("header")

@stop

@section('content')

    <section id="advertisement">
        <a href="{{ route('front_show_store', $closestStore) }}">
        <img src="{{$closestStore->getStoreCoverImage()}}" alt="" class="img-responsive">
        </a>

        <div class="content">
            <h1><a href="{{ route('front_show_store', $closestStore) }}">{{$closestStore->store_name}}</a></h1>
            <p>{{$datablock["description"]}}</p>
            <div class="row ">
                <div class="col-sm-6">
                    <h3>Address</h3>
                    <p>{!! $datablock["address"] !!}</p>
                    <p>{{$closestStore->location->name}}</p>
                    <a class="mapicon" target="_blank"
                       href="https://www.google.com/maps/place/{!! $datablock["address"] !!}"><i
                                class="fa fa-map-marker" aria-hidden="true"></i> View map</a>
                </div>
                <div class="col-sm-6 text-left uhr">
                    <h3>Geöffnet</h3>
                    <p>Werktags: {{$datablock["from_working_days"]}} bis {{$datablock["to_working_days"]}}
                        Uhr</p>
                    <p>Samstags: {{$datablock["from_weekends"]}} bis {{$datablock["to_weekends"]}} Uhr</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <h3>Philosophie</h3>
            <p>{{$datablock["philosophy"]}}</p>
            <h3>Zitat</h3>
            <p>{{$datablock["quotation"]}}</p>
            <h3>Ihr Ansprechpartner</h3>
            <p>{{$datablock["owner"]}}</p>
            <p>Tel. {{$datablock["telephone_number"]}}</p>
            <p>Email: {{$datablock["contact_mail"]}}</p>
        </div>

        <h2>Product you&rsquo;re looking for</h2>
        <img src="{{$advert->getScannedImageUrl()}}" alt="" class="img-responsive">

        <h2>Brand</h2>

        <div class="text-center">
            <img style="display: inline-block;" src="{{$advert->getBrandLogoUrl()}}" alt="" class="img-responsive">
        </div>

        <h2>Local Stores that have this Brand</h2>
        <h5>Discover new inspiring stores near you or in desired city</h5>
        <div id="map-canvas"></div>

        <h2>Other References of this Store</h2>
        <div class="text-center">
            <img style="display: inline-block;" src="{{$advert->getReferenceImageUrl()}}"
                 alt="" class="img-responsive">
        </div>
    </section>


@endsection

@section("footer")
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrkUQEYz2K7WQ6L6RgLKncCfK727djyms&v=3.25&language=ee"></script>
    <script type="text/javascript">

        var map;
        var locationsJSON = null;
        locationsJSON = '{!!json_encode($locationsMatch)!!}';
        locationsJSON = JSON.parse(locationsJSON);
        initialize();

        function initialize() {

            map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 10,
                center: new google.maps.LatLng(locationsJSON.mainLat, locationsJSON.mainLong),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;


            $.each(locationsJSON.stores, function (index, store) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(store[0], store[1]),
                    map: map,
                    icon: _globalRoute + '/assets/img/mapicon.png'
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        var contentString =
                                '<div class="container-fluid map-holder-over">' +
                                '   <div class="">' +
                                '       <a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + store[2] + '">' +
                                            store[3] +
                                '       </a>' +
                                '   </div>' +
                                '</div>';

                        infowindow.setContent(contentString);
                        infowindow.open(map, marker);
                    }
                })(marker, i));

            });
        }
    </script>
@stop
