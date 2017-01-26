<div class="col-sm-12 pagination-main">
    <a href="{{ route("dashboard_home") }}"><i class="icon-arrow-left"></i><span>{{ trans('messages.back_dashboard') }}</span></a>
    <span>&gt;</span>
    <a href="{{ route("dashboard_products") }}"><span>{{ trans('messages.manage_product') }}</span></a>
    <span>&gt;</span>

    <a href="javascript:void(0)"><span>@if(!isset($product->id)) {{ trans('messages.new_product') }} @else {{$product->title}} @endif</span></a>
</div>