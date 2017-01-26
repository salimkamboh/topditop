<div class="container margin-bottom-lg store-options">
    <div class="row">
        <div class="col-sm-4">
            <h3 class="store-options__heading"><span
                        class="store-options__heading__inner">One-Stop Shop for</span></h3>
            <ul class="store-options__list list-unstyled">
                @foreach($datablock["topditop_offer"] as $data)
                    <li>{{$data}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-4">
            <h3 class="store-options__heading"><span
                        class="store-options__heading__inner">TopdiTop Services</span></h3>
            <ul class="store-options__list list-unstyled">
                @foreach($datablock["TopDiTop_Service"] as $data)
                    <li>{{$data}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-4">
            <h3 class="store-options__heading"><span
                        class="store-options__heading__inner">Längste TopdiTop Markenpartnerschaft</span></h3>
            <ul class="store-options__list list-unstyled">
                <li>bulthaup</li>
            </ul>
            <h3 class="store-options__heading"><span
                        class="store-options__heading__inner">Neueste TopdiTop Marke</span></h3>
            <ul class="store-options__list list-unstyled">
                <li>Vitra</li>
            </ul>
        </div>
    </div>
</div>