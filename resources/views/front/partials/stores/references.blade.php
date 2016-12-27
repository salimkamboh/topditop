<section id="home-references">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h3>{{ trans('messages.store_reference') }}</h3>
            </div>
            <div class="col-sm-4">
                <div class="sortable">
                    <button type="button" class="pull-left show-home-newest">{{ trans('messages.newest') }}</button>
                    <button type="button"
                            class="pull-right show-home-most active">{{ trans('messages.most_viewed') }}</button>
                </div>
            </div>
        </div>

        {{--new reference grid--}}
        <div class="references-home-newest hidden-block">
            <div class="row special-reference-grid home-design">
                @if(isset($references_newest[0]))
                    <div class="col-md-6">
                        @include('front.partials.stores.single-reference', ['reference' => $references_newest[0], 'thumbSlug' => 'gallery_1'])
                    </div>
                @endif
                <div class="col-md-6">
                    @if(isset($references_newest[1]))
                        <div class="row">
                            <div class="col-sm-12">
                                @include('front.partials.stores.single-reference', ['reference' => $references_newest[1], 'thumbSlug' => 'gallery_2'])
                            </div>
                        </div>
                    @endif

                    @if(isset($references_newest[2]))
                        <div class="row">
                            <div class="col-md-6">
                                @include('front.partials.stores.single-reference', ['reference' => $references_newest[2], 'thumbSlug' => 'gallery_3'])
                            </div>
                            @if(isset($references_newest[3]))
                                <div class="col-md-6">
                                    @include('front.partials.stores.single-reference', ['reference' => $references_newest[3], 'thumbSlug' => 'gallery_3'])
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @if(isset($references_newest[4]))
                <div class="row special-reference-grid home-design">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-12">
                                @include('front.partials.stores.single-reference', ['reference' => $references_newest[4], 'thumbSlug' => 'gallery_2'])
                            </div>
                        </div>
                        @if(isset($references_newest[5]))
                            <div class="row">
                                <div class="col-md-6">
                                    @include('front.partials.stores.single-reference', ['reference' => $references_newest[5], 'thumbSlug' => 'gallery_3'])
                                </div>
                                @if(isset($references_newest[6]))
                                    <div class="col-md-6">
                                        @include('front.partials.stores.single-reference', ['reference' => $references_newest[6], 'thumbSlug' => 'gallery_3'])
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    @if(isset($references_newest[6]))
                        <div class="col-md-6">
                            @include('front.partials.stores.single-reference', ['reference' => $references_newest[6], 'thumbSlug' => 'gallery_1'])
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{--new reference grid--}}
        <div class="references-home-most">
            <div class="row special-reference-grid home-design">
                @if(isset($references_most[0]))
                    <div class="col-md-6">
                        @include('front.partials.stores.single-reference', ['reference' => $references_most[0], 'thumbSlug' => 'gallery_1'])
                    </div>
                @endif
                <div class="col-md-6">
                    @if(isset($references_most[1]))
                        <div class="row">
                            <div class="col-sm-12">
                                @include('front.partials.stores.single-reference', ['reference' => $references_most[1], 'thumbSlug' => 'gallery_2'])
                            </div>
                        </div>
                    @endif

                    @if(isset($references_most[2]))
                        <div class="row">
                            <div class="col-md-6">
                                @include('front.partials.stores.single-reference', ['reference' => $references_most[2], 'thumbSlug' => 'gallery_3'])
                            </div>
                            @if(isset($references_most[3]))
                                <div class="col-md-6">
                                    @include('front.partials.stores.single-reference', ['reference' => $references_most[3], 'thumbSlug' => 'gallery_3'])
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @if(isset($references_most[4]))
                <div class="row special-reference-grid home-design">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-12">
                                @include('front.partials.stores.single-reference', ['reference' => $references_most[4], 'thumbSlug' => 'gallery_2'])
                            </div>
                        </div>
                        @if(isset($references_most[5]))
                            <div class="row">
                                <div class="col-md-6">
                                    @include('front.partials.stores.single-reference', ['reference' => $references_most[5], 'thumbSlug' => 'gallery_3'])
                                </div>
                                @if(isset($references_most[6]))
                                    <div class="col-md-6">
                                        @include('front.partials.stores.single-reference', ['reference' => $references_most[6], 'thumbSlug' => 'gallery_3'])
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    @if(isset($references_most[6]))
                        <div class="col-md-6">
                            @include('front.partials.stores.single-reference', ['reference' => $references_most[6], 'thumbSlug' => 'gallery_1'])
                        </div>
                    @endif
                </div>
            @endif
        </div>
        {{--new reference grid--}}

        @if($store->package_name() == 'TopDiTop Store')
            <div class="text-center">
                <a href="{{ route("front_references_gallery", $store) }}"
                   class=click-button>{{ trans('messages.all_references') }}</a>
            </div>
        @endif
    </div>
</section>