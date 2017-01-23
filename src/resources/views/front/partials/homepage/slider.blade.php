<section id="slider">
    <div class="slides-parent">
        @foreach($slides as $slide)
            <div class="the-slide">

                <img src="{{$slide->image_url}}" style="width:100%">

                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot1_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{$slide->slot1_width}}%; left:0">
                        <div class="carousel-caption">
                            <?php $store1 = \App\Store::find($slide->slot1_store_id); ?>
                            <u>{{\App\Field::getSelectedValues("founded", $store1)}}</u>
                            <p>{{$store1->location->name}}</p>
                            <h1>{{$store1->store_name}}</h1>
                        </div>
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot2_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{$slide->slot2_width}}%; left:{{$slide->slot1_width}}%">
                        <div class="carousel-caption">
                            <?php $store2 = \App\Store::find($slide->slot2_store_id); ?>
                            <u>{{\App\Field::getSelectedValues("founded", $store2)}}</u>
                            <p>{{$store2->location->name}}</p>
                            <h1>{{$store2->store_name}}</h1>
                        </div>
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot3_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{$slide->slot3_width}}%; left:{{$slide->slot1_width+$slide->slot2_width}}%">
                        <div class="carousel-caption">
                            <?php $store3 = \App\Store::find($slide->slot3_store_id); ?>
                            <u>{{\App\Field::getSelectedValues("founded", $store3)}}</u>
                            <p>{{$store3->location->name}}</p>
                            <h1>{{$store3->store_name}}</h1>
                        </div>
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot4_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{$slide->slot4_width}}%; left:{{$slide->slot1_width+$slide->slot2_width+$slide->slot3_width}}%">
                        <div class="carousel-caption">
                            <?php $store4 = \App\Store::find($slide->slot4_store_id); ?>
                            <u>{{\App\Field::getSelectedValues("founded", $store4)}}</u>
                            <p>{{$store4->location->name}}</p>
                            <h1>{{$store4->store_name}}</h1>
                        </div>
                    </a>
                </div>
                <div class="slider__overlay">
                    <a href="{{route('front_show_store', $slide->slot5_store_id)}}"
                       class="slider__overlay__item"
                       style="width: {{$slide->slot5_width}}%; left:{{$slide->slot1_width+$slide->slot2_width+$slide->slot3_width+$slide->slot4_width}}%">
                        <div class="carousel-caption">
                            <?php $store5 = \App\Store::find($slide->slot5_store_id); ?>
                            <u>{{\App\Field::getSelectedValues("founded", $store5)}}</u>
                            <p>{{$store5->location->name}}</p>
                            <h1>{{$store5->store_name}}</h1>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
