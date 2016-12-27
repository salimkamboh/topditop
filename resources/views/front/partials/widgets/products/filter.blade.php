<form method="post" action="{{route('products_front_multi_filter')}}" id="frontmultifilterproducts" class="filter-multi">

    <h4>{{trans('messages.filter_stores')}}</h4>

    <div class="restore example">
        <div class="ui multiple selection dropdown" data-filter="store" tabindex="0">
            <input name="store_filter" type="hidden" value="">
            <i class="dropdown icon"></i>
            <div class="default text">Stores</div>
            <div class="menu" tabindex="-1">
                @foreach($stores as $store)
                    <div class="item"
                         data-value="{{$store->id}}">{{$store->store_name}}
                        <span>({{$store->getNumberOfProducts()}})</span></div>
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
                        <span>({{$manufacturer->numberOfProducts()}})</span></div>
                @endforeach
            </div>
        </div>
    </div>

    {{csrf_field()}}

</form>

<a href="javascript:void(0)" class="clear-filter"><span>x</span>{{trans('messages.clear_filter')}}</a>