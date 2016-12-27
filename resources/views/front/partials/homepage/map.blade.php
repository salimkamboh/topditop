<div class="container">
    <div class="page-header text-center">
        <h1>{{ trans('messages.find_local_store_now') }}</h1>
        <h4>{{ trans('messages.new_inspiring_stores') }}</h4>
    </div>
    <div class="row">
        <div class="col-md-2">
            <ul class="city-selector">
                @foreach($locations_footer as $location)
                    <li><a href="#" data-city="{{$location->key}}">{{$location->name}}</a> <sup>{{$location->numStores}}</sup></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10">
            <div id="map-canvas"></div>
        </div>
    </div>
</div>