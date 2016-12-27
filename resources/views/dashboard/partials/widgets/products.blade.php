<div class="col-sm-4 filter">

    <div class="widget-side item-shadow">
        <h1>{{$numberOfProducts}}</h1>
        <h2>{{ trans('messages.products') }}</h2>
        <a href="{{ route("dashboard_product_new") }}" class="click-button">{{ trans('messages.new_product') }}</a>
    </div>

    <form method="post" id="products-filter" action="{{route("products_multi_product")}}">

        <div class="search-field">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon search-icon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control" id="product_search_term" name="product_search_term" placeholder="{{ trans('messages.serach_y_products') }}">
                </div>
            </div>
        </div>

        <h4 class="text-left">{{trans('messages.filter_brands')}}</h4>
        <div class="restore example">
            <div class="ui multiple selection dropdown">
                <input name="manufacturer" type="hidden" value="">
                <i class="dropdown icon"></i>
                <div class="default text">Default</div>
                <div class="menu">
                    @foreach($manufacturers as $manufacturer)
                        <div class="item"
                             data-value="{{$manufacturer->id}}">{{$manufacturer->name}} <span
                                    class="filter-options-number">({{$manufacturer->numberOfProductsForStore($store, $manufacturer->id)}})</span></div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>

    <a href="javascript:void(0)" class="clear-filter"><span>x</span>{{ trans('messages.clear_filter') }}</a>

</div>