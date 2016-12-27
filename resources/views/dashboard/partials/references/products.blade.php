<h5>{{ trans('messages.reference_product') }}</h5>
<div class="row reference-product-holder">
    @if(isset($selected_products))
        @foreach($selected_products as $selected_product)
            <div class="col-md-6">
                <div class="single-item item-shadow">
                    <img src="{{ $selected_product->getImageByThumb('reference_thumb') }}" alt="" class="img-responsive">
                    <div class="item-info">
                        <div class="item-info-top clearfix">
                            <span class="title">{{$selected_product->title}}</span>
                            <span class="number-of pull-left">({{$selected_product->getNumberOfReferences()}} {{ trans('messages.references') }})</span>
                            <span class="price"><i class="icon-eur"></i>{{$selected_product->price}}</span>
                        </div>
                        <div class="item-info-bottom">
                            <a href="#" class="pull-left separator-bottom"><i class="icon-tags"></i>
                                {{$selected_product->manufacturer->name}}</a>
                            <div class="clearfix"></div>
                        </div>
                        <a href="{{ route('dashboard_product_edit', $selected_product) }}"
                           class="click-button">{{ trans('messages.manage_product') }}</a>
                        <form action="{{ route('dashboard_product_delete_from_reference', [$reference, $selected_product]) }}"
                              method="POST">
                            <button class="click-button">{{ trans('messages.delete_product') }}</button>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="col-md-6">
        <div class="single-item empty-item item-shadow">
            <a href="javascript:void(0)" class="connect-product">
                <i class="icon-plus-sign"></i>
                <p>{{ trans('messages.connect_another_prod') }}</p>
            </a>
        </div>
    </div>
</div>

<div class="ui modal" style="position: relative; overflow: visible;">
    <i class="close icon"></i>
    <div class="header">Choose Product for this reference</div>
    <div class="content">
        <div class="modal-body" style="padding:0">
            <div class="restore example">
                <div class="ui selection dropdown dropdown-products" style="    font-size: 20px;">
                    <input name="reference_product" type="hidden" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">Default</div>
                    <div class="menu">
                        @foreach($availableProducts as $product)
                            <div class="item"
                                 data-value="{{$product->id}}">{{$product->title}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui button confirm-add-product-to-reference">OK</div>
    </div>
</div>