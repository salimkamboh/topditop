<div class="container">
    <div class="row margin-top-lg margin-bottom-sm">
        <div class="col-sm-8 text-left">
            <h3>Store References</h3>
        </div>
        <div class="col-sm-4 text-right">
            <div class="sortable">
                <div class="sortable__half-block">
                    <button class="btn btn-primary btn-block">Newest</button>
                </div>
                <div class="sortable__half-block">
                    <button class="btn btn-primary btn-block active">Most Viewed</button>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class=" margin-bottom-lg">
            <div class="row margin-bottom-lg">
                @foreach($storeReferences as $reference)
                    <div class="col-xs-4">
                        <div class="reference">
                            <a href="{{ route("front_references_single", $reference) }}">
                                <img alt="" class="img-responsive"
                                     src="@if($reference->getImageByThumb('reference_thumb') !== null) {{$reference->getImageByThumb('reference_thumb')}} @endif">
                            </a>
                            <div class="reference__info-wrapper ">
                                <div class="reference-info">
                                    <span class="reference-title">{{$reference->title}}</span>
                                    <span class="reference-references">({{$reference->getNumberOfImages()}} scenes)</span>
                                    <span class="reference-date">{{$reference->getNiceDate()}}</span>
                                </div>
                                <div class="reference-add-info text-justify">
                                    <a href="#" class="reference-store">
                                        <i class="fa fa-shopping-cart"></i>{{$store->package_name($store)}}:
                                        {{$store->store_name}}
                                    </a>
                                    <a href="" class="hidden">
                                        <i class="fa fa-bookmark"></i>{{$store->location}}
                                    </a>
                                    <a class="reference-share">
                                        + Share
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="text-center">
        <a href="{{ route("front_references_gallery") }}" class="btn btn-default btn-call">View All References</a>
    </div>
</div>