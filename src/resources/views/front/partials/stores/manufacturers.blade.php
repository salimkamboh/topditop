<section id="home-references">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="text-center">{{ trans('messages.manufacturers') }}</h3>
            </div>
        </div>

        <div class="row">
            @if(isset($manufacturers))
                @foreach($manufacturers as $manufacturer)
                    <div class="col-sm-4">
                        <div class="manufacturer manufacturer-id-{{$manufacturer->id}}">

                            <img alt="{{$manufacturer->name}}" class="img-responsive full-width"
                                 src="{{$manufacturer->getImageUrl()}}">
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
