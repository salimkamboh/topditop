<div class="col-sm-12">
    <div style="background-color: #f2f2f2; " class="row margin-t-correct">
        <div class="col-sm-4"></div>
        <div class="col-sm-8">
            <p class="basic-product-info">{{count($references)}} Product References</p>
            <div class="row  featured-alt__separator">
                @foreach($references as $reference)
                    <div class="col-md-6">
                        <div class="reference min-height-360">
                            <img alt="" class="img-responsive"
                                 src="{{$reference->image->url}}">
                            <div class="reference__info-wrapper products-manage">
                                <div class="reference-info text-left heading">
                                    <span class="reference-title">{{$reference->title}}</span>
                                    <span class="reference-references">(64 references)</span>
                                        <span class="reference-date relative brand-name">5. Oct</span>
                                </div>
                                <div class="reference-add-info text-justify">
                                    <a href="" class="reference-store brand-name margin-b-correct">
                                        <i class="icon-shopping-cart"></i> {{$reference->store->store_name}}
                                    </a>
                                    <a class="reference-share big-share">
                                        + Share
                                    </a>

                                </div>
                                <a href="{{ route('dashboard_reference_edit', $reference->id) }}"
                                   class="manage-ref margin-t-correct">Manage Reference</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>