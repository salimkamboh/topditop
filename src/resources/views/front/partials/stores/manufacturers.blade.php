<section id="home-references">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="text-center">{{ trans('messages.manufacturers') }}</h3>
            </div>
        </div>

            @if(isset($manufacturers))
            @for ($i = 0; $i < count($manufacturers); $i += 3)
            <div class="row">
                @if($i < count($manufacturers))
                    <div class="col-sm-4">
                        <div class="manufacturer manufacturer-id-{{$manufacturers->get($i)}}">

                            <img alt="{{$manufacturers->get($i)->name}}" class="img-responsive full-width"
                                 src="{{$manufacturers->get($i)->getImageUrl()}}">
                        </div>
                    </div>
                @endif
                @if(($i + 1) < count($manufacturers))
                    <div class="col-sm-4">
                        <div class="manufacturer manufacturer-id-{{$manufacturers->get($i + 1)}}">

                            <img alt="{{$manufacturers->get($i + 1)->name}}" class="img-responsive full-width"
                                 src="{{$manufacturers->get($i + 1)->getImageUrl()}}">
                        </div>
                    </div>
                @endif
                @if(($i + 2) < count($manufacturers))
                    <div class="col-sm-4">
                        <div class="manufacturer manufacturer-id-{{$manufacturers->get($i + 2)}}">

                            <img alt="{{$manufacturers->get($i + 2)->name}}" class="img-responsive full-width"
                                 src="{{$manufacturers->get($i + 2)->getImageUrl()}}">
                        </div>
                    </div>
                @endif
            </div>
            @endfor
            @endif
        </div>
    </div>
</section>
