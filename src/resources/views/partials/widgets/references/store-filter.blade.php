<div class="filter-brands">
    <h4 class="text-left">Filter by Stores</h4>
    <form method="post" id="products-filter" action="{{route("filterproducts")}}">
        <div class="restore example">
            <div class="ui multiple selection dropdown">
                <input name="gender" type="hidden" value="">
                <i class="dropdown icon"></i>
                <div class="default text">Default</div>
                <div class="menu">
                    @foreach($stores as $store)
                        <div class="item"
                             data-value="{{$store->id}}">{{$store->store_name}} <span
                                    class="filter-options-number">(23)</span></div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
    <p class="clear-filter text-left"><span class="padding-r-5-correct">x</span>Clear Filter</p>

</div>