<section class="front-brandreferences">
  @if(count($brandreferences) > 0)
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-heading">Marken Referenzen</h3>
          <div class="brandreferences-macy">
            @foreach($brandreferences as $brandreference)
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
      <div class="row">
        <div class="col-md-12">
          <div class="text-center">
            <a href="{{ route('front_brand_references_index') }}" class="btn-top">More References</a>
          </div>
        </div>
      </div>
    </div>
  @endif
</section>