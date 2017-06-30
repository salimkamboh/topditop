<section id="slider">
    <div class="slides-parent">
        @foreach($slides as $slide)
            <div class="the-slide">

                <img src="{{$slide->getImageUrl()}}" style="width:100%">

                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot1_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{$slide->slot1_width}}%; left:0">
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot2_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{$slide->slot2_width}}%; left:{{$slide->slot1_width}}%">
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot3_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{intval($slide->slot3_width)}}%; left:{{intval($slide->slot1_width)+intval($slide->slot2_width)}}%">
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot4_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{intval($slide->slot4_width)}}%; left:{{intval($slide->slot1_width)+intval($slide->slot2_width)+intval($slide->slot3_width)}}%">
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot5_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{intval($slide->slot5_width)}}%; left:{{intval($slide->slot1_width)+intval($slide->slot2_width)+intval($slide->slot3_width)+intval($slide->slot4_width)}}%">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
