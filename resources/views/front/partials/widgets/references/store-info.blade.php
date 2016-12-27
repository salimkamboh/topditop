<img src="{{$store->getStoreLogo()}}" alt="" class="img-responsive">
<h3 class="page-heading">{{$store->store_name}}</h3>
<div class="data-holder">
    <?php $datablock = $store->getStoreData(); ?>
    <p><i class="fa fa-map-marker"></i>{{$datablock["address"]}}</p>
    <p>
        <i class="fa fa-clock-o"></i><span>Mon - Fri {{$datablock["from_working_days"]}}
            -{{$datablock["to_working_days"]}}</span><span>Sat {{$datablock["from_weekends"]}}
            -{{$datablock["to_weekends"]}}</span>
    </p>
    <p><i class="fa fa-globe"></i><a href="#" class="brown-color">{{$datablock["contact_mail"]}}</a></p>
    <p><i class="fa fa-globe"></i><a href="#" class="brown-color">{{$datablock["website"]}}</a></p>
    <p><i class="fa fa-phone"></i><a href="#" class="brown-color">{{$datablock["telephone_number"]}}</a></p>
    <div class="social-icon-holder">
        <a href="{{$datablock["facebook_fanpage"]}}"><i class="fa fa-facebook-square"></i></a>
    </div>
</div>