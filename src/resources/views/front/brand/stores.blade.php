@extends("master.front-layout")

@section("pageTitle") {{ $manufacturer->name }} - Stores & References @stop

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
                                    <div class="store-image-holder" style="height:530px">
                                        <img src="{{$store->getStoreLogo()}}">
                                    </div>
                                    <div class="item-info show-info">
                                        <div class="item-info-top clearfix">
                                            <span class="title">{{$store->store_name}}</span>
                                            <span class="number-of pull-left">({{$store->getNumberOfReferences()}}
                                                {{ trans('messages.scene') }})</span>
                                        </div>
                                        <div class="item-info-bottom">
                                            <i class="fa fa-map-marker brown-color"></i><span>{{$store->location->name}}</span>
                                            <i class="fa fa-tag brown-color"></i><span>{{ trans('messages.categories') }}
                                                :
                                                <?php
                                                    echo join(", ", $store->getCategoriesNiceArray());
                                                ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if(count($manufacturer->brandreferences) > 0)
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-heading">Marken Referenzen</h3>
                    <div class="brandreferences-macy">
                        @foreach($manufacturer->brandreferences as $brandreference)
                        <div class="brandreference">
                            <a href="{{ route('front_brand_references_single', ['manufacturer' => $brandreference->manufacturer_id, '$brandreference' => $brandreference->id]) }}">
                                <img src="{{$brandreference->getThumbnailMediumUrl()}}">
                            </a>
                            <div class="brandreference-text">
                                <p class="brandreference-text-title">{{$brandreference->title}}
                                    @if($brandreference->category != null)
                                    <span class="brandreference-text-category">{{$brandreference->category->name}}</span>
                                    @endif
                                </p>
                                <p class="brandreference-text-description">{{$brandreference->description}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

@endsection