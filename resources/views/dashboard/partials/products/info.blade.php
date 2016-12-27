<h5>{{ trans('messages.basic_prod_info') }}</h5>

<div class="big-white-block">
    <form action="@if(!isset($product->id)){{ route("insertproduct") }}@else{{ route("updateproduct", $product) }}@endif"
          id="insertproduct" method="post" enctype="multipart/form-data">
        <div class="form-holder">
            <label for="product_title">{{ trans('messages.product_name') }}:</label><br>
            <input type="text" name="product_title" id="product_title" value="{{$product->title}}">
        </div>
        <div class="form-holder">
            <label for="product_price">{{ trans('messages.price') }}:</label><br>
            <i class="icon-eur"></i><input type="text" name="product_price" id="product_price" value="{{$product->price}}">
        </div>
        <div class="form-holder">
            <label for="product_description">{{ trans('messages.description') }}:</label><br>
            <textarea cols="30" rows="7" name="product_description" id="product_description">{{$product->description}}</textarea>
        </div>
        <div class="form-holder">
            <label>{{ trans('messages.product_brand') }}:</label><br>
            <div class="ui dropdown dropdown-brand full-width" tabindex="0">
                <input name="manufacturer" type="hidden"
                       value="@if($product->getManufacturer() != ''){{ /** @var $product App\Product */ $product->getManufacturer() }}@endif">
                <div class="default text new-brand">Choose brands</div>
                <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    @foreach($manufacturers as $manufacturer)
                        <div class="item"
                             data-value="{{$manufacturer->id}}">{{$manufacturer->name}} <span
                                    class="filter-options-number">({{$manufacturer->numberOfReferences()}}
                                )</span></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form-holder">
            <label>{{ trans('messages.product_category') }}:</label><br>
            <div class="ui multiple selection dropdown dropdown-categories" tabindex="0">
                <input name="categories" type="hidden"
                       value="@if(isset($product->categories)){{ $product->getCategories() }}@endif">
                <i class="dropdown icon"></i>
                <div class="default text">Choose Categories</div>
                <div class="menu transition hidden" tabindex="-1">
                    @foreach($categories as $cat)
                        <div class="item"
                             data-value="{{$cat->id}}">{{$cat->name}} <span
                                    class="filter-options-number">({{$cat->numberOfProducts()}}
                                )</span></div>
                    @endforeach
                </div>
            </div>
        </div>

        <a href="#" class="click-button save_product">@if(!isset($product->id)){{ trans('messages.insert_product') }} @else {{ trans('messages.save_changes') }} @endif </a>

        {{ csrf_field() }}

    </form>
</div>