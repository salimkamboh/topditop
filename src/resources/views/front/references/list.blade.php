@extends("master.front-layout")

@section("pageTitle") References @stop

@section("header")
@stop

@section('content')

    <section id="front-references">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 pagination-main">
                    <a href="{{route('default')}}"><i
                                class="icon-arrow-left"></i><span>{{ trans('messages.back_homepage') }}</span></a>
                    <span>&gt;</span>
                    <a href="#"><span>{{trans('messages.references')}}</span></a>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4 filter">
                            @include('front.partials.widgets.references.filters-by-brand-store')
                        </div>
                        <div class="col-sm-8">
                            <h3 class="page-heading">{{trans('messages.references')}}</h3>
                            <div class="row list-all-references">
                                @foreach($references as $reference)
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
                                                            {{ trans('messages.scene') }})</span>
                                                    </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/lib/transition.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/dropdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/references-filter.js') }}"></script>
@stop