@extends("master.front-layout")

@section("pageTitle") Brand References @stop

@section("header")
@stop

@section('content')

  <section id="front-stores">
    <div class="container">
      @if(count($brandreferences) > 0)
        <div class="row">
			<div class="col-sm-12 pagination-main">
				<a href="{{route('default')}}"><i class="icon-arrow-left"></i><span>{{ trans('messages.back_homepage') }}</span></a>
				<span>&gt;</span>
				<a href="#"><span>Referenzen</span></a>
			</div>
			
			
			<div class="col-sm-12">
				<div class="row">
					@include('front.partials.widgets.brandreferences.filter')
					<?php /*
                        <div class="col-sm-8">
                            <div class="store-filter-image">
                                <img src="{{ asset('assets/img/topditophome_filter.jpg') }}" class="img-responsive" alt="">
                            </div>
                        </div>
                        */ ?>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-heading">Marken Referenzen</h3>
						<div class="brandreferences-macy list-all-brandrefs">
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
			</div>
        </div>
        <div class="row list-all-brandrefs-pagination">
          <div class="col-md-12 text-center">
            {{ $brandreferences->links() }}
          </div>
        </div>
      @endif
    </div>
  </section>

@endsection

@section("footer")
	<script type="text/javascript" src="{{ asset('assets/js/lib/transition.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/dropdown.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/brandreferences-filter.js') }}"></script>
@stop
