@extends("master.front-layout")

@section("pageTitle") Brand-Stores @stop

@section("header")
@stop

@section('content')

    <section id="front-stores">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-offset-4 text-center">
                    <img class="img-responsive" src="{{$manufacturer->getImageUrl()}}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-heading">TopDiTop Stores</h3>
                    <div class="row list-all-stores">
                        @foreach($manufacturer->stores as $store)
                            <div class="col-sm-6">
                                <a href="{{ route('front_show_store', $store) }}"
                                   class="single-item item-shadow">
                                    {{--<div class="store-image-holder" style="height:530px">--}}
                                        <img src="{{$store->getStoreLogo()}}">
                                    {{--</div>--}}
                                    <div class="item-info show-info">
                                        <div class="item-info-top clearfix">
                                            <span class="title">{{$store->store_name}}</span>
                                            <span class="number-of pull-left">({{$store->getNumberOfReferences()}}
                                                {{ trans('messages.scene') }})</span>
                                        </div>
                                        <div class="item-info-bottom">
                                            <i class="fa fa-map-marker brown-color"></i><span>{{$store->location->name}}</span>
                                            <i class="fa fa-tag brown-color"></i><span>{{ trans('messages.one_stop_shop') }}
                                                :
                                                @foreach($store->getOneStopShopData() as $item)
                                                    {{$item}} ,
                                                @endforeach</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <h3 class="page-heading">Marken Referenzen</h3>
                <div class="col-sm-12">
                    <div id="brandreferences-macy">
                        @foreach($manufacturer->brandreferences as $brandreference)
                            <div class="brandreference">
                                <a href="{{$brandreference->getImageUrl()}}">
                                    <img src="{{$brandreference->getThumbnailUrl()}}">
                                </a>
                                <p class="brandreference-heading">{{$brandreference->title}}</p>
                                <p class="brandreference-description">{{$brandreference->description}}</p>
                            </div>
                        @endforeach
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
    <script type="text/javascript" src="{{ asset('js/macy.js') }}"></script>
    <script>
        var macyInstance = Macy({
            container: '#brandreferences-macy',
            columns: 3,
            margin: {
                x: 10,
                y: 40
            },
            breakAt: {
                940: 3,
                720: 2,
                400: 1
            }
        });
        macyInstance.reInit();
    </script>
@stop