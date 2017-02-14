<h5>{{ trans('messages.basic_ref_info') }}</h5>

<div class="big-white-block">

    <form action="@if(!isset($reference->id)){{ route("insertreference") }}@else{{ route("updatereference", $reference) }}@endif"
          id="insertreference" method="post" enctype="multipart/form-data">

        <div class="form-holder">
            <label for="reference_title">{{ trans('messages.reference_name') }}:</label><br>
            <input type="text" name="reference_title" id="reference_title" value="{{ $reference->title }}">
        </div>

        <div class="form-holder">
            <label for="reference_description">{{ trans('messages.description') }}:</label><br>
            <textarea cols="30" rows="7" name="reference_description"
                      id="reference_description">{{ $reference->description }}</textarea>
        </div>

        <div class="form-holder">
            <label>{{ trans('messages.references_brand') }}:</label><br>

            <div class="ui multiple selection dropdown dropdown-manufacturers">
                <input name="manufacturers" type="hidden"
                       value="@if(isset($reference->manufacturers)){{ $reference->getManufacturers() }}@endif">
                <i class="dropdown icon"></i>
                <div class="default text">Default</div>
                <div class="menu">
                    @foreach($manufacturers as $manufacturer)
                        <div class="item"
                             data-value="{{$manufacturer->id}}">{{$manufacturer->name}} <span
                                    class="filter-options-number">({{$manufacturer->numberOfReferences()}}
                                )</span></div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-holder form-holder-info">
            {{ trans('messages.please_select_brands.main_text') }} <a href="{{ route('dashboard_settings') }}">{{ trans('messages.please_select_brands.link_text') }}.</a>
        </div>

        <div class="form-holder">
            <label for="video_link">{{ trans('messages.references_video') }}:</label><br>
            <input type="text" name="video_url" id="video_url" value="{{ $reference->video }}">
            <i class="icon-youtube-play"></i>
        </div>

        <div class="alert alert-danger alert-required-image" role="alert" style="display: none;">
            {{ trans('messages.images_are_required') }}
        </div>

        <a href="#" class="click-button save_reference">@if(!isset($reference->id)){{ trans('messages.insert_reference') }} @else {{ trans('messages.save_changes') }} @endif </a>
        {{ csrf_field() }}
    </form>
</div>