<h5>{{ trans('messages.prod_reference') }}</h5>

<div class="row product-reference-holder">
    @if(isset($selected_references))
        @foreach($selected_references as $selected_reference)
            <div class="col-md-6">
                <div class="single-item item-shadow">
                    <img src="{{ $selected_reference->getImageByThumb('reference_thumb') }}" alt=""
                         class="img-responsive">
                    <div class="item-info">
                        <div class="item-info-top clearfix">
                            <div class="width-fix">
                            <span class="title">{{$selected_reference->title}}</span>
                            <span class="number-of pull-left">({{$selected_reference->getNumberOfProducts()}} {{trans('messages.products')}})</span></div>
                            <span class="date pull-right">{{ /** @var $selected_reference App\Reference */ $selected_reference->getNiceDate()}}</span>
                        </div>
                        <div class="item-info-bottom">
                            <a href="#" class="pull-left"><i class="icon-shopping-cart"></i>{{ $selected_reference->store->package_name()}}: {{ $selected_reference->store->store_name}}
                            </a>
                            <a href="#" class="brown-color pull-right">+ {{ trans('messages.share') }}</a>
                        </div>
                        <div class="clearfix"></div>
                        <a href="{{ route("dashboard_reference_edit", $selected_reference) }}"
                           class="click-button">{{ trans('messages.manage_reference') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="col-md-6">
        <div class="single-item empty-item item-shadow">
            <a href="javascript:void(0)" class="connect-reference">
                <i class="icon-plus-sign"></i>
                <p>{{ trans('messages.connect_prod') }}</p>
            </a>
        </div>
    </div>
</div>

<div class="ui modal" style="position: relative; overflow: visible;">
    <i class="close icon"></i>
    <div class="header">Choose Reference for this Product</div>
    <div class="content">
        <div class="modal-body" style="padding:0">
            <div class="restore example">
                <div class="ui selection dropdown dropdown-references" style="    font-size: 20px;">
                    <input name="product_reference" type="hidden" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">Default</div>
                    <div class="menu">
                        @foreach($availableReferences as $reference)
                            <div class="item"
                                 data-value="{{$reference->id}}">{{$reference->title}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui button confirm-add-reference-to-product">OK</div>
    </div>
</div>