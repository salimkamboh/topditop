<div class="store-cover">
    <div class="store-cover__heading">
        <hr>
        <h3 class="store-cover__heading__title text-center"><span
                    class="store-cover__heading__title--inner">{{$store->store_name}}</span></h3>
    </div>
    <div class="container-fluid bg-black">
        <div class="row">
            <div class="col-md-8">
                <img alt="" class="img-responsive"
                     src="{{$store->getStoreCoverImage()}}">
            </div>
            <div class="col-md-4">
                <div class="store-cover__body">
                    <div class="text-center hidden">
                        {{--<img src="img/store-logo.png" alt="" class="store-cover__body__logo">--}}
                    </div>
                    <h3 class="store-cover__body__title text-center">{{$store->store_name}}</h3>
                    <p>{{$datablock["description"]}}</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="store-cover__body__heading">Address</h4>
                            <p>
                                {!! $datablock["address"] !!}
                            </p>
                            <p>
                                <a href="http://topditop.bitballoon.com/#" class="btn btn-primary btn-xs"><i
                                            class="fa fa-map-marker" aria-hidden="true"></i> View map</a>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="store-cover__body__heading">Geöffnet</h4>
                            <p>Werktags: {{$datablock["from_working_days"]}} bis {{$datablock["to_working_days"]}}
                                Uhr</p>
                            <p>Samstags: {{$datablock["from_weekends"]}} bis {{$datablock["to_weekends"]}} Uhr</p>
                        </div>
                    </div>

                    <h4 class="store-cover__body__heading">Philosophie</h4>
                    <p>{{$datablock["philosophy"]}}</p>

                    <h4 class="store-cover__body__heading">Zitat</h4>
                    <p>{{$datablock["quotation"]}}</p>

                    <h4 class="store-cover__body__heading">Ihr Ansprechpartner</h4>
                    <p>
                        {{$datablock["owner"]}}
                        <br>
                        {{$datablock["telephone_number"]}}
                        <br>
                        Email: <a href="mailto:{{$datablock["contact_mail"]}}">{{$datablock["contact_mail"]}}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="store-cover__underbox">
    </div>
</div>