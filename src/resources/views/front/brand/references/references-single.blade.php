@extends("master.front-layout")

@section("pageTitle") {{ $brandreference->manufacturer->name }} - {{ $brandreference->title }} @stop

@section("header")
@stop

@section('content')
<section class="references-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h1>{{ $brandreference->title }} @if($brandreference->category != null) <span class="references-single-category">{{ $brandreference->category->name }}</span> @endif</h1>
          <p class="references-single-description">{{ $brandreference->description }}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <img src="{{ $brandreference->getImageUrl() }}" class="img-responsive-full non-draggable">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="references-single-see-all">
          <p><a href="{{ route('front_brand_stores', $brandreference->manufacturer_id) }}" class="btn-top">
              Alles von {{ $brandreference->manufacturer->name }}
              @if($storesCount > 0 && $brandreferencesCount > 0)
                ({{ $storesCount }} Stores und {{ $brandreferencesCount }} Referenzen)
              @elseif($storesCount > 0)
                ({{ $storesCount }} Stores)
              @elseif($brandreferencesCount > 0)
                ({{ $brandreferencesCount }} Referenzen)
              @endif
            </a></p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
