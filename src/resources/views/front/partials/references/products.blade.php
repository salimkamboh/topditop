<div class="container">

    <h3 class="page-heading">{{trans('messages.products')}}</h3>

    <div class="row">
        @if(isset($selected_products))
            @foreach($selected_products as $selected_product)
                <div class="col-sm-4">
                    <div class="single-item item-shadow single-item-product"
                         data-product-id="{{$selected_product->id}}">
                        <img src="{{ $selected_product->getImageByThumb('reference_thumb') }}" alt=""
                             class="img-responsive">
                        <div class="item-info">
                            <div class="item-info-top clearfix">
                                <div class="width-fix">
                                    <span class="title">
                                        <a href="javascript:void(0)"
                                           data-product-id="{{$selected_product->id}}">{{$selected_product->title}}</a>
                                    </span>
                                    <span class="number-of pull-left">({{$selected_product->getNumberOfReferences()}}
                                        {{trans('messages.references')}})</span></div>
                                <span class="price"><i class="icon-eur"></i>{{$selected_product->price}}</span>
                            </div>
                            <div class="item-info-bottom reference-special">
                                <a href="{{route("front_show_store", $selected_product->store)}}" class=""><i
                                            class="icon-shopping-cart"></i>{{ $selected_product->store->store_name }}
                                </a>
                                <a class="product-no-link-brand" href="#" class="pull-left"><i
                                            class="fa fa-bookmark"></i>{{ $selected_product->manufacturer->name }}</a>
                                <a href="{{route('front_products')}}#{{$selected_product->id}}"
                                   class="shareBtn pull-right">+ {{trans('messages.share')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <h3 class="page-heading">{{trans('messages.brands')}}</h3>
    @if(isset($manufacturers))
        @for ($i = 0; $i < count($manufacturers); $i += 3)
            <div class="row">
                @if($i < count($manufacturers))
                    <div class="col-sm-4">
                        <div class="manufacturer manufacturer-id-{{$manufacturers->get($i)}}">
                            <a href="{{ route("front_brand_stores", $manufacturers->get($i)) }}">
                                <img alt="{{$manufacturers->get($i)->name}}" class="img-responsive full-width"
                                     src="{{$manufacturers->get($i)->getImageUrl()}}">
                            </a>
                        </div>
                    </div>
                @endif
                @if(($i + 1) < count($manufacturers))
                    <div class="col-sm-4">
                        <div class="manufacturer manufacturer-id-{{$manufacturers->get($i + 1)}}">
                            <a href="{{ route("front_brand_stores", $manufacturers->get($i + 1)) }}">
                                <img alt="{{$manufacturers->get($i + 1)->name}}" class="img-responsive full-width"
                                     src="{{$manufacturers->get($i + 1)->getImageUrl()}}">
                            </a>a
                        </div>
                    </div>
                @endif
                @if(($i + 2) < count($manufacturers))
                    <div class="col-sm-4">
                        <div class="manufacturer manufacturer-id-{{$manufacturers->get($i + 2)}}">
                            <a href="{{ route("front_brand_stores", $manufacturers->get($i + 2)) }}">
                                <img alt="{{$manufacturers->get($i + 2)->name}}" class="img-responsive full-width"
                                     src="{{$manufacturers->get($i + 2)->getImageUrl()}}">
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @endfor
    @endif
</div>