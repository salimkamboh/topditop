<div class="container">
    <div class="row margin-top-lg margin-bottom-sm">
        <div class="col-sm-8 text-left">
            <h3>Our April Product Selection</h3>
        </div>
        <div class="col-sm-4 text-right">
            <div class="sortable">
                <div class="sortable__half-block">
                    <button class="btn btn-primary btn-block">Newest</button>
                </div>
                <div class="sortable__half-block">
                    <button class="btn btn-primary btn-block active">Most Viewed</button>
                </div>
            </div>
        </div>
    </div>
    <div class="margin-bottom-lg">
        <div class="margin-bottom-lg">
            <div class="row">
                <?php /** @var $product App\Product */ ?>
                @foreach($products as $product)
                    <div class="col-sm-4">
                        <div class="store-item min-height-360">
                                <img alt="" class="img-responsive"
                                     src="{{$product->getImageByThumb('reference_thumb')}}">

                            <div class="store-item__info-wrapper">
                                <div class="store-item-info">
                                    <span class="store-item-title">{{$product->title}}</span>
                                    <span class="store-item-references">({{$product->getNumberOfReferences()}} references)</span>
                                    <span class="store-item-price"><i class="fa fa-euro"></i>{{$product->price}}</span>
                                </div>
                                <div class="store-item-info-2 text-justify">
                                    <a href="#" class="items-addon-info">
                                        <i class="fa fa-shopping-cart"></i>{{$store->store_name}}
                                    </a>
                                    <a href=""><i class="fa fa-bookmark" aria-hidden="true"></i>{{$product->getManufacturer()}}
                                    </a>
                                    <a href="" class="store-item-share">
                                        + Share
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
            <a href="{{route("front_products")}}" class="btn btn-default btn-call">View All Products</a>
        </div>
    </div>
</div>