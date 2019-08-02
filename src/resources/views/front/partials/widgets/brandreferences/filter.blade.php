<div class="col-sm-4 filter">
    <form method="post" action="{{route('brandreferences_multi_filter')}}" class="filter-multi">
        <h4 class="text-left">{{ trans('messages.filter_category') }}</h4>

        <div class="restore example">
            <div class="ui multiple selection dropdown" data-filter="categories" tabindex="0">
                <input name="categories_filter" type="hidden" value="">
                <i class="dropdown icon"></i>
                <div class="default text">{{ trans('messages.category_choose') }}</div>
                <div class="menu" tabindex="-1">
                    @foreach($categories as $category)
						@if (count($category->brandreferences) > 0)
							<div class="item" data-value="{{$category->id}}">{{$category->name}}
								<span>({{ count($category->brandreferences) }})</span>
							</div>
						@endif
                    @endforeach
                </div>
            </div>
        </div>

        <a href="{{ route('front_brand_references_index') }}" class="clear-filter"><span>x</span>{{trans('messages.clear_filter')}}</a>

        {{csrf_field()}}
    </form>
</div>
