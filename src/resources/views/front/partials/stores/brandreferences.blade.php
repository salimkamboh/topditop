@if(count($brandreferences))
<section class="brandreferences-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-heading">Marken Referenzen</h3>
                <div class="brandreferences-macy">
                    @foreach($brandreferences as $brandreference)
                        <div class="brandreference">
                            <a href="{{$brandreference->getImageUrl()}}" target="_blank">
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
    </div>
</section>

@section("footer")
    <script type="text/javascript" src="{{ asset('js/macy.js') }}"></script>
    <script>
        var macyInstance = Macy({
            container: '.brandreferences-macy',
            columns: 3,
            margin: {
                x: 10,
                y: 40
            },
            breakAt: {
                940: 2,
                640: 1
            }
        });
        macyInstance.reInit();
    </script>
@stop
@endif