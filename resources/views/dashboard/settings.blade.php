@extends("master.dashboard-layout")

@section("pageTitle") Profile Settings @stop

@section("header")
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/settings.css') }}">
    <style>
        .menu.transition {
            max-height: 300px;
            overflow: scroll;
        }
    </style>
@stop

@section("content")
    <section id="dashboard-settings">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 pagination-main">
                    <a href="{{ route('dashboard_home') }}">
                        <i class="icon-arrow-left"></i>
                        <span class="back-dashboard">{{ trans('messages.back_dashboard') }}</span>
                    </a>
                    <h3>{{ trans('messages.store_settings') }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <div class="widget item-shadow">
                        @if(isset($store->image))
                            <img src="{{$store->image->url}}" alt="">
                        @endif
                        <h3>{{$store->store_name}}</h3>

                        <a href="{{route("dashboard_settings_image")}}"><span class="replace-logo"><i
                                        class="icon-refresh"></i>{{ trans('messages.replace_logo') }}</span></a>
                    </div>

                    @if($store->package_name() !== 'Store')
                        <div class="side-bar item-shadow">
                            <div class="side-bar-top">
                                <span class="number-of pull-left">{{$numberOfReferences}}</span>
                                <h3 class="pull-left">{{ trans('messages.references') }}</h3><span
                                        class="pull-right x-icon"><a href="{{ route('dashboard_reference_new') }}"><i
                                                class="icon-plus"></i></a></span>
                            </div>
                            <div class="side-bar-bottom"></div>
                        </div>
                        <div class="side-bar item-shadow">
                            <div class="side-bar-top">
                                <span class="number-of pull-left">{{$numberOfProducts}}</span>
                                <h3 class="pull-left">{{ trans('messages.products') }}</h3>
                                <span class=" x-icon pull-right"><a href="{{ route('dashboard_product_new') }}"><i
                                                class="icon-plus"></i></a></span>
                            </div>
                            <div class="side-bar-bottom"></div>
                        </div>
                    @endif
                </div>
                <div class="col-sm-8 text-center">
                    <div class="selector clearfix">
                        @foreach($store->profile->package->panels as $panel)
                            <div class="selector-options">
                                <a href="#panel-{{$panel->id}}">
                                    <i class="icon-cogs small"></i>
                                    {{$panel->name}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route("dashboard_settings_save", $store->profile) }}" method="post">
                        <?php $counter = 0; ?>
                        @foreach($store->profile->package->panels as $panel)
                            <div class="panelholder @if($counter > 1) panel-special @endif" style="display: none;"
                                 id="panel-{{$panel->id}}">
                                <div class="big-white-block item-shadow">
                                    @foreach($panel->orderedFieldGroups as $fieldgroup)
                                        <div data-fiedgroupid="{{$fieldgroup->id}}" class="{{$fieldgroup->cssclass}}">
                                            <?php $orderedFields = \App\Field::where('field_group_id', $fieldgroup->id)->orderBy('order', 'asc')->get(); ?>
                                            @foreach($orderedFields as $field)
                                                <div class="form-group {{$field->cssclass}}">
                                                    {!! $field->htmlHelper($store->profile) !!}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    <button class="save-changes">{{ trans('messages.save_changes') }}</button>
                                </div>
                            </div>
                            <?php $counter++; ?>
                        @endforeach
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@section("footer")
    <script type="text/javascript">
        _globalPackage = '{{$store->package_name()}}';
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/store-settings.js') }}"></script>
@stop