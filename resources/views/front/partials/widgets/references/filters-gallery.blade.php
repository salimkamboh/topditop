<form method="post" action="{{route('references_multi_filter_gallery', $ref_store)}}" class="filter-multi">

    <h4 class="text-left">{{trans('messages.filter_brands')}}</h4>

    <div class="restore example">
        <div class="ui multiple selection dropdown" tabindex="0">
            <input name="manufacturers_filter" type="hidden" value="">
            <i class="dropdown icon"></i>
            <div class="default text">{{trans('messages.brands')}}</div>
            <div class="menu" tabindex="-1">
                @foreach($manufacturers as $manufacturer)
                    <div class="item"
                         data-value="{{$manufacturer->id}}">{{$manufacturer->name}}
                        <span>({{$manufacturer->numberOfReferencesForStore($ref_store)}})</span></div>
                @endforeach
            </div>
        </div>
    </div>

    {{csrf_field()}}

</form>

<a href="javascript:void(0)" class="clear-filter"><span>x</span>{{trans('messages.clear_filter')}}</a>