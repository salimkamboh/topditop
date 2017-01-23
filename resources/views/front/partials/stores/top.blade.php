<section id="store-cover">
    <div class="store-heading">
        <hr>
        <h3><span>{{$store->store_name}}</span></h3>
    </div>
    <div class="container-fluid bg-black">
        <div class="row">
            <div class="col-md-8 no-padding">
                <img alt="" class="img-responsive"
                     src="{{$store->getStoreCoverImage()}}">
            </div>
            <div class="col-md-4">
                <div class="content">
                    <div class="text-center hidden">
                    </div>
                    <h1>{{$store->store_name}}</h1>
                    <p>{{$datablock["description"]}}</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Address</h3>
                            <p>{!! $datablock["address"] !!}</p>
                            <p><a target="_blank" href="https://www.google.com/maps/place/{!! $datablock["address"] !!}"><i
                                            class="fa fa-map-marker" aria-hidden="true"></i> View map</a>
                            </p>
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
                    <a class="mobile-tel" href="tel:{{$datablock["telephone_number"]}}">Tel.{{$datablock["telephone_number"]}}</a>
                    <p>Email: <a class="mail-link" href="mailto:{{$datablock["contact_mail"]}}">{{$datablock["contact_mail"]}}</a></p>
                </div>
            </div>
        </div>
    </div>
</section>