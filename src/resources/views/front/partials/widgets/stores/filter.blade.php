<div class="col-sm-4 filter">
    <form method="post" action="{{route('stores_multi_filter')}}" class="filter-multi">
        <h4>{{trans('messages.filter_location')}}</h4>

        <div class="restore example">
            <div class="ui multiple selection dropdown" data-filter="location" tabindex="0">
                <input name="location_filter" type="hidden" value="">
                <i class="dropdown icon"></i>
                <div class="default text">{{trans('messages.locations')}}</div>
                <div class="menu" tabindex="-1">
                    @foreach($filter_locations as $location)
                        <div class="item" data-value="{{$location->id}}">{{$location->name}}
                            <span>({{$location->numberOfActiveStores()}})</span></div>
                    @endforeach
                </div>
            </div>
        </div>

        <h4 class="text-left">{{trans('messages.filter_brands')}}</h4>

        <div class="restore example">
            <div class="ui multiple selection dropdown" data-filter="brand" tabindex="0">
                <input name="brand_filter" type="hidden" value="">
                <i class="dropdown icon"></i>
                <div class="default text">{{trans('messages.brands')}}</div>
                <div class="menu" tabindex="-1">
                    @foreach($manufacturers as $manufacturer)
                        <div class="item"
                             data-value="{{$manufacturer->id}}">{{$manufacturer->name}}
                            <span>({{$manufacturer->numberOfStores()}})</span>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>

        <h4 class="text-left">{{ trans('messages.one_stop_shop') }}</h4>

        <div class="restore example">
            <div class="ui multiple selection dropdown" data-filter="onestopshop" tabindex="0">
                <input name="onestopshop_filter" type="hidden" value="">
                <i class="dropdown icon"></i>
                <div class="default text">Select Type</div>
                <div class="menu" tabindex="-1">
                    @foreach($fieldsOneStopShop as $field)
                        <div class="item" data-value="{{$field}}">{{$field}}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <a href="javascript:void(0)" class="clear-filter"><span>x</span>{{trans('messages.clear_filter')}}</a>

        {{csrf_field()}}
    </form>
</div>