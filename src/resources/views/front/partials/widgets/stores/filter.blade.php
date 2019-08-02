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
                            {{-- stores_count has been eager loaded --}}
                            <span>({{ $location->stores_count }})</span></div>
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
                            <span>({{ count($manufacturer->stores) }})</span>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>

        <h4 class="text-left">{{ trans('messages.filter_category') }}</h4>

        <div class="restore example">
            <div class="ui multiple selection dropdown" data-filter="categories" tabindex="0">
                <input name="categories_filter" type="hidden" value="">
                <i class="dropdown icon"></i>
                <div class="default text">{{ trans('messages.category_choose') }}</div>
                <div class="menu" tabindex="-1">
                    @foreach($categories as $category)
						@if (count($category->stores) > 0)
							<div class="item" data-value="{{$category->id}}">{{$category->name}}
								<span>({{ count($category->stores) }})</span>
							</div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <a href="{{ route('front_stores') }}" class="clear-filter"><span>x</span>{{trans('messages.clear_filter')}}</a>

        {{csrf_field()}}
    </form>
</div>
