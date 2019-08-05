<section id="store-options">
    <div class="container">
        <div class="row">
            @if($datablock["categories"])
            <div class="col-sm-4">
                <h3>{{ trans('messages.store_category') }}</h3>
                <ul>
                    @foreach($datablock["categories"] as $data)
                        <li>{{$data}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if($datablock["TopDiTop_Service"])
            <div class="col-sm-4">
                <h3>TopDiTop Services</h3>
                <ul>
                    @foreach($datablock["TopDiTop_Service"] as $data)
                        <li>{{$data}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if($store->package_name() != \App\Package::LOWEST)
                <div class="col-sm-4">
                    @if($datablock["newest_brand"])
                    <h3>Neueste TopDiTop Marke</h3>
                    <ul>
                        <li>{{$datablock["newest_brand"]}}</li>
                    </ul>
                    @endif
                    @if($datablock["longest_brand"])
                    <h3>Längste TopDiTop Markenpartnerschaft</h3>
                    <ul>
                        <li>{{$datablock["longest_brand"]}}</li>
                    </ul>
                    @endif
                    @if($store->package_name() == \App\Package::HIGHEST)
                        @if($architects)
                        <h3>Architekten referenzen</h3>
                        <ul>
                            @foreach($architects as $data)
                                <li>{{$data}}</li>
                            @endforeach
                        </ul>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

