<div class="col-sm-12 pagination-main">
    <a href="{{ route("dashboard_home") }}"><i class="icon-arrow-left"></i><span>{{ trans('messages.back_dashboard') }}</span></a>
    <span>&laquo;</span>
    <a href="{{ route("dashboard_references") }}"><span>{{ trans('messages.manage_reference') }}</span></a>
    <span>&laquo;</span>
    <a href="#"><span>{{ $reference->title }}</span></a>
</div>