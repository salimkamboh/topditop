@extends("master.front-layout")

@section("pageTitle") Reference Gallery @stop

@section("header")

@stop

@section('content')

    <section id="reference-gallery">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-4">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="page-heading">{{trans('messages.reference_gallery')}}</h3>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="pull-left show-ref-newest">{{trans('messages.newest')}}</button>
                            <button type="button" class="pull-right show-ref-most active">{{trans('messages.most_viewed')}}</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 filter">
                    @include('front.partials.widgets.references.store-info')
                    @include('front.partials.widgets.references.filters-gallery')
                </div>
                <div class="col-sm-8">
                    <div class="row references-ref-newest hidden-block list-all-brands">
                        @if(isset($references_newest))
                            @foreach($references_newest as $reference)
                                <div class="col-md-6">
                                    <div class="single-item item-shadow">
                                        <img alt="" class="img-responsive"
                                             src="@if($reference->getImageByThumb('reference_thumb') !== null) {{$reference->getImageByThumb('reference_thumb')}} @endif">
                                        <div class="item-info">
                                            <div class="item-info-top clearfix">
                                                <div class="width-fix">
                                            <span class="title">
                                                @if($reference->package_name() == 'TopDiTop Store')
                                                    <a href="{{ route("front_references_single", $reference) }}">{{$reference->title}}</a>
                                                @else
                                                    {{$reference->title}}
                                                @endif
                                            </span>
                                                <span class="number-of pull-left">({{$reference->getNumberOfImages()}}
                                                    {{trans('messages.scene')}})</span></div>
                                                <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                                            </div>
                                            <div class="item-info-bottom">
                                                <a href="{{route('front_show_store', $reference->store)}}"><i
                                                            class="icon-shopping-cart"></i>{{$reference->package_name()}}
                                                    : {{$reference->store->store_name}}</a>
                                                <a class="shareBtn"
                                                   href="{{ route("front_references_single", $reference) }}">+
                                                    {{trans('messages.share')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row references-ref-most list-all-brands">
                        @if(isset($references_most))
                            @foreach($references_most as $reference)
                                <div class="col-md-6">
                                    <div class="single-item item-shadow">
                                        <img alt="" class="img-responsive"
                                             src="@if($reference->getImageByThumb('reference_thumb') !== null) {{$reference->getImageByThumb('reference_thumb')}} @endif">
                                        <div class="item-info">
                                            <div class="item-info-top clearfix">
                                                <div class="width-fix">
                                            <span class="title">
                                                @if($reference->package_name() == 'TopDiTop Store')
                                                    <a href="{{ route("front_references_single", $reference) }}">{{$reference->title}}</a>
                                                @else
                                                    {{$reference->title}}
                                                @endif
                                            </span>
                                                <span class="number-of pull-left">({{$reference->getNumberOfImages()}}
                                                    {{trans('messages.scene')}})</span></div>
                                                <span class="date pull-right">{{$reference->getNiceDate()}}</span>
                                            </div>
                                            <div class="item-info-bottom">
                                                <a href="{{route('front_show_store', $reference->store)}}"><i
                                                            class="icon-shopping-cart"></i>{{$reference->package_name()}}
                                                    : {{$reference->store->store_name}}</a>
                                                <a class="shareBtn"
                                                   href="{{ route("front_references_single", $reference) }}">+
                                                    {{trans('messages.share')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/gallery-filter.js') }}"></script>
@stop