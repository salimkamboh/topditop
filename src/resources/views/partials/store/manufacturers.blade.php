<div class="container">
    <div class="row margin-top-lg margin-bottom-sm">
        <div class="col-sm-8 text-left">
            <h3>Manufacturers</h3>
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
    <div class="ng-isolate-scope">
        <div class="margin-bottom-lg">
            <div class="row">
                @foreach($manufacturers as $manufacturer)
                <div class="col-sm-4">
                    <div class="manufacturer">
                        <a href="#">
                            <img src="{{ $manufacturer->getImageUrl() }}" alt="" class="img-responsive">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{--<div class="text-center">--}}
        {{--<a href="#" class="btn btn-default btn-call">View All Manufacturerers</a>--}}
    {{--</div>--}}
</div>