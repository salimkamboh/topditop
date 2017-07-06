<div class="container">
    <div class="page-header text-center">
        <h1>{{ trans('messages.find_local_store_now') }}</h1>
        <h4>{{ trans('messages.new_inspiring_stores') }}</h4>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 about">
            <p>
                TopdiTop-Home ist ein Marktplatz der besten Designadressen für Inneneinrichtung, Sanitärkultur, Dekoration, Tafel und Tisch-Kultur.
            </p>
            <p>
                Die besten Design-Stores haben jetzt auch Ihr Zuhause im Netz: TopDiTop – Home of Design. TopdiTop-Home ist kein E-Commerce-Shop sondern ein Schauraum der Verbindungen und Möglichkeiten. In Verbindung mit einer mobilen APP wird die Navigation durch die Designwelt sekundenschnell optimiert. TopDiTop weist den Weg. Ziel sind die besten Premium-Stores.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <ul class="city-selector">
                @foreach($locations_footer as $location)
                    <li><a href="#" data-city="{{$location->key}}">{{$location->name}}</a> <sup>{{$location->numberOfStores()}}</sup></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10">
            <div id="map-canvas"></div>
        </div>
    </div>
</div>