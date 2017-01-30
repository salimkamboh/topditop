<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3 class="page-heading">{{$reference->store->store_name}}</h3>
            <div class="data-holder">
                <p><i class="fa fa-map-marker"></i>{{$datablock["address"]}}</p>
                <p>
                    <i class="fa fa-clock-o"></i><span>Mon - Fri {{$datablock["from_working_days"]}}-{{$datablock["to_working_days"]}}</span><span>Sat {{$datablock["from_weekends"]}}-{{$datablock["to_weekends"]}}</span>
                </p>
                <p><i class="fa fa-globe"></i><a href="mailto:{{$datablock["contact_mail"]}}" class="brown-color">{{$datablock["contact_mail"]}}</a></p>
                <p><i class="fa fa-internet-explorer"></i><a href="{{$datablock["website"]}}" class="brown-color">{{$datablock["website"]}}</a></p>
                <p><i class="fa fa-phone"></i><a href="tel:{{$datablock["telephone_number"]}}" class="brown-color">{{$datablock["telephone_number"]}}</a></p>
                <div class="social-icon-holder">
                    <a href="#"><i class="fa fa-facebook-square"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-8 description-text">
            <h3 class="page-heading brown-color">{{$reference->title}}</h3>
            <p>{{$reference->description}}</p>
            @if ($reference->video_html)
                <div class="video-holder pull-left">
                    <a href="javascript:void(0)" class="show-video-modal">
                        <img alt="" class="img-responsive" src="{{asset('img/video.PNG')}}">
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>