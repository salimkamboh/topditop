<div class="col-sm-4 text-center">
    <div class="manage-reference new-products">
        <form class="pull-right" method="post" action="{{ route("sync_products", $current_store->id) }}">
            <button type="submit" class="synch"><span class="replace-logo"><i
                            class="icon-refresh padding-r-10-correct"></i>Synchronize</span></button>
            {{ csrf_field() }}
        </form>
        <h1>{{$numOfProducts}}</h1>
        <h2>Products</h2>
        <a href="{{ route("dashboard_product_new") }}" class="manage-ref">Add New Product</a>
    </div>

    <div class="search-field">
        <form class="navbar-form navbar-left alt">
            <div class="form-group">
                <div class="input-group">
                                <span class="input-group-addon search-icon">
                                    <i class="fa fa-search"></i>
                                </span>
                    <input type="text" class="form-control" placeholder="Search your products">
                </div>
            </div>
        </form>
    </div>
    <div class="filter-brands">

        <h4 class="text-left">Filter by Brands</h4>

        <form method="post" id="products-filter" action="{{route("filterproducts")}}">
            <div class="restore example">
                <div class="ui multiple selection dropdown">
                    <input name="gender" type="hidden" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">Default</div>
                    <div class="menu">
                        @foreach($manufacturers as $manufacturer)
                            <div class="item"
                                 data-value="{{$manufacturer->id}}">{{$manufacturer->name}} <span
                                        class="filter-options-number">(23)</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>

        <p class="clear-filter text-left"><span class="padding-r-5-correct">x</span>Clear Filter</p>

    </div>
</div>