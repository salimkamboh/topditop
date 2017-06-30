<section id="store-options">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>{{ trans('messages.one_stop_shop') }}</h3>
                <ul>
                    @foreach($datablock["onestopshop"] as $data)
                        <li>{{$data}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-4">
                <h3>TopdiTop Services</h3>
                <ul>
                    @foreach($datablock["TopDiTop_Service"] as $data)
                        <li>{{$data}}</li>
                    @endforeach
                </ul>
            </div>
            @if($store->package_name() != \App\Package::LOWEST)
                <div class="col-sm-4">
                    <h3>Neueste TopdiTop Marke</h3>
                    <ul>
                        <li>{{$datablock["newest_brand"]}}</li>
                    </ul>

                    <h3>Längste TopdiTop Markenpartnerschaft</h3>
                    <ul>
                        <li>{{$datablock["longest_brand"]}}</li>
                    </ul>

                    @if($store->package_name() == \App\Package::HIGHEST)
                        <h3>Architekten referenzen</h3>
                        <ul>
                            @foreach($architects as $data)
                                <li>{{$data}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

