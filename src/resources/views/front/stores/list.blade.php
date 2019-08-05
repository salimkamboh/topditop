@extends("master.front-layout")

@section("pageTitle") Stores @stop

@section("header")

@stop

@section("content")
    <section id="front-stores">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 pagination-main">
                    <a href="{{route('default')}}"><i class="icon-arrow-left"></i><span>{{ trans('messages.back_homepage') }}</span></a>
                    <span>&gt;</span>
                    <a href="#"><span>Stores</span></a>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        @include('front.partials.widgets.stores.filter')
                        <div class="col-sm-8">
                            <div class="store-filter-image">
                                <img src="{{ asset('assets/img/topditophome_filter.jpg') }}" class="img-responsive" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-heading">TopDiTop Stores</h3>
                            <div class="row list-all-stores">
                                <?php /** @var $store App\Store */ ?>
                                @foreach($stores as $store)
                                    <div class="col-md-4">
                                        <a href="{{ route('front_show_store', $store) }}"
                                           class="single-item item-shadow">
                                            <div class="store-image-holder">
                                                <img src="{{$store->getStoreLogo()}}" alt="" class="img-responsive">
                                            </div>
                                            <div class="item-info show-info">
                                                <div class="item-info-top clearfix">
                                                    <span class="title">{{$store->store_name}}</span>
                                                    <span class="number-of pull-left">({{$store->getNumberOfReferences()}}
                                                        {{ trans('messages.scene') }})</span>
                                                </div>
                                                <div class="item-info-bottom">
                                                    <i class="fa fa-map-marker brown-color"></i><span>{{$store->location->name}}</span>
                                                    <i class="fa fa-tag brown-color"></i><span>{{ trans('messages.categories') }}:
                                                                
                                                        <?php
                                                            echo join(", ", $store->getCategoriesNiceArray());
                                                        ?>
                                                        </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row list-all-stores-pagination">
                        <div class="text-center">
                            {{ $stores->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section("footer")
    <script type="text/javascript" src="{{ asset('assets/js/lib/transition.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/dropdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/stores-filter.js') }}"></script>
@stop